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

.nav-link{
font-size:16px;
color:#9932CC;
}
</style>
<body>
    
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0" href="#">
        <img
          src="engy.png"
          height="40"
          alt="eNgY Logo"
          loading="lazy"
        />
      </a>
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="prijavljen.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="reports.php">Reports</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="archive.php">Archive</a>
        </li>
        <?php
          if($_SESSION['status'] == 1){
            echo '<li class="nav-item">
                    <a class="nav-link" href="#">Managment</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Admin Panel</a>
                  </li>';
          }
          if($_SESSION['status'] == 2){
            echo '<li class="nav-item">
                    <a class="nav-link" href="#">Managment</a>
                  </li>';
          }
        ?>






      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->
    <div class="d-flex align-items-center">
      <div class="text-reset me-3"> Welcome
      <!-- Icon -->
        <?php
        $status = $_SESSION['status'];
        $color = 'green';
        if($status == 2) $color = 'blue';
        if($status == 1) $color = 'red';


        echo '<span style="color:'.$color.'">'.$_SESSION['username'].'</span>';
        ?>
      </div>
    </div>
    
      <!-- Avatar -->
      <div class="dropdown">
        <a
          class="dropdown-toggle d-flex align-items-center hidden-arrow"
          href="#"
          id="navbarDropdownMenuAvatar"
          role="button"
          data-mdb-toggle="dropdown"
          aria-expanded="false"
        >
          <img
            src="user.png"
            height="30"
            alt="Black and White Portrait of a Man"
            loading="lazy"
          />
        </a>
        <ul
          class="dropdown-menu dropdown-menu-end"
          aria-labelledby="navbarDropdownMenuAvatar">
          <li>
            <a class="dropdown-item" href="index.php?odjava">Logout</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->

  
<!-- Navbar -->
<script type="text/javascript" src="js/mdb.min.js"></script>
  <script type="text/javascript" src="js/loginscript.js"></script>
</body>
</html>