<?php
    function prijavljen(){
        if(isset($_SESSION['user']) and isset($_SESSION['status'])){
            return true;
        }
        else{
            return false;
        }
    }
    function navbar()
    {
        echo '<!-- Navbar -->
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
                ';
                    if($_SESSION["status"] == 1){
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
                echo '
                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->
            <div class="d-flex align-items-center">
                <div class="text-reset me-3"> Welcome
                <!-- Icon -->
            ';
                $status = $_SESSION['status'];
                $color = 'green';
                if($status == 2) $color = 'blue';
                if($status == 1) $color = 'red';
        
                echo '<span style="color:'.$color.'">'.$_SESSION['username'].'</span>';
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
        </nav>';
    }
?>