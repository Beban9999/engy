<?php
session_start();
require_once("f.php");
if (!prijavljen()) {
    header("Location: http://localhost/engy/index.php"); //HARDCODE PATH
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
  <link rel="icon" href="logo.ico" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="css/mdb.min.css" />
  <link rel="stylesheet" href="css/style.css" />


    <title>Document</title>
    
</head>
<style>
.nav-link{
font-size:16px;
color:#9932CC;
}
</style>
<body>
    
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0" href="#">
        <img
          src="engy.png"
          height="40"
          alt="eNgY Logo"
          loading="lazy"
        />
      </a>
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="prijavljen.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="reports.php">Reports</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="archive.php">Archive</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="reports.php">Managment</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="reports.php">Admin Panel</a>
        </li>
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->

      <!-- Avatar -->
      <div class="dropdown">
        <a
          class="dropdown-toggle d-flex align-items-center hidden-arrow"
          href="#"
          id="navbarDropdownMenuAvatar"
          role="button"
          data-mdb-toggle="dropdown"
          aria-expanded="false"
        >
          <img
            src="user.png"
            height="30"
            alt="Black and White Portrait of a Man"
            loading="lazy"
          />
        </a>
        <ul
          class="dropdown-menu dropdown-menu-end"
          aria-labelledby="navbarDropdownMenuAvatar"
        >
         
            <a class="dropdown-item" href="#">Logout</a>
          </li>
        </ul>
      </div>
    </div>
</nav>
<div id="MetricaPages" class="main-icon-menu-pane">
                            
                            
                        </div><!-- end Authentication-->
                    </div><!--end menu-body-->
                </div><!-- end main-menu-inner-->
            </div>
            <!-- end left-sidenav-->

            <div class="card text-center">
  <div class="card-header">Archive</div>
  <div class="card-body">
    <h5 class="card-title">Welcome Username!</h5>
    <p class="card-text">This is your archive user! Here you can send and see all your previous agreements.</p>
    <a href="#" class="btn btn-primary">Return to Dashboard</a>
  </div>
  <div class="card-footer text-muted"><i>“The difference between an <b>achiever</b> and a loser is,
an achiever never gives up, never settles and lastly never forgets.”</i></div>
</div>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">Customer</th>
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

    </tr>
  </thead>
<style>
.table>:not(:last-child)>:last-child>*{
    background:gray;
    color:white;
    text-align:center;
    border:black;
    border-style:solid;
    margin:auto;
    padding:1em;
}
.table>thead{
    vertical-align:middle;
}
.table{
    text-align:center;
    border:black;
    
}
.table-hover>tbody>tr:hover>*{
    background:#9932CC;
    color:white;
}
.table-hover>tbody>tr{
    border:black;
    border-style:solid;
    
}
.btn-primary{
    background:#9932CC;
    box-shadow:#9932CC !important;
}
.btn-primary:hover{
    background:purple;
    box-shadow:purple;
}
.btn-primary:active{
color:yellow;
}

</style>
  <tbody>
    <tr>
      <th scope="row">IDT</th>
      <td>Mark</td>
      <td>otto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
    </tr>
    <tr>
      <th scope="row">IDT</th>
      <td>Mark</td>
      <td>otto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
    </tr>
    <tr>
      <th scope="row">IDT</th>
      <td>Mark</td>
      <td>otto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
    </tr>
    <tr>
      <th scope="row">IDT</th>
      <td>Mark</td>
      <td>otto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
    </tr>
    <tr>
      <th scope="row">TeleSign</th>
      <td>mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
    </tr>
    
    <tr>
      <th scope="row">TeleSign</th>
      <td>mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
    </tr>
    <tr><tr>
      <th scope="row">TeleSign</th>
      <td>mdo</td>
      <td>OttoOttoOttoOttoOtto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
    </tr>
    <tr><tr>
      <th scope="row">TeleSign</th>
      <td>mdo</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
    </tr>
    <tr><tr>
      <th scope="row">TeleSign</th>
      <td>mdo</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
    </tr>
    <tr>
      <th scope="row">Twilio</th>
      <!-- <td colspan="2">Larry the Bird</td> -->
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>    </tr>
  </tbody>
</table>
  

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

</body>
</html>