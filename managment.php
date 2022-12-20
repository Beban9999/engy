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
    <link rel="icon" href="engy.png" type="image/x-icon" />
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
    <link rel="shortcut icon" href="assets/images/favicon.ico">




    <script src="jquary/jquary.js"></script>
    <script src="jquary/jquary.form.js"></script>
    <script src="jquary/functions.js"></script>


</head>

<body>
    <?php
    navbar();
    ?>
    <br>

    <!-- Private Messsage MODAL -->
    <div class="modal fade bs-example-modal-center" style="position:fixed; bottom:34px">
        <div class="col-md-12 col-lg-4" style="position:relative;left:34%">
            <div class="card">
                <div class="card-body">
                    <h4 id='privateMessageHeader' class="mt-0 header-title" style="text-align:center">Private Message to USER</h4>
                        <form>
                            <div class="form-group">
                                <textarea class="form-control" id="privateMessageText" rows="4" placeholder="Your message"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block px-4" id="sendPrivateMessage" style="background:purple;color:white">Send Message</button>
                            <button type="submit" class="btn btn-primary btn-block px-4" data-bs-dismiss="modal" style="background:#A52A2A;color:white">Cancel</button>
                        </form>
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->
    </div><!-- /.modal -->
    </div>
    <!--end card-body-->


    <div class="col-md-12 col-lg-4" style="position:relative;left:34%">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title" style="text-align:center">Global Message</h4>
                <div class="form-group row">

                </div>
                <div class="form-group">
                    <textarea class="form-control" id="globalMessageText" rows="4" placeholder="Your message"></textarea>
                </div>

                <button type="submit" id="sendGlobalMessage" class="btn btn-primary btn-block px-4" style="background:purple;color:white">Send Message</button>
            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    </div>
    <!--end row-->
    <br>
    <!--TABLE -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- <div class="card-body"> -->

                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead class="thead-light" style="background:purple;color:white">
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
</body>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/metisMenu.min.js"></script>
<script src="assets/js/waves.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>

<script type="text/javascript" src="js/mdb.min.js"></script>
<script type="text/javascript" src="js/loginscript.js"></script>
<script>
    //<h4 id = 'privateMessageHeader' class="mt-0 header-title" style = "text-align:center">Private Message to USER</h4>

    function saveClickedUserInfo(clickedUser, userId) {
        document.getElementById("privateMessageHeader").innerHTML = "Private Message to " + clickedUser;
        document.getElementById("clickedUserId").innerHTML = userId;

    }
</script>

</html>