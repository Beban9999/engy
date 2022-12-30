<?php
session_start();
require_once("f.php");
if (!prijavljen()) {
    header("Location: http://localhost/engy/index.php"); //HARDCODE PATH
    exit;
}
if(!validate_user()){
    header("Location: http://localhost/engy/index.php?odjava"); //HARDCODE PATH
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
    <link rel="icon" href="logo.png" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/footer.css" />
    
    <link rel="stylesheet" href="css/metricacss.css" />
    <link href="assets/plugins/nestable/jquery.nestable.min.css" rel="stylesheet" />




    <script src="jquary/jquary.js"></script>
    <script src="jquary/jquary.form.js"></script>
    <script src="jquary/functions.js"></script>


    <title>Dashboard</title>

</head>
<style>
    body {
        background: #E8E8E8;
    }

    .table>:not(:last-child)>:last-child>* {
        background-color: #6C4AB6;
        color: white;
        /* border: white;
    border-style: solid; */
        margin: auto;
        padding: 1em;

    }

    .table>thead {
        vertical-align: middle;
    }

    .table>tbody {
        vertical-align: middle !important;
    }

    .table {
        text-align: center;
        border: black;


    }

    .table th {
        font-weight: 0 !important;
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

    #action,
    #first {
        padding-left: 40px;
        padding-right: 40px;

    }

    #first {
        border-left: none;
    }

    #last {
        border-right: none;
    }

    #ins_customer {
        border-left: none;
    }

    #lastbutton {
        border-right: none;
    }

    #ins_customer,
    #ins_prod,
    #ins_traff,
    #ins_maincomp,
    #ins_dest,
    #ins_looking,
    #ins_pot,
    #ins_act,
    #ins_next,
    #ins_result,
    #ins_datecomm,
    #lastbutton {
        background: #8D72E1;
    }

    #archvInfo {
        position: fixed;
        bottom: 0%;
        right: 0%;
        visibility: hidden;
    }

    .card {
        border-radius: 5px;
    }
</style>


<body id="dashboard_body">
    <!-- onclick="removeNoti()" ...ADD TO REMOVE NOTIFICATIONS ON CLICK-->
    <!-- Navbar -->
    <?php
    navbar();
    ?>
    <div id="MetricaPages" class="main-icon-menu-pane">


    </div><!-- end Authentication-->
    </div>
    <!--end menu-body-->
    </div><!-- end main-menu-inner-->
    </div>
    <!-- end left-sidenav-->

    <div class="page-content">

        <div class="container-fluid">
            <!-- Page-Title -->
            <br>
            <h5 class="page-title">Dashboard</h5>

            <!-- end page title end breadcrumb -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="media">
                                        <div class="media-body align-self-center">
                                            <h5 class="card-title" style="text-align:center;color:black"><b><?php echo $_SESSION['username'] ?>'s Traffic</b></h5>

                                           <br>
                                            <div class="chart-demo">

                                                <div id="apex_mixed1" class="apex-charts"></div>
                                            </div>
                                        </div>
                                        <!--end media body-->
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end col-->



                            </div><!-- end row -->
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="card-title" style="text-align:center;color:black"><b><?php echo $_SESSION['username'] ?>'s traffic goal</b></h6>

                                    <img src="assets/images/widgets/p-1.png" alt="" height="186" class="mx-auto d-block mb-3">

                                    <p class="text-muted mb-3" style='text-align:center;font-size:16px;'><b>Write your monthly traffic.</b>
                                    <table class="table table-bordered mb-0 table-centered">
                                        <thead>
                                            <tr>
                                                <th style="background:#6c4ab6;color:white">Your Traffic</th>
                                                <th id='traffic_goal_title' style="background:#6c4ab6;color:white">Traffic Goal</th>
                                            </tr>
                                        </thead>
                                        <td id="your_traffic">
                                            <input id="your_traffic_input" placeholder="Your Traffic" class='form-control' type="number">
                                            <br>
                                            <button id='your_traffic_send' class='btn btn' style = background:#6c4ab6;color:white>Update</button>
                                            <div id='currGoalId' style='position:absolute; visibility:hidden'></div></td>
                                        <td id="traffic_goal"></td>
                                    </table>
                                    <br>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card-body-->
                </div>
            </div>
            <br>
            <div class='row'>
                <div class="col-lg-12">
                    <div class='card'>
                    <div class="card-body">


<style>
    .col-sm-2{
        width:-webkit-fill-available;
    }
</style>

<!-- OVDE POCINJE OTVARANJE I ONO ST SE OTVORI -->
<h4 class="page-title">Procurment</h4>

<div class="custom-dd" id="nestable_list_2">
                                        <ol class="dd-list">
                                            <li class="dd-item" data-id="2">
                                                <div class="dd-handle" style = font-size:18px>
                                                Clients name
                                            </div>
                                                <ol class="dd-list">
                                                    <li class="dd-item" data-id="3">
                                                    <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="card">
                                                                    <div class="card-body">        
                                                                        <h4 class="mt-0 header-title">Clients name</h4>
                                                                        <p class="text-muted mb-3">Procurment for client
                                                                        </p>
                                                                        
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <div class="form-group row">
                                                                                    <label for="example-text-input" class="col-sm-2 col-form-label text-right">Customer Name</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input class="form-control" type="text" value=" " id="example-text-input">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="example-email-input" class="col-sm-2 col-form-label text-right">Account Manager</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input class="form-control" type="email" value="bootstrap@example.com" id="example-email-input">
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="form-group row">
                                                                                    <label for="example-tel-input" class="col-sm-2 col-form-label text-right">eNgY Transit Sheet</label>
                                                                                    <div class="col-sm-10">
                                                                                    <input class="form-control" type="text" value=" " id="example-text-input">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="example-password-input" class="col-sm-2 col-form-label text-right">NDA</label>
                                                                                    <div class="col-sm-10">
                                                                                    <input class="form-control" type="text" value=" " id="example-text-input">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="example-number-input" class="col-sm-2 col-form-label text-right">VAT-/Register ID certificat</label>
                                                                                    <div class="col-sm-10">
                                                                                    <input class="form-control" type="text" value=" " id="example-text-input">
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="form-group row">
                                                                                    <label for="example-color-input" class="col-sm-2 col-form-label text-right">Service Agreement</label>
                                                                                    <div class="col-sm-10">
                                                                                    <input class="form-control" type="text" value=" " id="example-text-input">
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="form-group row">
                                                                                    <label for="example-search-input" class="col-sm-2 col-form-label text-right">Search</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input class="form-control" type="search" value=" ot web" id="example-search-input">
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="form-group row">
                                                                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">DPA (Data Protection Agreement)</label>
                                                                                    <div class="col-sm-10">
                                                                                    <input class="form-control" type="text" value=" " id="example-text-input">
                                                                                    </div>
                                                                                </div> 
                                                                                
                                                                               
                                                                                                                  
                                                                            </div>


                                                                            <div class="col-lg-6">
                                                                               
                                                                                <div class="form-group row">
                                                                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">Customer accounts</label>
                                                                                    <div class="col-sm-10">
                                                                                    <input class="form-control" type="text" value=" " id="example-text-input">
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="form-group row">
                                                                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">Supplier accounts</label>
                                                                                    <div class="col-sm-10">
                                                                                    <input class="form-control" type="text" value=" " id="example-text-input">
                                                                                    </div>
                                                                                </div>       
                                                                                <div class="form-group row">
                                                                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">Rate Sheet</label>
                                                                                    <div class="col-sm-10">
                                                                                    <input class="form-control" type="text" value=" " id="example-text-input">
                                                                                    </div>
                                                                                </div>                      
                                                                                <div class="form-group row">
                                                                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">Base Routing</label>
                                                                                    <div class="col-sm-10">
                                                                                    <input class="form-control" type="text" value=" " id="example-text-input">
                                                                                    </div>
                                                                                </div>                    
                                                                                <div class="form-group row">
                                                                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">Follow Up</label>
                                                                                    <div class="col-sm-10">
                                                                                    <input class="form-control" type="text" value=" " id="example-text-input">
                                                                                    </div>
                                                                                </div>  
                                                                                <div class="form-group row">
                                                                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">Action POINT</label>
                                                                                    <div class="col-sm-10">
                                                                                    <input class="form-control" type="text" value=" " id="example-text-input">
                                                                                    </div>
                                                                                </div>  
                                                                                <div class="form-group row">
                                                                                    <label for="example-datetime-local-input" class="col-sm-2 col-form-label text-right">Date and time</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input class="form-control" type="datetime-local" value="2011-08-19T13:45:00" id="example-datetime-local-input">
                                                                                    </div>
                                                                                </div> 
                                                                               
                                                                                <div class="form-group row">
                                                                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">Comments</label>
                                                                                    <div class="col-sm-10">
                                                                                    <input class="form-control" type="textarea" value=" " id="example-text-input">
                                                                                    </div>
                                                                                </div>  
                                                                            </div>
                                                                        </div>                         
                                                                                                                    
                                                                    </div><!--end card-body-->
                                                                </div><!--end card-->
                                                            </div><!--end col-->
                                                        </div><!--end row-->
                                                    </li>
                                                </ol>
                                            </li>
                                        </ol>
                                    </div>
                    <div class="custom-dd" style=font-size:24px id="nestable_list_1">
                                        <ol class="dd-list">
                                            <li class="dd-item" data-id="2">
                                                <div class="dd-handle">
                                                    Item 2
                                                </div>
                                                <ol class="dd-list">
                                                    <li class="dd-item" data-id="3">
                                                       <!-- end page title end breadcrumb -->
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="card">
                                                                    <div class="card-body">        
                                                                        <h4 class="mt-0 header-title">Textual inputs</h4>
                                                                        <p class="text-muted mb-3">Here are examples of <code class="highlighter-rouge">.form-control</code> applied to each
                                                                            textual HTML5 <code class="highlighter-rouge">&lt;input&gt;</code> <code class="highlighter-rouge">type</code>.
                                                                        </p>
                                                                        
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <div class="form-group row">
                                                                                    <label for="example-text-input" class="col-sm-2 col-form-label text-right">Text</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input class="form-control" type="text" value=" " id="example-text-input">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="example-email-input" class="col-sm-2 col-form-label text-right">Email</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input class="form-control" type="email" value="bootstrap@example.com" id="example-email-input">
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="form-group row">
                                                                                    <label for="example-tel-input" class="col-sm-2 col-form-label text-right">Telephone</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input class="form-control" type="tel" value="1-(555)-555-5555" id="example-tel-input">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="example-password-input" class="col-sm-2 col-form-label text-right">Password</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input class="form-control" type="password" value="hunter2" id="example-password-input">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="example-number-input" class="col-sm-2 col-form-label text-right">Number</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input class="form-control" type="number" value="42" id="example-number-input">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="example-datetime-local-input" class="col-sm-2 col-form-label text-right">Date and time</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input class="form-control" type="datetime-local" value="2011-08-19T13:45:00" id="example-datetime-local-input">
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="form-group row">
                                                                                    <label for="example-color-input" class="col-sm-2 col-form-label text-right">Color</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input class="form-control" type="color" value="#0e6bd4" id="example-color-input">
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="form-group row">
                                                                                    <label class="col-sm-2 col-form-label text-right">Select</label>
                                                                                    <div class="col-sm-10">
                                                                                        <select class="form-control">
                                                                                            <option>Select</option>
                                                                                            <option>Large select</option>
                                                                                            <option>Small select</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label class="col-sm-2 col-form-label text-right">Custom Select</label>
                                                                                    <div class="col-sm-10">
                                                                                        <select class="custom-select">
                                                                                            <option selected="">Open this select menu</option>
                                                                                            <option value="1">One</option>
                                                                                            <option value="2">Two</option>
                                                                                            <option value="3">Three</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="example-text-input-lg" class="col-sm-2 col-form-label text-right">Large</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg" id="example-text-input-lg">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="example-text-input-sm" class="col-sm-2 col-form-label text-right">Small</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm" id="example-text-input-sm">
                                                                                    </div>
                                                                                </div>                                   
                                                                            </div>


                                                                            <div class="col-lg-6">
                                                                                <div class="form-group row">
                                                                                    <label for="example-search-input" class="col-sm-2 col-form-label text-right">Search</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input class="form-control" type="search" value=" ot web" id="example-search-input">
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="form-group row">
                                                                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">URL</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input class="form-control" type="url" value="https://getbootstrap.com" id="example-url-input">
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="form-group row">
                                                                                    <label for="example-date-input" class="col-sm-2 col-form-label text-right">Date</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
                                                                                    </div>
                                                                                </div>
                                                                               
                                                                                <div class="form-group row">
                                                                                    <label for="example-week-input" class="col-sm-2 col-form-label text-right">Week</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input class="form-control" type="week" value="2011-W33" id="example-week-input">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="example-time-input" class="col-sm-2 col-form-label text-right">Time</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input class="form-control" type="time" value="13:45:00" id="example-time-input">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row has-success">
                                                                                    <label for="inputHorizontalSuccess" class="col-sm-2 col-form-label text-right">Email</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input type="email" class="form-control form-control-success" id="inputHorizontalSuccess" placeholder="name@example.com">
                                                                                        <div class="form-control-feedback">Success! You've done it.</div>
                                                                                        <small class="form-text text-muted">Example help text that remains unchanged.</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row has-warning">
                                                                                    <label for="inputHorizontalWarning" class="col-sm-2 col-form-label text-right">Email</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input type="email" class="form-control form-control-warning" id="inputHorizontalWarning" placeholder="name@example.com">
                                                                                        <div class="form-control-feedback">Shucks, check the formatting of that and try again.</div>
                                                                                        <small class="form-text text-muted">Example help text that remains unchanged.</small>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row has-error">
                                                                                    <label for="inputHorizontalDnger" class="col-sm-2 col-form-label text-right">Email</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input type="email" class="form-control form-control-danger" id="inputHorizontalDnger" placeholder="name@example.com">
                                                                                        <div class="form-control-feedback">Sorry, that username's taken. Try another?</div>
                                                                                        <small class="form-text text-muted">Example help text that remains unchanged.</small>
                                                                                    </div>
                                                                                </div>                                            
                                                                            </div>
                                                                        </div>                         
                                                                                                                    
                                                                    </div><!--end card-body-->
                                                                </div><!--end card-->
                                                            </div><!--end col-->
                                                        </div><!--end row-->
                                                    </li>
                                                    
                                                        </div>
                                                    </li>
                                                </ol>
                                            </li>    
                                        </ol>          
                                        
                            </div><!--nastable-list-1-->

                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="container-fluid">

            <h5>Message Board</h5>
            <div class='row'>
                <div class="col-lg-6">
                    <div class='card'>
                        <h5 class="card-title" style="text-align:center; margin-top:15px;"><b>Global Messages</b></h5>
                        <hr>
                        <div class="row" id="message_div_global" style="margin-left:1px;margin-top:15px;margin-right:1px;"></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class=card>
                        <h5 class="card-title" style="text-align:center; margin-top:15px;"><b>Private Messages</b></h5>
                        <hr>
                        <div class="row" id="message_div_private" style="margin-left:1px;margin-top:15px;margin-right:1px;"></div>
                    </div>
                </div>

            </div>
            <br>
            <!-- TABLE -->
            <h5>Client's Table</h5>

            <div class="card">

                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th id='first' scope="col"style="max-width:175px; padding:15px">Customer</th>
                            <th scope="col" style="max-width:75px; padding:0px">Product in use</th>
                            <th scope="col" >Traffic Volume</th>
                            <th scope="col"style="max-width:125px; padding:0px">Main Competitor</th>
                            <th scope="col"style="max-width:125px; padding:5px">Core Destinations</th>
                            <th scope="col"style="max-width:125px; padding:0px">Destinations Looking For</th>
                            <th scope="col"style="max-width:125px; padding:5px">Potential Destinations</th>
                            <th id="action" scope="col"style="max-width:200px; padding:30px">Action</th>
                            <th scope="col"style="max-width:175px; padding:30px">Next Step</th>
                            <th scope="col"style="max-width:175px; padding:30px">Result</th>
                            <th scope="col">Date/Comment</th>
                            <th id='last' scope="col">Archive</th>

                        </tr>
                    </thead>
                    <tr class="proba">
                        <th id='ins_customer' contenteditable style="max-width:1px; color:purple" scope="row"></th>
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
                        <td id='lastbutton'><button type="button" id='insertRow' class="btn btn-primary1 waves-effect waves-light" style="background:#2b55cc; color:white"> <i class="fas fa-plus"></i></button>
                        </td>

                    </tr>
                    <div id="insertResp"></div>
                    <tbody id="table_body">
                    </tbody>
                </table>
            </div>

                                                                                        </div>
            <!-- Navbar -->
            <!-- Chartovi -->

            <script src="assets/plugins/moment/moment.js"></script>
            <script src="assets/plugins/apexcharts/apexcharts.min.js"></script>
            <script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
            <script src="https://apexcharts.com/samples/assets/ohlc.js"></script>
            <script src="assets/pages/jquery.apexcharts.init.js"></script>
            <script src="assets/plugins/nestable/jquery.nestable.min.js"></script>
        <script src="assets/pages/jquery.nastable.init.js"></script>

            <script type="text/javascript" src="js/mdb.min.js"></script>
            <script type="text/javascript" src="js/loginscript.js"></script>
            <script>
                rows = ['customer', 'prod', 'traff', 'maincomp', 'dest', 'looking', 'pot', 'act', 'next', 'result', 'datecomm']


                // window.onbeforeunload = function () {
                // return 'Are you sure you want to leave?';
                // }
                function execUpdate(id, col) {
                    //console.log(document.getElementById(id+col).innerHTML);
                    let updateVal = document.getElementById(id + col).innerHTML;

                    $.post("ajax.php?f=execUpdate", {
                            id: id,
                            col: col,
                            updateVal: updateVal
                        },
                        function(response) {
                            $("#insertResp").html(response);
                        })
                }

                function deletePrivateMessageFrom(id) {
                    console.log("POKRENU")
                    $.post("ajax.php?f=deletePrivateMessageFrom", {
                        id: id
                    }, function(response) {
                        fillMessages(1);
                    })
                }
            </script>
            <div id="archvInfo" class="alert alert-success" role="alert">Successfully archived</div>

</body>

</html>