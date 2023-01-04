<?php
session_start();
require_once("f.php");
if (!prijavljen()) {
    header("Location: http://localhost/engy/index.php"); //HARDCODE PATH
    exit;
}
$db = mysqli_connect("localhost", "root", "", "engy");
if(!validate_user()){
    header("Location: http://localhost/engy/index.php?odjava"); //HARDCODE PATH
    exit;
  }
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



    <script src="jquary/jquary.js"></script>
    <script src="jquary/jquary.form.js"></script>
    <script src="jquary/functions.js"></script>



    <title>Admin Panel</title>
</head>
<style>
    body {
        background: #003060;
    }

    .apexcharts-legend-text,
    .apexcharts-legend-marker {
        margin-bottom: 10px;
    }

    #apexcharts-donut-slice-0 {
        fill: black;
    }

    #apexcharts-donut-slice-1 {
        fill: blue;
    }

    #apexcharts-donut-slice-2 {
        fill: purple;
    }
</style>


<body id="dashboard_body">
    <?php
    navbar();
    if ($_SESSION["status"] == 3 || $_SESSION["status"] == 2) {
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
        <!-- <button type="button" class="btn btn-primary">Launch demo modal</button> -->

<!-- Modal -->
<div class="modal fade col-lg-12" id="modalDeleteUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaltitle_for_report">DELETING USER</h5>
                </div>
                <div class="modal-body" style="margin:3px" id='modal_for_delete_user'>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="deleteUser()" data-dismiss="modal">Delete</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


<div class="modal fade col-lg-12" id="modalEditUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaltitle_for_report">Users's Report</h5>
            </div>
            <div style="position:absolute; visibility:hidden" id="user_edit_id"></div>
            <div class="modal-body" style="margin:3px" id='modal_for_report'>

            <label for="user_edit_first_name">First name</label>
            <input type="text" name="" id="user_edit_first_name" class='form-control'>

            <label for="user_edit_last_name">Last name</label>
            <input type="text" name="" id="user_edit_last_name" class='form-control'>

            <label for="user_edit_username">Username</label>
            <input type="text" name="" id="user_edit_username" class='form-control'>

            <label for="user_edit_email">Email</label>
            <input type="text" name="" id="user_edit_email" class='form-control'>

            <div id="user_edit_selects">

            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="updateUser()" data-dismiss="modal">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <br>
    <div class="container-fluid">

        <div class='row'>

            <div class="col-lg-8">
                <div class='card'>
                    <h5 class="card-title" style="text-align:center; margin-top:20px;"><b>Welcome to Admin Panel</b></h5>
                    <hr>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card-body">
                                <h4 class="header-title mt-0" style=text-align:center>Aplication Users</h4>
                                <div id="ana_device" class="apex-charts"></div>

                                <div class="table-responsive mt-4">
                                    <table class="table mb-0">
                                        <thead class="thead-light">
                                            <tr style=background:#6c4ab6;color:white>
                                                <thead class="thead-light">
                                                    <tr style=background:#6c4ab6;color:white>
                                                        <th>Role</th>
                                                        <th>Number of Users</th>

                                                    </tr>
                                                </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Administrator</th>
                                                <td id="admins">1</td>

                                            </tr>
                                            <tr>
                                                <th scope="row">Manager</th>
                                                <td id="managers">3</td>

                                            </tr>
                                            <tr>
                                                <th scope="row">User</th>
                                                <td id="users">5</td>

                                            </tr>

                                        </tbody>
                                    </table>
                                    <!--end /table-->
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card-body">
                                <h4 class="header-title mt-0" style=text-align:center>Company Roles</h4>

                                <div class="table-responsive mt-4">
                                    <table class="table mb-0">
                                        <thead class="thead-light">
                                            <tr style=background:#6c4ab6;color:white>
                                                <th>Role </th>
                                                <th>Banner</th>
                                                <th>Users</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Account Manager</th>

                                                <td><img src="img/AM.png" alt="" height="30" class="mx-auto d-block mb-3"></td>
                                                <td id="account_managers">5</td>

                                            </tr>
                                            <tr>
                                                <th scope="row">C Level</th>

                                                <td><img src="img/CEO.png" alt="" height="30" class="mx-auto d-block mb-3"> </td>
                                                <td id="c_levels">3</td>

                                            </tr>
                                            <tr>
                                                <th scope="row">Developer</th>

                                                <td><img src="img/DEV.png" alt="" height="30" class="mx-auto d-block mb-3"></td>
                                                <td id="developers">1</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Sales Manager</th>

                                                <td> <img src="img/SM.png" alt="" height="30" class="mx-auto d-block mb-3"></td>
                                                <td id='sales_manager'>5</td>

                                            </tr>
                                            <tr>
                                                <th scope="row">Vice President</th>

                                                <td> <img src="img/VP.png" alt="" height="30" class="mx-auto d-block mb-3"></td>
                                                <td id="vice_presidents">5</td>

                                            </tr>
                                            <tr>
                                                <th scope="row">Vice President of Procurement</th>

                                                <td> <img src="img/VPoP.png" alt="" height="30" class="mx-auto d-block mb-3"></td>
                                                <td id="vice_presidents_of_procurment">5</td>

                                            </tr>
                                            <tr>
                                                <th scope="row">Procurement Manager</th>

                                                <td> <img src="img/PM.png" alt="" height="30" class="mx-auto d-block mb-3"></td>
                                                <td id="procurement_manager">5</td>

                                            </tr>


                                        </tbody>
                                    </table>
                                    <!--end /table-->
                                </div>

                            </div>

                        </div>
                        <!--end card-body-->

                    </div>
                    <!--end card-->


                </div>



            </div>
            <div class="col-lg-4">
                <div class='card'>
                <div class='card-body'>

                    <br>
                    <img src="assets/images/widgets/admin.png" alt="" height="310" class="mx-auto d-block mb-3" style=margin-top:15px>
                    <div class="col-lg-12">
                        <h3 class="header-title" style=text-align:center;background:#6c4ab6;color:white>Database Access</h3>
                        <br>
                        <img src="assets/images/widgets/info.png" alt="" height="92" class="mx-auto d-block mb-3" style=margin-top:15px>
                        <h5 class="header-title" style=text-align:center;>Contact <b>Head Administrators</b> for more informations.</h6>
                        <h5 class="header-title" style=text-align:center;>At the moment <b><a href="https://www.ngrubii.com/">Nenad</a></b> is only available Head Admin.</h6>
                        <h5 class="header-title" style=text-align:center;margin:5px>You can find him by pressing on his name, or send him a private email on <a href="mailto:nenad@engy.solutions"><b>nenad@engy.solutions</b></a>.
                        </h6>

</div>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <br>
    <div class="container-fluid">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <h4 class="mt-0 header-title">Users</h4>
                <p class="text-muted mb-3">Preview of all users
                </p>

                <div class="table-responsive">
                    <table id="user_table" class="table table-bordered mb-0 table-centered">
                        <thead>
                            <tr>
                                <th id="week2" style="background:#6c4ab6;color:white">Name</th>
                                <th id="week3" style="background:#6c4ab6;color:white">Lastname</th>
                                <th id="week4" style="background:#6c4ab6;color:white">Username</th>
                                <th id="week4" style="background:#6c4ab6;color:white">Email</th>
                                <th id="week4" style="background:#6c4ab6;color:white">Role</th>
                                <th id="week4" style="background:#6c4ab6;color:white">Team</th>
                                <th id="week4" style="background:#6c4ab6;color:white">Actions</th>

                            </tr>
                        </thead>
                        <tbody id="admin_users_table">
                        </tbody>
                    </table>
                    <!--end /table-->
                </div>
                <!--end /tableresponsive-->
            </div>



        </div>
        <!--end card-body-->
    </div>

    </div>
    <br>

    <script src="assets/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="assets/pages/jquery.analytics_dashboard.init.js"></script>
    <script src="assets/pages/jquery.apexcharts.init.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/loginscript.js"></script>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/waves.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script>
        function deleteUser(){
            var id = $("#deleteUserId").html();
            $.post("ajax.php?f=deleteUser",{id:id}, function(response){
                fillUsersTableAdmin();
                $("#ana_device").html("");
                fillApplicationUsersChart();
            })
        }
        function fillDeleteUser(id){
            console.log(id)
            $.post("ajax.php?f=deleteUserFill",{id:id}, function(response){
                $("#modal_for_delete_user").html(response);
            })
        }
        function fillEditUser(id){
            console.log(id)
            $.post("ajax.php?f=fillEditUser",{id:id}, function(response){
                respArr = response.split("|");
                $("#user_edit_first_name").val(respArr[0]);
                $("#user_edit_last_name").val(respArr[1]);
                $("#user_edit_username").val(respArr[2]);
                $("#user_edit_email").val(respArr[3]);
                $("#user_edit_selects").html(respArr[4]);
                $("#user_edit_id").html(respArr[5]);
            })
        }
        function updateUser(){
            var id_user =       $("#user_edit_id").html();
            var first_name =    $("#user_edit_first_name").val();
            var last_name =     $("#user_edit_last_name").val();
            var username =      $("#user_edit_username").val();
            var email =         $("#user_edit_email").val();

            var role =          $("#user_edit_role").val();
            var team =          $("#user_edit_team").val();

            console.log(id_user, first_name, last_name, username, email, role, team);

            $.post("ajax.php?f=updateUserEdit",
            {
                id_user:id_user,
                first_name:first_name,
                last_name:last_name,
                username:username,
                email:email,
                role:role,
                team:team
            },

            function(response){
                console.log(response);
                fillUsersTableAdmin();
                $("#ana_device").html("");
                fillApplicationUsersChart();
            })
        }
    </script>

</body>

</html>