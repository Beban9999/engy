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

<style>
    body {
    background: #E8E8E8;
}
</style>

<body>

    <div> <?php
            navbar();
            ?></div>

    <br>
    <div class="modal fade col-lg-12" id="exampleModalreport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaltitle_for_report">Users's Report</h5>
                </div>
                <div class="modal-body" style="margin:3px" id='modal_for_report'>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Content-->
    <div class="page-content">
        <div class="container-fluid">

            <!-- end page title end breadcrumb -->
            <div class='row'>

                <div class="col-lg-12">
                    <div class='card'>
                    <div class="card-body">

                            <p class="text-muted mb-3" style='text-align:center;font-size:20px;'>Write your weekly reports.<br> <b>Don't forget to upload!</b>
                            </p>
                            <img src="assets/images/widgets/reporting.png" alt="" style = "max-width: 350px; width:100%;" class="img-fluid center-block d-block mx-auto">
                            </div><!--end card-->
                                </div> <!-- end col -->
</div>

            </div>
           <br>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                        <h5 class="modal-title" id="modaltitle_for_report"><b>Write report for this week. It will be visible on Friday!</b></h5>
<br>

                                            <form method="post">
                                                <textarea id="elm1" name="area"></textarea>
                                                <br>
                                                <br>

                                                <button type="button" class="btn btn-success" id="sendReportbtn" style="position:absolute; right:1.5%; bottom:3.5%;">UPLOAD</button>
                                            </form>
                                        </div><!--end card-body-->
                                    </div><!--end card-->
                                </div> <!-- end col -->
                            </div> <!-- end row -->


        </div>
        <br>
        <div class="container-fluid">

        <div class="col-lg-12">
                    <div class='card'>
                    <div class='card-body'>

                    <h5 class="modal-title" id="modaltitle_for_report" style = text-align:center>Report History</h5>
                    <hr>
                            <div id="report_preview_for_user" style = overflow-x:scroll>
                            </div>
                    </div>
</div>
                </div>
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
    <script>
        function viewReportForUser(week, userID, userName) {
            $("#modaltitle_for_report").html(userName + "'s Report")
            $.post("ajax.php?f=viewReportForUser", {
                week: week,
                userID,
                userID
            }, function(response) {
                $("#modal_for_report").html(response);
            })
        }
    </script>

</body>

</html>