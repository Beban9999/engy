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
    <link rel="icon" href="logo.png" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/metricacss.css" />



    <script src="jquary/jquary.js"></script>
    <script src="jquary/jquary.form.js"></script>
    <script src="jquary/functions.js"></script>


    <title>Dashboard</title>

</head>
<style>
    body{
        background: #E8E8E8;
    }

    .table>:not(:last-child)>:last-child>* {
        background-color: #6C4AB6;
        color: white;
        /* border: white;
    border-style: solid; */
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

    .table th {
        font-weight: 0 !important;
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

    #action,
    #first {
        padding-left: 40px;
        padding-right: 40px;

    }

    #first {
        border-left: none;
    }

    #last {
        border-right: none;
    }

    #ins_customer {
        border-left: none;
    }

    #lastbutton {
        border-right: none;
    }

    #ins_customer,
    #ins_prod,
    #ins_traff,
    #ins_maincomp,
    #ins_dest,
    #ins_looking,
    #ins_pot,
    #ins_act,
    #ins_next,
    #ins_result,
    #ins_datecomm,
    #lastbutton {
        background: #8D72E1;
    }

    #archvInfo {
        position: fixed;
        bottom: 0%;
        right: 0%;
        visibility: hidden;
    }

    .card {
        border-radius: 5px;
    }
</style>


<body id="dashboard_body">
    <!-- onclick="removeNoti()" ...ADD TO REMOVE NOTIFICATIONS ON CLICK-->
    <!-- Navbar -->
    <?php
    navbar();
    ?>
    <div id="MetricaPages" class="main-icon-menu-pane">


    </div><!-- end Authentication-->
    </div>
    <!--end menu-body-->
    </div><!-- end main-menu-inner-->
    </div>
    <!-- end left-sidenav-->

    <div class="page-content">

        <div class="container-fluid">
            <!-- Page-Title -->
            <br>
            <h5 class="page-title">Dashboard</h5>

            <!-- end page title end breadcrumb -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="media">
                                        <div class="media-body align-self-center">
                                            <h5 class="card-title" style="text-align:center;color:black"><b><?php echo $_SESSION['username'] ?>'s Traffic</b></h5>
                                            <div class="chart-demo">
                                                <div id="apex_mixed1" class="apex-charts"></div>
                                            </div>
                                        </div>
                                        <!--end media body-->
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end col-->



                            </div><!-- end row -->
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="card-title" style="text-align:center;color:black"><b><?php echo $_SESSION['username'] ?>'s traffic goal</b></h6>
                                    <hr>
                                    <img src="assets/images/widgets/p-1.png" alt="" height="192" class="mx-auto d-block mb-3">

                                    <p class="text-muted mb-3" style='text-align:center;font-size:20px;'>Write your monthly traffic.<br> <b>Try to reach expected number</b>
                                    <table class="table table-bordered mb-0 table-centered">
                            <thead>
                                <tr>
                                    <th style = "background:#6c4ab6;color:white">Your Traffic</th>
                                    <th style = "background:#6c4ab6;color:white">Traffic Goal</th>
                                </tr>
                            </thead>
                            <td id="your_traffic"></td>
                            <td id="traffic_goal"></td>
                        </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card-body-->
                </div>
            </div>
            <br>

            <h5>Message Board</h5>
            <div class='row'>
                <div class="col-lg-6">
                    <div class='card' style=background:#6c4ab6>
                        <h5 class="card-title" style="text-align:center; margin-top:15px;color:white"><b>Global Messages</b></h5>
                        <hr style="border-color: white">
                        <div class="row" id="message_div_global" style="margin-left:1px;margin-top:15px;margin-right:1px;"></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class=card style=background:#6c4ab6>
                        <h5 class="card-title" style="text-align:center; margin-top:15px; color:white"><b>Private Messages</b></h5>
                        <hr style="border-color: white">
                        <div class="row" id="message_div_private" style="margin-left:1px;margin-top:15px;margin-right:1px;"></div>
                    </div>
                </div>

            </div>
            <br>
            <!-- TABLE -->
            <h5>Client's Table</h5>

            <div class="card">

                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th id='first' scope="col">Customer</th>
                            <th scope="col">Product in use</th>
                            <th scope="col">Traffic Volume</th>
                            <th scope="col">Main Competitor</th>
                            <th scope="col">Core Destinations</th>
                            <th scope="col">Destinations Looking For</th>
                            <th scope="col">Potential Destinations</th>
                            <th id="action" scope="col">Action</th>
                            <th scope="col">Next Step</th>
                            <th scope="col">Result</th>
                            <th scope="col">Date/Comment</th>
                            <th id='last' scope="col">Archive</th>

                        </tr>
                    </thead>
                    <tr class="proba">
                        <th id='ins_customer' contenteditable style="max-width:1px; color:purple" scope="row"></th>
                        <td id='ins_prod' contenteditable style="max-width:1px"></td>
                        <td id='ins_traff' contenteditable style="max-width:1px"></td>
                        <td id='ins_maincomp' contenteditable style="max-width:1px"></td>
                        <td id='ins_dest' contenteditable style="max-width:1px"></td>
                        <td id='ins_looking' contenteditable style="max-width:1px"></td>
                        <td id='ins_pot' contenteditable style="max-width:1px"></td>
                        <td id='ins_act' contenteditable style="max-width:1px"></td>
                        <td id='ins_next' contenteditable style="max-width:1px"></td>
                        <td id='ins_result' contenteditable style="max-width:1px"></td>
                        <td id='ins_datecomm' contenteditable style="max-width:1px"></td>
                        <td id='lastbutton'><button type="button" id='insertRow' class="btn btn-primary1 waves-effect waves-light" style="background:#2b55cc; color:white"> <i class="fas fa-plus"></i> ADD</button>
                        </td>

                    </tr>
                    <div id="insertResp"></div>
                    <tbody id="table_body">
                    </tbody>
                </table>
            </div>


            <!-- Navbar -->
            <!-- Chartovi -->

            <script src="assets/plugins/moment/moment.js"></script>
            <script src="assets/plugins/apexcharts/apexcharts.min.js"></script>
            <script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
            <script src="https://apexcharts.com/samples/assets/ohlc.js"></script>
            <script src="assets/pages/jquery.apexcharts.init.js"></script>

            <script type="text/javascript" src="js/mdb.min.js"></script>
            <script type="text/javascript" src="js/loginscript.js"></script>
            <script>
                rows = ['customer', 'prod', 'traff', 'maincomp', 'dest', 'looking', 'pot', 'act', 'next', 'result', 'datecomm']


                // window.onbeforeunload = function () {
                // return 'Are you sure you want to leave?';
                // }
                function execUpdate(id, col) {
                    //console.log(document.getElementById(id+col).innerHTML);
                    let updateVal = document.getElementById(id + col).innerHTML;

                    $.post("ajax.php?f=execUpdate", {
                            id: id,
                            col: col,
                            updateVal: updateVal
                        },
                        function(response) {
                            $("#insertResp").html(response);
                        })
                }

                function deletePrivateMessageFrom(id) {
                    console.log("POKRENU")
                    $.post("ajax.php?f=deletePrivateMessageFrom", {
                        id: id
                    }, function(response) {
                        fillMessages(1);
                    })
                }
            </script>
            <div id="archvInfo" class="alert alert-success" role="alert">Successfuly archived</div>

</body>

</html>