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
    <script src="jquary/jquary.js"></script>
    <script src="jquary/jquary.form.js"></script>
    <script src="jquary/functions.js"></script>
    

    <title>Dashboard</title>

</head>
<style>
    .nav-link {
        font-size: 16px;
        color: #9932CC;
    }
.table>:not(:last-child)>:last-child>*{
    background:gray;
    color:white;
    text-align:center;
    border:black;
    border-style:solid;
    margin:auto;
    padding:1em;
}
.table>thead{
    vertical-align:middle;
}
.table{
    text-align:center;
    border:black;
    
}
.table-hover>tbody>tr:hover>*{
    background:#9932CC;
    color:white;
}
.table-hover>tbody>tr{
    border:black;
    border-style:solid;
    
}
.btn-primary{
    background:#9932CC;
    box-shadow:#9932CC !important;
}
.btn-primary:hover{
    background:purple;
    box-shadow:purple;
}
.btn-primary:active{
color:yellow;
}
</style>


<body>
    <!-- Navbar -->
<?php
    navbar();
?>



 <!-- TABLE -->


<table class="table">
  <thead class="table-dark">
    <tr>
      <th scope="col">Customer</th>
      <th scope="col">Product in use</th>
      <th scope="col">Traffic Volume</th>
      <th scope="col">Main Competitor</th>
      <th scope="col">Core Destinations</th>
      <th scope="col">Destinations Looking For</th>
      <th scope="col">Potential Destinations</th>
      <th scope="col">Action</th>
      <th scope="col">Next Step</th>
      <th scope="col">Result</th>
      <th scope="col">Date/Comment</th>

    </tr>
</thead>
  <tbody>
    <tr>
      <th scope="row">IDT</th>
      <td>NENAD</td>
      <td>otto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
    </tr>
    <tr>
      <th scope="row">IDT</th>
      <td>Mark</td>
      <td>otto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
    </tr>
    <tr>
      <th scope="row">IDT</th>
      <td>Mark</td>
      <td>otto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
    </tr>
    <tr>
      <th scope="row">IDT</th>
      <td>Mark</td>
      <td>otto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
    </tr>
    <tr>
      <th scope="row">TeleSign</th>
      <td>mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
    </tr>
    
    <tr>
      <th scope="row">TeleSign</th>
      <td>mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
    </tr>
    <tr><tr>
      <th scope="row">TeleSign</th>
      <td>mdo</td>
      <td>OttoOttoOttoOttoOtto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
    </tr>
    <tr><tr>
      <th scope="row">TeleSign</th>
      <td>mdo</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
    </tr>
    <tr><tr>
      <th scope="row">TeleSign</th>
      <td>mdo</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
    </tr>
    <tr>
      <th scope="row">Twilio</th>
      <!-- <td colspan="2">Larry the Bird</td> -->
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>
      <td>Mark</td>    </tr>
  
  </tbody>
</table>






    <!-- Navbar -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/loginscript.js"></script>
    <!-- jQuery  -->
</body>

</html>