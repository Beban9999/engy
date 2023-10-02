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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- MDB icon -->
    <link rel="icon" href="logo.png" type="image/x-icon" />
    <title>Managment</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->

    <link rel="stylesheet" href="css/mdb.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/metricacss.css" />
    <link href="/assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />






    <script src="jquary/jquary.js"></script>
    <script src="jquary/jquary.form.js"></script>
    <script src="jquary/functions.js"></script>


</head>
<style>
    body {
        background: #4B0082;
    }
</style>

<body>
    <?php
    navbar();

    if ($_SESSION["status"] == 3) {
        echo '
        <br>
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <h5 class="card-title" style="text-align:center; margin-top:15px;"><b>You do not have access to this page</b></h5>
                        <hr style="border-color: white">
                    </div>
                </div>
            </div>
        </div>';
        exit();
    }
    ?>
    <br>
    <!-- <button type="button" class="btn btn-primary">Launch demo modal</button> -->

    <!-- Modal -->
    <div class="modal fade col-lg-12" id="modalSetGoals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaltitle_for_report">Users's Goals</h5>
                </div>
                <div class="modal-body" style="margin:3px" id='modal_for_goals'>


                    <input type="text" name="" placeholder="Traffic goal" id="user_edit_first_name" class='form-control'>

                </div>
                <div class="modal-footer">
                    <p>Don't Forget to Update!</p>
                    <button type="button" class="btn btn-secondary" onclick="setUsersTrafficGoals()" data-dismiss="modal">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


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

    <div class="modal fade" id="exempleScroll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modal_heading" class="modal-title">Private Message</h5>

                </div>
                <div id="globalMessagesForUser" class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id='privateMessageHeader'>New </h5>

                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="privateMessageText"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="sendPrivateMessage" class="btn btn-primary" data-dismiss="modal">Send message</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row">


            <div class="col-lg-6" style="margin-bottom:15px">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style=text-align:center><b>Europe</b></h4>
                        <img src="img/europa.png" alt="" style = "max-width: 250px; width:100%;" class="img-fluid center-block d-block mx-auto">
                        <hr>
                        <div class="row">

                        


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" style="margin-bottom:15px">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style=text-align:center><b>Asia</b></h4>
                        <img src="img/asia.png" alt="" style = "max-width: 380px; width:100%;" class="img-fluid center-block d-block mx-auto">
                            <hr>
                        <div class="row">

                        


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" style="margin-bottom:15px">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style=text-align:center><b>North America</b></h4>
                        <img src="img/na.png" alt="" style = "max-width: 250px; width:100%;" class="img-fluid center-block d-block mx-auto">

                        <hr>
                        <div class="row">

                        


                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" style="margin-bottom:15px">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style=text-align:center><b>South America</b></h4>
                        <img src="img/sa.png" alt="" style = "max-width: 185px; width:100%;" class="img-fluid center-block d-block mx-auto">

                        <hr>
                        <div class="row">

                        


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" style="margin-bottom:15px">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style=text-align:center><b>Africa</b></h4>
                        <img src="img/africa.png" alt="" style = "max-width: 250px; width:100%;" class="img-fluid center-block d-block mx-auto">

                        <hr>
                        <div class="row">

                        


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style=text-align:center><b>Australia</b></h4>
                        <img src="img/australia.png" alt="" style = "max-width: 275px; width:100%;" class="img-fluid center-block d-block mx-auto">
                        <hr>
                        <div class="row">

                        


                        </div>
                    </div>
                </div>
            </div>


</body>
<script src="assets/plugins/moment/moment.js"></script>
<script src="assets/plugins/apexcharts/apexcharts.min.js"></script>
<script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
<script src="https://apexcharts.com/samples/assets/ohlc.js"></script>
<script src="assets/pages/jquery.apexcharts.init.js"></script>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/metisMenu.min.js"></script>
<script src="assets/js/waves.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>
<script type="text/javascript" src="js/loginscript.js"></script>


</html>