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
    <title>FAQ</title>
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
    <link rel="stylesheet" href="css/metricacss.css" />
    <script src="jquary/jquary.js"></script>
    <script src="jquary/jquary.form.js"></script>
    <script src="jquary/functions.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/info.js"></script>

</head>
<?php
    navbar();
    ?>

<br>
<div class="page-content">

<div class="container-fluid">
<div class='row'>
                <div class="col-lg-12">
                    <br>
                <h4 class="card-title" style="text-align:center;"><b>Page is under construction, coming soon.</b></h4>

                        <br>
                        <br>                        <br>
                        <br>

                        <img src="assets/images/widgets/construction.png" alt="" style = "max-width: 1200px; width:100%;" class="img-fluid center-block d-block mx-auto">

                        
                  
                </div>

                </div>
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
   

</body>

</html>