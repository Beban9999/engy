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



    <title>Admin Panel</title>
</head>
<style>
    body{
        background:#003060;
    }
</style>


<body id="dashboard_body">
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
<div class="container-fluid">

<div class='row'>

                <div class="col-lg-8">
                    <div class='card'>
                        <h5 class="card-title" style="text-align:center; margin-top:15px;"><b>Welcome Administrator</b></h5>
                        <hr style="border-color: white">
                        <div class="card">
                        <div class="col-lg-6">

                                <div class="card-body">
                                    <h4 class="header-title mt-0"style=text-align:center>Aplication Users</h4>
                                    <div id="ana_device" class="apex-charts"></div>
                                    <div class="table-responsive mt-4">
                                        <table class="table mb-0">
                                            <thead class="thead-light">
                                            <tr style = background:purple;color:white>
                                                <th>Role</th>
                                                <th>Number of Users</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">Administrators</th>
                                                <td>1</td>

                                            </tr>
                                            <tr>
                                                <th scope="row">Managers</th>
                                                <td>3</td>

                                            </tr>
                                            <tr>
                                                <th scope="row">Users</th>
                                                <td>5</td>

                                            </tr>

                                            </tbody>
                                        </table><!--end /table-->
                                    </div>
</div>
                                </div><!--end card-body-->
                            </div><!--end card-->
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class='card'>
                        <br>
                    <img src="assets/images/widgets/admin.png" alt="" height="330" class="mx-auto d-block mb-3">

                        <hr style="border-color: white">
                    </div>
                </div>

            </div>

</div>
            <br>


    <script src="assets/pages/jquery.apexcharts.init.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/loginscript.js"></script>


</body>

</html>