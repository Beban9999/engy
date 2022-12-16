<?php
    function prijavljen(){
        if(isset($_SESSION['user']) and isset($_SESSION['status'])){
            return true;
        }
        else{
            return false;
        }
    }
    function loged()
    {
        if (prijavljen()) {
        }
    }
?>