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

$stmt = $db->prepare("SELECT * FROM user WHERE id_user = ?");
$stmt->bind_param("i", $_GET["user"]);
$stmt->execute();
$rez = $stmt->get_result();
$user_name_visit = "None";
$team_visit = "";
if (mysqli_num_rows($rez) > 0) {
    $red = mysqli_fetch_object($rez);
    $user_name_visit =  $red->username;
    $team_visit = $red->team;
}

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
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/metricacss.css" />



    <script src="jquary/jquary.js"></script>
    <script src="jquary/jquary.form.js"></script>
    <script src="jquary/functions.js"></script>



    <title>Visit User</title>
</head>
<style>
    body {
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

    .col-sm-2 {
        width: -webkit-fill-available;
    }

    .active_procurment {
        background-color: #4B0082 !important;
        color: white;
    }
</style>
<script src="assets/plugins/apexcharts/apexcharts.min.js"></script>
<script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
<script src="https://apexcharts.com/samples/assets/ohlc.js"></script>
<script src="assets/pages/jquery.apexcharts.init.js"></script>

<body id="dashboard_body">
    <?php
    navbar();



    if (!isset($_GET["user"])) {
        echo '
            <br>
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <h5 class="card-title" style="text-align:center; margin-top:15px;"><b>Invalid user</b></h5>
                            <hr style="border-color: white">
                        </div>
                    </div>
                </div>
            </div>';
        exit();
    }
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
    <div class="container-fluid">

    <div class="row">
                <div class="col-lg-12" style=overflow-y:auto>
                    <div class='card'>
                        <div class="card-body">
    <p class="text-muted mb-3" style='text-align:center;font-size:20px;'><b>You are at <?php echo $user_name_visit; ?>&apos;s Profile.</b>
    </p>
    <img src="assets/images/widgets/reporting.png" alt="" height="200" class="mx-auto d-block mb-3">
</div></div>
</div>
</div></div>



    <br>
    <p id="visit_user" style="visibility:hidden; position:absolute;"><?php echo $_GET["user"] ?></p> <!--DONT TOUCH YOU WILL DIE-->
    <div class="container-fluid">
        <div id="procurment_div">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 style=text-align:center><b>Check <?php echo $user_name_visit; ?>&apos;s Procurment.</b></h5>

                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3" style=overflow-y:auto>
                    <div class='card'>
                        <div class="card-body">
                            <div class="chat-box-left">
                                <img src="assets/images/widgets/p-1.png" alt="" height="186" class="mx-auto d-block mb-3">

                                <h5 style=text-align:center>Active</h5>
                                <br>
                                <div class="tab-content chat-list slimscroll" id="pills-tabContent" style=max-height:448px;overflow-y:scroll>
                                    <div id="general_chat">
                                        <div id="proc_table">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5 style=text-align:center>Archive</h5>
                                <br>
                                <div class="tab-content chat-list slimscroll" id="pills-tabContent" style=max-height:448px;overflow-y:scroll>
                                    <div id="general_chat">
                                        <div id="proc_table_arch">
                                        </div>
                                    </div>
                                </div>
                            </div>
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

        </div>


        <div id="traffic_div">
            <br>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">


                        <div class="row">
                            <div class="col-md-12">
                                <div class="media">
                                    <div class="media-body align-self-center">
                                        <h5 class="card-title" style="text-align:center;color:black">
                                            <b><?php echo $user_name_visit; ?>'s Traffic</b>
                                        </h5>

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

        </div>


        <br>

        <div id="clients_table_div">
            <div class="card">
                
                <br>
                <h4 class="card-title" style=text-align:center>Current Data</h4>
                <h6 class="card-title" style=text-align:center>Managers current actions </h6>

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
                        </tr>
                    </thead>
                    <div id="insertResp"></div>
                    <tbody id="table_body_visit">
                    </tbody>
                </table>
            </div>
            <br>
            <div class="card">
                <br>
                <h4 class="card-title" style=text-align:center>Archived Data</h4>
                <h6 class="card-title" style=text-align:center>Managers past actions </h6>

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
                        </tr>
                    </thead>
                    <div id="insertResp"></div>
                    <tbody id="table_archive_body_visit">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="assets/pages/jquery.apexcharts.init.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/loginscript.js"></script>
    <script>
        function fillEditProcForm(id, elem) {
            console.log(elem)
            old_elem = document.getElementsByClassName('active_procurment')[0];
            if (old_elem) {
                old_elem.classList.remove("active_procurment")
            }
            elem.classList.add("active_procurment")

            $.post("ajax.php?f=fillEditProcFormArch", {
                    id: id,
                },
                function(response) {
                    $("#proc_edit_form_arch").html(response);
                    document.getElementById("archiveProcBtn").remove();
                })
        }
    </script>
    <?php
    if (strpos($team_visit, "Procurement") !== false) {
        echo '
                <script>
                document.getElementById("clients_table_div").remove();
                document.getElementById("traffic_div").remove();
                </script>
                ';
    }
    if ($team_visit == "CEO" || $team_visit == "Vice President") {
        echo '
                <script>
                document.getElementById("traffic_div").remove();
                </script>
                ';
    }
    if ($team_visit == "Account Manager" || $team_visit == "Sales Manager") {
        echo '
                <script>
                document.getElementById("procurment_div").remove();
                </script>
                ';
    }
    ?>
</body>

</html>