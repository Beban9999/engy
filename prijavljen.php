<?php
session_start();
require_once("f.php");
if (!prijavljen()) {
    header("Location: http://localhost/engy/index.php"); //HARDCODE PATH
    exit;
}
if (!validate_user()) {
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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
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
.col-sm-2 {
    width: -webkit-fill-available;
}
.active_procurment{
    background-color: #4B0082 !important;
    color:white;
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
                                            <h5 class="card-title" style="text-align:center;color:black">
                                                <b><?php echo $_SESSION['username'] ?>'s Traffic</b></h5>

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
                                    <h6 class="card-title" style="text-align:center;color:black">
                                        <b><?php echo $_SESSION['username'] ?>'s traffic goal</b></h6>

                                    <img src="assets/images/widgets/p-1.png" alt="" height="184"
                                        class="mx-auto d-block mb-3">

                                    <p class="text-muted mb-3" style='text-align:center;font-size:16px;'><b>Write your
                                            monthly traffic.</b>
                                    <table class="table table-bordered mb-0 table-centered">
                                        <thead>
                                            <tr>
                                                <th style="background:#6c4ab6;color:white">Your Traffic</th>
                                                <th id='traffic_goal_title' style="background:#6c4ab6;color:white">
                                                    Traffic Goal</th>
                                            </tr>
                                        </thead>
                                        <td id="your_traffic">
                                            <input id="your_traffic_input" placeholder="Your Traffic"
                                                class='form-control' type="number">
                                            <br>
                                            <button id='your_traffic_send' class='btn btn'
                                                style=background:#6c4ab6;color:white>Update</button>
                                            <div id='currGoalId' style='position:absolute; visibility:hidden'></div>
                                        </td>
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
                    <div class='card' style = background:#4B0082>
                        <div class="card-body">
                        <div class="col-lg-12">


                                    <div class="card text-center">
                                    <div class="card-body">
                                    <h3 class="card-title">Welcome to Procurment <?php echo $_SESSION['username'];
                                    ?>!
                                    </h3><br>

                                    <img src="assets/images/widgets/calendar.png" alt="" height="200" class="mx-auto d-block mb-3">
                                    </div>
                                    <div class="card-footer text-muted"><i>“Organizational Procurement is a tight balancing act between <b>“cost and quality”</b> on one side and <b>“time and compliance”</b> on the other side, yet a seasoned procurement specialist keeps it evenly balanced.”</i></div>
                                    </div>
</div>
<br>
                            <div class='row'>
                                <div class="col-lg-3" style=overflow-y:auto>
                                    <div class='card'>
                                        <div class="card-body">
                                            <div class="chat-box-left">
                                                <img src="assets/images/widgets/p-1.png" alt="" height="186"
                                                    class="mx-auto d-block mb-3">

                                                <h5 style=text-align:center>Clients List</h5>
                                                <br>
                                                <div class="tab-content chat-list slimscroll" id="pills-tabContent"
                                                    style=max-height:448px;overflow-y:scroll>
                                                    <div id="general_chat">


                                                        <div class="col-lg-12">
                                                            <div class='card active_procurment' onclick="fillEditProcForm(0, this)" style=border:solid;margin-bottom:5px>
                                                                <div class="card-body">

                                                                    <div class="media new-message">
                                                                        <div class="media-left">
                                                                        </div><!-- media-left -->
                                                                        <div class="media-body">
                                                                            <h6
                                                                                style=text-align:center;margin-bottom:0px>
                                                                                <i class="fas fa-plus"></i></h6>
                                                                        </div><!-- end media-body -->
                                                                    </div>
                                                                    <!--end media-->
                                                                </div>
                                                            </div>
                                                        </div>
    <hr>

                                                        <div id="proc_table">
                                                        </div>



                                                    </div>
                                                    <!--end personal chat-->
                                                </div>
                                                <!--end tab-content-->
                                            </div>
                                            <!--end chat-box-left -->

                                        </div>
                                    </div>
                                </div>



                                <div class="col-lg-9">
                                    <div class=card>
                                        <div class="card-body" id="proc_edit_form">
                                        <h4>Add new client</h4>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label for="example-text-input"
                                                            class="col-sm-2 col-form-label text-right">Customer
                                                            Name</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" value=""
                                                                id="cust_name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="example-email-input"
                                                            class="col-sm-2 col-form-label text-right">Account
                                                            Manager</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="email" value=""
                                                                id="acc_men">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="example-tel-input"
                                                            class="col-sm-2 col-form-label text-right">eNgY Transit
                                                            Sheet</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" value=""
                                                                id="trans_sheet">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="example-password-input"
                                                            class="col-sm-2 col-form-label text-right">NDA</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" value="" id="nda">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="example-number-input"
                                                            class="col-sm-2 col-form-label text-right">VAT-/Register ID
                                                            certificat</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" value="" id="vat">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="example-color-input"
                                                            class="col-sm-2 col-form-label text-right">Service
                                                            Agreement</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" value=""
                                                                id="serv_agr">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="example-search-input"
                                                            class="col-sm-2 col-form-label text-right">Search</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="search" value=""
                                                                id="search">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="example-url-input"
                                                            class="col-sm-2 col-form-label text-right">DPA (Data
                                                            Protection Agreement)</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" value="" id="dpa">
                                                        </div>
                                                    </div>



                                                </div>


                                                <div class="col-lg-6">

                                                    <div class="form-group row">
                                                        <label for="example-url-input"
                                                            class="col-sm-2 col-form-label text-right">Customer
                                                            accounts</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" value=""
                                                                id="cust_acc">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="example-url-input"
                                                            class="col-sm-2 col-form-label text-right">Supplier
                                                            accounts</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" value=""
                                                                id="supp_acc">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="example-url-input"
                                                            class="col-sm-2 col-form-label text-right">Rate
                                                            Sheet</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" value=""
                                                                id="rate_sheett">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="example-url-input"
                                                            class="col-sm-2 col-form-label text-right">Base
                                                            Routing</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" value=""
                                                                id="base_rout">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="example-url-input"
                                                            class="col-sm-2 col-form-label text-right">Follow Up</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" value=""
                                                                id="follow_up">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="example-url-input"
                                                            class="col-sm-2 col-form-label text-right">Action
                                                            POINT</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" value=""
                                                                id="act_point">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="example-url-input"
                                                            class="col-sm-2 col-form-label text-right">Comments</label>
                                                        <div class="col-sm-10">
                                                            <textarea name="" class="form-control" id="comment"
                                                                cols="30" rows="5"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row" style=text-align:right;margin-top:5px>
                                                        <div class="col-sm-10">
                                                            <button class="btn btn-success"
                                                                onclick="addNewProc()">Add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





            <br>
        </div>
        <br>


        <div class="container-fluid">
            <h5>Message Board</h5>
            <div class='row'>
                <div class="col-lg-6">
                    <div class='card'>

                        <h5 class="card-title" style="text-align:center; margin-top:15px;"><b>Global Messages</b></h5>
                        <hr>
                        <img src="assets/images/widgets/login.png" alt="" height="250" class="mx-auto d-block mb-3">

                        <div class="row" id="message_div_global"
                            style="margin-left:1px;margin-top:15px;margin-right:1px;"></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class=card>
                        <h5 class="card-title" style="text-align:center; margin-top:15px;"><b>Private Messages</b></h5>
                        <hr>

                        <img src="assets/images/widgets/close.jpg" alt="" height="250" class="mx-auto d-block mb-3">

                        <div class="row" id="message_div_private"
                            style="margin-left:1px;margin-top:15px;margin-right:1px;"></div>
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
                            <th id='first' scope="col" style="max-width:175px; padding:15px">Customer</th>
                            <th scope="col" style="max-width:75px; padding:0px">Product in use</th>
                            <th scope="col">Traffic Volume</th>
                            <th scope="col" style="max-width:125px; padding:0px">Main Competitor</th>
                            <th scope="col" style="max-width:125px; padding:5px">Core Destinations</th>
                            <th scope="col" style="max-width:125px; padding:0px">Destinations Looking For</th>
                            <th scope="col" style="max-width:125px; padding:5px">Potential Destinations</th>
                            <th id="action" scope="col" style="max-width:200px; padding:30px">Action</th>
                            <th scope="col" style="max-width:175px; padding:30px">Next Step</th>
                            <th scope="col" style="max-width:175px; padding:30px">Result</th>
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
                        <td id='lastbutton'><button type="button" id='insertRow'
                                class="btn btn-primary1 waves-effect waves-light"
                                style="background:#2b55cc; color:white"> <i class="fas fa-plus"></i></button>
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


        <script type="text/javascript" src="js/mdb.min.js"></script>
        <script type="text/javascript" src="js/loginscript.js"></script>
        <script>
        rows = ['customer', 'prod', 'traff', 'maincomp', 'dest', 'looking', 'pot', 'act', 'next', 'result', 'datecomm']

        function changeTitle(id, col) {
            let updateVal = $("#" + col + "_" + id).val();
            $("#proc_title_" + id).html(updateVal);
            $("#proc_field_" + id).html(updateVal);
        }

        function fillEditProcForm(id, elem){
            console.log(elem)
            old_elem = document.getElementsByClassName('active_procurment')[0];
            old_elem.classList.remove("active_procurment")
            elem.classList.add("active_procurment")

            $.post("ajax.php?f=fillEditProcForm", {
                    id: id,
                },
                function(response) {
                    $("#proc_edit_form").html(response);
                })
        }

        function updateProcField(id, col) {
            let updateVal = $("#" + col + "_" + id).val();
            // if(col == "cust_name"){
            //     updateVal = document.getElementById(col+ "_"+id).innerHTML;
            // }
            console.log(id, col, updateVal);

            $.post("ajax.php?f=updateProcValues", {
                    id: id,
                    col: col,
                    updateVal: updateVal
                },
                function(response) {
                    console.log(response);
                })

        }

        function addNewProc() {
            let cust_name = $("#cust_name").val();
            let acc_men = $("#acc_men").val();
            let trans_sheet = $("#trans_sheet").val();
            let nda = $("#nda").val();
            let vat = $("#vat").val();
            let serv_agr = $("#serv_agr").val();
            let search = $("#search").val();
            let dpa = $("#dpa").val();
            let cust_acc = $("#cust_acc").val();
            let supp_acc = $("#supp_acc").val();
            let rate_sheett = $("#rate_sheett").val();
            let base_rout = $("#base_rout").val();
            let follow_up = $("#follow_up").val();
            let act_point = $("#act_point").val();
            let comment = $("#comment").val();

            console.log(
                cust_name,
                acc_men,
                trans_sheet,
                nda,
                vat,
                serv_agr,
                search,
                dpa,
                cust_acc,
                supp_acc,
                rate_sheett,
                base_rout,
                follow_up,
                act_point,
                comment
            )
            $.post("ajax.php?f=insertProcRow", {
                    cust_name: cust_name,
                    acc_men: acc_men,
                    trans_sheet: trans_sheet,
                    nda: nda,
                    vat: vat,
                    serv_agr: serv_agr,
                    search: search,
                    dpa: dpa,
                    cust_acc: cust_acc,
                    supp_acc: supp_acc,
                    rate_sheett: rate_sheett,
                    base_rout: base_rout,
                    follow_up: follow_up,
                    act_point: act_point,
                    comment: comment
                },
                function(response) {
                    fillProcTable();
                    console.log(response);
                })
        }
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

        <script src="assets/plugins/nestable/jquery.nestable.min.js"></script>
        <script src="assets/pages/jquery.nastable.init.js"></script>
</body>

</html>