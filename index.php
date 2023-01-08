<?php

session_start();
require_once("f.php");

if(isset($_SESSION['user']) and isset($_SESSION['status']) and isset($_GET['odjava']) == false){
    header("Location: http://".$_SERVER['SERVER_NAME']."/engy/prijavljen.php"); //Za sada hardcode path
    exit;
  }

if(isset($_GET['odjava']) == true) {
  unset($_SESSION['user']);
  unset($_SESSION['status']);
  session_destroy();
  header("Location: http://".$_SERVER['SERVER_NAME']."/engy/index.php"); //Za sada hardcode path
  exit; // OVO JE NENAD
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Login</title>
  <script src="js/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="css/sweetalert2.min.css">
  <!-- MDB icon -->
  <link rel="icon" href="logo.png" type="image/x-icon" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="css/mdb.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <script src="jquary/jquary.js"></script>
  <script src="jquary/jquary.form.js"></script>
  <script src="jquary/functions.js"></script>

</head>

<style>

</style>
</head>
<body>
<section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="engy.png"
                    style="width: 185px;" alt="logo">
                    <br><br>
                    <h4 class="mt-1 mb-5 pb-1">Welcome Sales Warriors!</h4>
                    <b><p>Please login into your account</p></b>

                </div>


                  <div class="form-outline mb-4">
                    <input type="text" id="form2Example11" class="form-control" name="username"/>
                    <label class="form-label" for="form2Example11">Username</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="form2Example22" class="form-control" name="password" />
                    <label class="form-label" for="form2Example22">Password</label>
                  </div>
<br>
                  <div class="text-center pt-1 mb-5 pb-1">
                  <input type = 'submit' id='login' name='login' class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" value="Log in">
                  <div id="odgPrijava" name="odgPrijava"> </div>
                    <a class= "" href="#!" onclick="showAlert()">Forgot password?</a>
                  </div>
                  <?php
                  // if(isset($_GET['error'])== true){
                  //   echo '<div class="alert alert-danger" role="alert">
                  //   Username or password does not match!
                  // </div';
                  // }

                  // if(isset($_SESSION['user']) and isset($_SESSION['status'])){
                  //   echo '<div class="alert alert-danger" role="alert">
                  //   '.$_SESSION['user'].' '.$_SESSION['status'].'
                  // </div';
                  // }
                  ?>




              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <img src="assets/images/widgets/p-1.png" alt="" style = "max-width: 350px; width:100%;" class="img-fluid center-block d-block mx-auto">
                <h4 class="mb-4">“The way to get started is to quit talking and begin doing.” </h4>
                <p class="big mb-0">– Walt Disney</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--
    <form method = "post" action= "prijavise.php">
        <input type = 'text' name="username" placeholder="Unesite username"><br>
        <input type = 'password' name="password" placeholder="Unesite password"><br>
        <input type = 'submit' value="Prijavi se">
    </form> -->



  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script type="text/javascript" src="js/loginscript.js"></script>
  <script>
    document.getElementById("form2Example22").addEventListener("keypress", function(event) {
  // If the user presses the "Enter" key on the keyboard
  if (event.key === "Enter") {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("login").click();
  }
});

  </script>
</body>
</html>