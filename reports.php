<?php
session_start();
require_once("f.php");
if (!prijavljen()) {
    header("Location: http://localhost/engy/index.php"); //HARDCODE PATH
    exit;
}
if(!validate_user()){
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
        <meta charset="utf-8" />
        <title>Reports</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A premium admin dashboard template by Mannatthemes" name="description" />
        <meta content="Mannatthemes" name="author" />
        <link rel="icon" href="logo.png" type="image/x-icon" />

         <!-- Sweet Alert -->
         <!-- <link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css"> -->
        <link href="assets/plugins/animate/animate.css" rel="stylesheet" type="text/css">
        <script src="js/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="css/sweetalert2.min.css">



        <!-- App css -->
    <link rel="stylesheet" href="css/mdb.min.css" />
     <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/footer.css" />
     <link rel="stylesheet" href="css/metricacss.css" />
    <script src="jquary/jquary.js"></script>
    <script src="jquary/jquary.form.js"></script>
    <script src="jquary/functions.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/info.js"></script>

    </head>

    <body>

    <div> <?php
    navbar();
    ?></div>

      <br>
            <!-- Page Content-->
            <div class="page-content">
            <div class="container-fluid">

                    <!-- end page title end breadcrumb -->


                    <p class="text-muted mb-3" style ='text-align:center;font-size:20px;'>Write your weekly reports.<br> <b>Don't forget to upload!</b>
                                    </p>
                                    <img src="assets/images/widgets/reporting.png" alt="" height="300" class="mx-auto d-block mb-3">

                    <div class="row">
                        <div class="col-12" >
                            <div class="card" >
                                <div class="card-body">


                                    <form method="post">
                                        <textarea id="elm1" name="area"></textarea>
                                        <br>
                                        <br>
                                        <button type="button"  class="btn btn-success" id="sendReportbtn" style= "position:absolute; right:1.5%; bottom:3.5%;">UPLOAD</button>
                                    </form>
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div> <!-- end col -->
                    </div> <!-- end row -->
</div>
                </div><!-- container -->


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

    </body>
</html>