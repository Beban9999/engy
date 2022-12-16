<?php
session_start();
$db = mysqli_connect("localhost", "root", "", "engy");

if (!$db) {
    echo "ERROR WITH DB CONNECTION" . mysqli_connect_errno();
    echo "<br>" . mysqli_connect_error();
    exit();
}

mysqli_query($db, "SET NAMES utf8");

$f = $_GET['f'];

if($f == "prijava"){
    $korIme = $_POST['korIme'];
    $pass = $_POST['pass'];

    $stmt = $db->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param('s', $korIme);
    $stmt->execute();

    $rez = $stmt->get_result();

    if(mysqli_num_rows($rez) > 0){
        $red = mysqli_fetch_object($rez);
        if($red->password != $pass){
            echo "Lozinka za korisnika $red->first_name $red->last_name nije ispravna!";
        }
        else{
            $_SESSION['user'] = "$red->first_name $red->last_name";
            $_SESSION['username'] = "$red->username";
            $_SESSION['status'] = $red->role;
            echo "prijavljen.php";
        }
    }
    else{
        echo "Korisnik ne postoji!";
    }
}
?>