<?php
    function prijavljen(){
        if(isset($_SESSION['user']) and isset($_SESSION['status'])){
            return true;
        }
        else{
            return false;
        }
    }
    function db_connect(){
        if($_SERVER["SERVER_NAME"] == "localhost"){
            return mysqli_connect("localhost", "root", "", "engy");
        }
        else{
            return mysqli_connect("localhost", "ngrubiicrs_grubi", "Grubi123.", "ngrubiicrs_engy");
        }
    }
    function validate_user(){
    $db = db_connect();

    if (!$db) {
        echo "ERROR WITH DB CONNECTION" . mysqli_connect_errno();
        echo "<br>" . mysqli_connect_error();
        exit();
    }

    mysqli_query($db, "SET NAMES utf8");
    $id = $_SESSION["id_user"];
    $stmt = $db->prepare("SELECT * FROM user WHERE id_user = ? and deleted_user = 0");
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $rez = $stmt->get_result();

    if (mysqli_num_rows($rez) > 0) {
        $red = mysqli_fetch_object($rez);
        if ($red->username != $_SESSION["username"] || $red->role != $_SESSION["status"] || $red->team != $_SESSION["team"]) {
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
}
    function page_validation(){
        if (!prijavljen()) {
            header("Location: http://".$_SERVER["SERVER_NAME"]."/engy/index.php");
            exit;
        }
        if (!validate_user()) {
            header("Location: http://".$_SERVER["SERVER_NAME"]."/engy/index.php?odjava");
            exit;
        }
    }
    function navbar()
    {
        echo '

         <style>
        .nav-link {
            font-size: 16px;
            color: #9932CC;
            font-weight: bold;
        }

        #'.explode(".",explode("/", $_SERVER['PHP_SELF'])[2])[0].'{
            color:black;
        }
        </style>

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
                    <a id="prijavljen" class="nav-link" href="prijavljen.php">Dashboard</a>
                </li>';

                if($_SESSION["team"] != "Developer"){

                    if($_SESSION["team"] != "CEO" && $_SESSION["team"] != "Vice President")
                    echo '<li class="nav-item">
                        <a id="reports" role="link" class="nav-link" href="reports.php">Reports</a>
                    </li>';


                    echo '<li class="nav-item">
                        <a id="archive" class="nav-link" href="archive.php">Archive</a>
                    </li>
                    ';
                }
                    if($_SESSION["status"] == 1){
                    echo '<li class="nav-item">
                            <a id="managment" class="nav-link" href="managment.php">Managment</a>
                            </li>
                            <li class="nav-item">
                            <a id="admin_panel" class="nav-link" href="admin_panel.php">Admin Panel</a>
                            </li>';
                    }
                    if($_SESSION['status'] == 2){
                    echo '<li class="nav-item">
                            <a id="managment" class="nav-link" href="managment.php">Managment</a>
                            </li>';
                    }
                echo '
                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->
            <div class="d-flex align-items-center">
                <div class="text-reset me-1"> Welcome
                <!-- Icon -->
            ';
                $team = $_SESSION['team'];
                $img = "img/";

                $db = db_connect();

                if (!$db) {
                    echo "ERROR WITH DB CONNECTION" . mysqli_connect_errno();
                    echo "<br>" . mysqli_connect_error();
                    exit();
                }

                mysqli_query($db, "SET NAMES utf8");

                $stmt = $db->prepare("SELECT * FROM user JOIN teams ON user.team = teams.team_name WHERE team = ?");
                $stmt->bind_param('s',$team);
                $stmt->execute();
                $rez = $stmt->get_result();

                if(mysqli_num_rows($rez) > 0){
                    $red = mysqli_fetch_object($rez);
                    $color = $red->color; $img.=$red->team_icon;
                }
                else{
                    $color = "red";
                    $img = "user.png";
                }



                // if($team == "CEO")              $color = 'black';
                // else if($team == "Vice President"){  $color = '#38b6ff'; $img = "img/VP.png";}
                // else if($team == "Sales Manager") {  $color = '#ff1616'; $img = "img/SM.png";}
                // else if($team == "Account Manager"){ $color = '#3d9e67'; $img = "img/AM.png";}
                // else if($team == "Developer"){       $color = '#004aad'; $img = "img/DEV.png";}

                echo '<span style="font-weight:bold; color:'.$color.'">'.$_SESSION['username'].'</span>';
                echo '
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
                    src="'.$img.'"
                    height="35"
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
        </nav>';
    }
?>