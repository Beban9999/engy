<?php
session_start();
require_once("f.php");
page_validation();
$db = db_connect();

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
    <meta charset="utf-8" />
    <title>Invoices</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A premium admin dashboard template by Mannatthemes" name="description" />
    <meta content="Mannatthemes" name="author" />
    <link rel="icon" href="logo.png" type="image/x-icon" />

    <!-- Sweet Alert -->
    <!-- <link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css"> -->
    <link href="assets/plugins/animate/animate.css" rel="stylesheet" type="text/css">
    <script src="js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link href="/assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <!-- App css -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="assets/css/checkbutton.css" />
    <link href="assets/plugins/jsgrid/jsgrid.min.css" rel="stylesheet">
    <link href="assets/plugins/jsgrid/jsgrid-theme.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/metricacss.css" />
    <script src="jquary/jquary.js"></script>
    <script src="jquary/jquary.form.js"></script>
    <script src="jquary/functions.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/info.js"></script>
      

</head>
<style>





</style>
<?php
    navbar();
    ?>
<br>
<div class="card text-center">
      <div class="card-body">
        <h3 class="card-title">Welcome <?php echo $_SESSION['username'];
                                        ?>!
          </h5><br>

          <img src="assets/images/widgets/calendar.png" alt="" style = "max-width:300px" class="img-fluid">
      </div>
      <div class="card-footer text-muted"><i>“a list of goods sent or <b>services provided</b>, with a statement of the sum due for these; a bill.”</i></div>
    </div>

    <script>
        
    </script>
<br>
<div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
    
                                    <h4 class="mt-0 header-title">Invoices Table</h4>
                                    <p class="text-muted mb-3">Add invoice for
                                        borders on all sides of the table and cells.
                                    </p>
    
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0 table-centered">
                                            <thead>
                                            <tr>
                                                <th><b>Invoice ID</b></th>
                                                <th>Company Name</th>
                                                <th>Date</th>
                                                <th>Order Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>#124781</td>
                                                <td>IDM</td>
                                                <td>25/11/2018</td>
                                                <td><span class="badge badge-soft-success">Approved</span></td>
                                                <td>
                                                <button class="btn btn-success"><i class="fas fa-check"></i></button>
                                                 <button class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteUser"><i class="fas fa-trash"></i></button></td>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#542136</td>
                                                <td>IDM</td>
                                                <td>19/11/2018</td>
                                               
                                                <td><span class="badge badge-soft-success">Approved</span></td>
                                                <td>
                                                <button class="btn btn-success"><i class="fas fa-check"></i></button>
                                                 <button class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteUser"><i class="fas fa-trash"></i></button></td>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#234578</td>
                                                <td>IDM</td>
                                                <td>11/10/2018</td>
                                                
                                                <td><span class="badge badge-soft-danger">Rejected</span></td>
                                                <td>
                                                <button class="btn btn-success"><i class="fas fa-check"></i></button>
                                                 <button class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteUser"><i class="fas fa-trash"></i></button></td>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#951357</td>
                                                <td>IDM</td>
                                                <td>03/12/2018</td>
                                                <td><span class="badge badge-soft-success">Approved</span></td>
                                
                                                <td>
                                                <button class="btn btn-success"><i class="fas fa-check"></i></button>
                                                 <button class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteUser"><i class="fas fa-trash"></i></button></td>

                                                </td>
                                                
                                            </tr>
                                            </tbody>
                                        </table><!--end /table-->
                                    </div><!--end /tableresponsive-->
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div> <!-- end col -->
                    </div> <!-- end row -->


  <div class="checkbox checkbox-success">
     <input id="checkbox3" type="checkbox">
     <label for="checkbox3">
                                                    
     </label>
</div>

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
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/loginscript.js"></script>
    <script src="assets/plugins/jsgrid/jsgrid.min.js"></script>
    
    <script src="assets/plugins/jsgrid/db.js"></script>
    <script src="assets/pages/jquery.jsgrid.init.js"></script>

</body>

</html>