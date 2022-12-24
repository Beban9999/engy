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

<body id="dashboard_body">
    <?php
    navbar();
    ?>


    <script src="assets/plugins/moment/moment.js"></script>
    <script src="assets/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
    <script src="https://apexcharts.com/samples/assets/ohlc.js"></script>
    <script src="assets/pages/jquery.apexcharts.init.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/loginscript.js"></script>

</body>

</html>