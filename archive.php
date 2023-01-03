<?php
session_start();
require_once("f.php");
if (!prijavljen()) {
  header("Location: http://localhost/engy/index.php"); //HARDCODE PATH
  exit;
}
if (!validate_user()) {
  header("Location: http://localhost/engy/index.php?odjava"); //HARDCODE PATH
  exit;
}
$db = mysqli_connect("localhost", "root", "", "engy");

if (!$db) {
  echo "ERROR WITH DB CONNECTION" . mysqli_connect_errno();
  echo "<br>" . mysqli_connect_error();
  exit();
}
mysqli_query($db, "SET NAMES utf8");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- MDB icon -->
  <link rel="icon" href="logo.png" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="css/mdb.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/metricacss.css" />


  <script src="jquary/jquary.js"></script>
  <script src="jquary/jquary.form.js"></script>
  <script src="jquary/functions.js"></script>




  <title>Archive</title>

</head>
<style>
  body {
    background: #E8E8E8;
  }

  .nav-link {
    font-size: 16px;
    color: #9932CC;
  }

  .table>:not(:last-child)>:last-child>* {
    background: gray;
    color: white;
    text-align: center;
    border: black;
    border-style: solid;
    margin: auto;
    padding: 1em;
  }

  .table>thead {
    vertical-align: middle;
  }

  .table>tbody {
    vertical-align: middle !important;
  }

  .table {
    text-align: center;
    border: black;

  }

  .table-hover>tbody>tr:hover>* {
    background: #9932CC;
    color: white;
  }

  .table-hover>tbody>tr {
    border: black;
    border-style: solid;

  }

  .btn-primary {
    background: #9932CC;
    box-shadow: #9932CC !important;
  }

  .btn-primary:hover {
    background: purple;
    box-shadow: purple;
  }

  .btn-primary:active {
    color: yellow;
  }
  .col-sm-2 {
    width: -webkit-fill-available;
}
  .active_procurment{
    background-color: #4B0082 !important;
    color:white;
}
</style>

<body>

  <?php
  navbar();
  ?>
  <div id="MetricaPages" class="main-icon-menu-pane">
    <br>

  </div><!-- end Authentication-->
  </div><!--end menu-body-->
  </div><!-- end main-menu-inner-->
  </div>
  <!-- end left-sidenav-->
  <div class="container-fluid">

    <div class="card text-center">
      <div class="card-body">
        <h3 class="card-title">Welcome <?php echo $_SESSION['username'];
                                        ?>!
          </h5><br>

          <img src="assets/images/widgets/calendar.png" alt="" height="300" class="mx-auto d-block mb-3">
      </div>
      <div class="card-footer text-muted"><i>“The difference between an <b>achiever</b> and a loser is,
          an achiever never gives up, never settles and lastly never forgets.”</i></div>
    </div>

    <style>

    </style>
    <br>
    <div class='row'>
      <div class="col-lg-3" style=overflow-y:auto>
        <div class='card'>
          <div class="card-body">
            <div class="chat-box-left">
              <img src="assets/images/widgets/p-1.png" alt="" height="186" class="mx-auto d-block mb-3">

              <h5 style=text-align:center>Clients List</h5>
              <br>
              <div class="tab-content chat-list slimscroll" id="pills-tabContent" style=max-height:448px;overflow-y:scroll>
                <div id="general_chat">
                  <div id="proc_table_arch">
                  </div>
                </div>
                <!--end personal chat-->
              </div>
              <!--end tab-content-->
            </div>
            <!--end chat-box-left -->

          </div>
        </div>
      </div>



      <div class="col-lg-9">
        <div class=card>
          <div class="card-body" id="proc_edit_form_arch">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="card">

              <table class="table table-striped table-hover" style=margin:0px;>
                <thead>
                  <tr>
                    <th id='first' scope="col">Customer</th>
                    <th scope="col">Product in use</th>
                    <th scope="col">Traffic Volume</th>
                    <th scope="col">Main Competitor</th>
                    <th scope="col">Core Destinations</th>
                    <th scope="col">Destinations Looking For</th>
                    <th scope="col">Potential Destinations</th>
                    <th scope="col">Action</th>
                    <th scope="col">Next Step</th>
                    <th scope="col">Result</th>
                    <th scope="col">Date/Comment</th>
                    <th id='last' scope="col">Return</th>
                  </tr>
                </thead>
                <tbody id="archive_table">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Container wrapper -->

      <!-- Navbar -->
      <script type="text/javascript" src="js/mdb.min.js"></script>
      <script type="text/javascript" src="js/loginscript.js"></script>
      <!-- jQuery  -->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/bootstrap.bundle.min.js"></script>
      <script src="assets/js/metisMenu.min.js"></script>
      <script src="assets/js/waves.min.js"></script>
      <script src="assets/js/jquery.slimscroll.min.js"></script>

      <!--Wysiwig js-->
      <script src="assets/plugins/tinymce/tinymce.min.js"></script>
      <script src="assets/pages/jquery.form-editor.init.js"></script>

      <!-- App js -->
      <script src="assets/js/app.js"></script>
      <script>
        function ArchiveProc(id, val){
            $.post("ajax.php?f=archiveProc", {
                    id: id,
                    val:val
                },
                function(response) {
                    console.log(response);
                    fillProcTable(1);
                    $("#proc_edit_form_arch").html("");
                })
        }
        function fillEditProcForm(id, elem){
            console.log(elem)
            old_elem = document.getElementsByClassName('active_procurment')[0];
            if(old_elem){
                old_elem.classList.remove("active_procurment")
            }
            elem.classList.add("active_procurment")

            $.post("ajax.php?f=fillEditProcFormArch", {
                    id: id,
                },
                function(response) {
                    $("#proc_edit_form_arch").html(response);
                })
        }
      </script>
</body>

</html>