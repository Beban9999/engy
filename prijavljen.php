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

    .table>:not(:last-child)>:last-child>* { 
    background-color:#6C4AB6;
    color: white;
    /* border: white;
    border-style: solid; */
    margin: auto;
    padding: 1em;

  }
    
    .table>thead {
        vertical-align: middle;
    }
    .table>tbody{
      vertical-align:middle !important;
    }
    .table {
        text-align: center;
        border: black;


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

    #action {
        padding-left: 130px;
        padding-right: 130px;

    }
    
#first{
    border-left:none;
}
#last{
    border-right:none;
}
#ins_customer{
  border-left:none;
}
#lastbutton{
  border-right:none;
}
#ins_customer, #ins_prod,#ins_traff,#ins_maincomp,#ins_dest,#ins_looking,#ins_pot,#ins_act,#ins_next,#ins_result,#ins_datecomm,#lastbutton{
  background:#8D72E1;
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
                <th id = 'first' scope="col">Customer</th>
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
                <th id = 'last' scope="col">Archive</th>

            </tr>
        </thead>
        <tr class = "proba">
                <th id='ins_customer' contenteditable style="max-width:1px" scope="row"></th>
                <td id='ins_prod' contenteditable style="max-width:1px"></td>
                <td id='ins_traff' contenteditable style="max-width:1px"></td>
                <td id='ins_maincomp' contenteditable style="max-width:1px"></td>
                <td id='ins_dest' contenteditable style="max-width:1px"></td>
                <td id='ins_looking' contenteditable style="max-width:1px"></td>
                <td id='ins_pot' contenteditable style="max-width:1px"></td>
                <td id='ins_act' contenteditable style="max-width:1px"></td>
                <td id='ins_next' contenteditable style="max-width:1px"></td>
                <td id='ins_result' contenteditable style="max-width:1px"></td>
                <td id='ins_datecomm' contenteditable style="max-width:1px"></td>
                <td id='lastbutton'><button id='insertRow'>ADD</button></td>
            </tr>
            <div id="insertResp"></div>
        <tbody id="table_body">
        </tbody>
    </table>


    <!-- Navbar -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/loginscript.js"></script>
    <script>
        rows = ['customer', 'prod','traff' ,'maincomp','dest' ,'looking' ,'pot' ,'act' ,'next' ,'result' ,'datecomm']

        function sendToArch(rownum) {
            for(i = 0; i < 11; i++)
            {
                let elemid = rownum+rows[i];
                //console.log(document.getElementById(rownum+rows[i]).innerHTML);
            }
        }
    </script>
    <!-- jQuery  -->
</body>

</html>