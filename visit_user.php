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
</style>


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
    <p id="visit_user" style="visibility:hidden; position:absolute;"><?php echo $_GET["user"] ?></p> <!--NE DIRAJ-->
    <div class="container-fluid">
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
                    </tr>
                </thead>
                <div id="insertResp"></div>
                <tbody id="table_body_visit">
                </tbody>
            </table>
        </div>

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
                    </tr>
                </thead>
                <div id="insertResp"></div>
                <tbody id="table_archive_body_visit">
                </tbody>
            </table>
        </div>
    </div>

    <script src="assets/pages/jquery.apexcharts.init.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/loginscript.js"></script>


</body>

</html>