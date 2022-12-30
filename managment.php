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
    <link rel="icon" href="logo.png" type="image/x-icon" />
    <title>Managment</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->

    <link rel="stylesheet" href="css/mdb.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/metricacss.css" />
    <link href="/assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />






    <script src="jquary/jquary.js"></script>
    <script src="jquary/jquary.form.js"></script>
    <script src="jquary/functions.js"></script>


</head>
<style>
    body {
        background: #E8E8E8;
    }
</style>

<body>
    <?php
    navbar();

    if ($_SESSION["status"] == 3) {
        echo '
        <br>
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <h5 class="card-title" style="text-align:center; margin-top:15px;"><b>You do not have access to this page</b></h5>
                        <hr style="border-color: white">
                    </div>
                </div>
            </div>
        </div>';
        exit();
    }
    ?>
    <br>
    <!-- <button type="button" class="btn btn-primary">Launch demo modal</button> -->

    <!-- Modal -->
    <div class="modal fade col-lg-12" id="modalSetGoals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaltitle_for_report">Users's Goals</h5>
                </div>
                <div class="modal-body" style="margin:3px" id='modal_for_goals'>


                    <input type="text" name="" placeholder="Traffic goal" id="user_edit_first_name" class='form-control'>

                </div>
                <div class="modal-footer">
                    <p>Don't Forget to Update!</p>
                    <button type="button" class="btn btn-secondary" onclick="setUsersTrafficGoals()" data-dismiss="modal">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade col-lg-12" id="exampleModalreport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaltitle_for_report">Users's Report</h5>
                </div>
                <div class="modal-body" style="border:solid 3px;margin:3px" id='modal_for_report'>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exempleScroll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modal_heading" class="modal-title">Private Message</h5>

                </div>
                <div id="globalMessagesForUser" class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id='privateMessageHeader'>New </h5>

                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="privateMessageText"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="sendPrivateMessage" class="btn btn-primary" data-dismiss="modal">Send message</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style=text-align:center>Welcome <b> <?php echo $_SESSION['username']; ?> to the Managment</b> </h4>
                        <br>
                        <div class="row">


                            <div class="col-lg-6">
                                <div class="card">
                                    <img src="assets/images/widgets/p-3.png" alt="" height="100" class="img-fluid">
                                    <div class="card-body product-info">
                                        <br>
                                        <h4 class="product-title" style=text-align:center> Set Traffic Goals</h4>
                                        <h5 class="card-title" style=text-align:center> Month:<b> <?php echo date("F", time()) ?></b> </h5>
                                        <hr>
                                        <button onclick="openAndSetUserGoals()" type="submit" class="btn btn-primary btn-block px-2" data-toggle="modal" data-target="#modalSetGoals" style="background:#6c4ab6;color:white"><b>Open Table</b></button>

                                    </div>
                                    <!--end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->


                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title" style="text-align:center">Global Message</h4>
                        <img src="assets/images/widgets/login.png" alt="" height="209" class="mx-auto d-block mb-3">
                        <br>
                        <br>

                        <div class="form-group row">

                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="globalMessageText" rows="6" placeholder="Your message"></textarea>
                        </div>

                        <button type="submit" id="sendGlobalMessage" class="btn btn-primary btn-block px-4" style="background:#6c4ab6;color:white;font-weight:bold">Send Message</button>
                        <button type="button" id='checkGlobalMessages' class="btn btn-primary btn-block px-4" data-toggle="modal" data-target="#exempleScroll" style="background:darkred;font-weight:bold">
                            Remove your Global Messages
                        </button>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
        <br>
    </div>


    <div class="container-fluid">
        <!--TABLE -->
        <div class="row">
            <div class="col-12">
                <div class="card" style="border-radius:1px;">
                    <!-- <div class="card-body"> -->

                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead class="thead-light" style="background:#6c4ab6;color:white">
                                <tr>
                                    <th>Users</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Message User</th>
                                    <th>Visit Page</th>
                                </tr>
                            </thead>
                            <tbody id="users_table">
                            </tbody>
                        </table>
                        <!--end /table-->
                    </div>
                    <!--end /tableresponsive-->
                    <!-- </div>end card-body -->
                </div>
                <!--end card-->
            </div> <!-- end col -->
        </div>
        <!--end row-->
        <div style="visibility:hidden" id="clickedUserId">TEST2</div>



        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Weekly Reports</h4>
                    <p class="text-muted mb-3">Preview all employees week reports, sorted by last 4 weeks.
                    </p>

                    <div class="table-responsive">
                        <table id="reports_table" class="table table-bordered mb-0 table-centered">

                        </table>
                        <!--end /table-->
                    </div>
                    <!--end /tableresponsive-->
                </div>



            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div> <!-- end col -->
    </div> <!-- end row -->
    <div id="user_report_div"></div>
    <br>
    </div>
</body>
<script src="assets/plugins/moment/moment.js"></script>
<script src="assets/plugins/apexcharts/apexcharts.min.js"></script>
<script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
<script src="https://apexcharts.com/samples/assets/ohlc.js"></script>
<script src="assets/pages/jquery.apexcharts.init.js"></script>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/metisMenu.min.js"></script>
<script src="assets/js/waves.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>
<script type="text/javascript" src="js/loginscript.js"></script>
<script>
    function setUsersTrafficGoals() {
        var allInps = document.getElementById('modal_for_goals').getElementsByTagName('input');
        var prevGoals = document.getElementById('modal_for_goals').getElementsByTagName('span');
        for (var i = 0; i < allInps.length; i++) {

            var id_user = allInps[i].id.split("_")[2]
            var traffic_value = allInps[i].value
            var old_goal = prevGoals[i].id.split("_")[3];
            //console.log(id_user, traffic_value, old_goal)

            $.post("ajax.php?f=trafficSetNewValues", {
                id_user: id_user,
                traffic_value: traffic_value,
                old_goal: old_goal
            }, function(response) {
                console.log(response)
            })


        }
    }

    function openAndSetUserGoals() {
        $.post("ajax.php?f=openAndSetUserGoals", function(response) {
            $("#modal_for_goals").html(response)
        })
    }

    //<h4 id = 'privateMessageHeader' class="mt-0 header-title" style = "text-align:center">Private Message to USER</h4>
    function saveClickedUserInfo(clickedUser, userId) {
        document.getElementById("privateMessageHeader").innerHTML = "Private Message to " + clickedUser;
        document.getElementById("clickedUserId").innerHTML = userId;
    }

    function saveClickedUserRemove(clickedUser, userId) {
        document.getElementById("clickedUserId").innerHTML = userId;
        fillPrivateMessageModal(userId);

    }

    function viewReportForUser(week, userID, userName) {
        $("#modaltitle_for_report").html(userName + "'s Report")
        $.post("ajax.php?f=viewReportForUser", {
            week: week,
            userID,
            userID
        }, function(response) {
            $("#modal_for_report").html(response);
        })
    }

    function deletePrivateMessageFrom(id, usr) {
        if (usr == 0) {
            $.post("ajax.php?f=deletePrivateMessageFrom", {
                id: id
            }, function(response) {
                fillGlobalMessagesModal();
            })
        } else {
            $.post("ajax.php?f=deletePrivateMessageFrom", {
                id: id
            }, function(response) {
                fillPrivateMessageModal(usr);
            })
        }
    }
</script>

</html>