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
<div class="col-md-12 col-lg-4" style="position:relative;left:34%">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title" style = "text-align:center">Global Message</h4>
                                    <form>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <input class="form-control" type="text" id="subject2" placeholder="Subject">                                                       
                                            </div>                                                    
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Your message"></textarea>
                                        </div>                                                
                                       
                                        <button type="submit" class="btn btn-primary btn-block px-4" style="background:purple;color:white">Send Message</button>
                                    </form>
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div><!--end col-->
                    </div><!--end row-->
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
                                                <th>Contact No</th>
                                                <th>Message User</th>
                                                <th>Visit Page</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><img src="../assets/images/users/user-3.jpg" alt="" class="rounded-circle thumb-sm mr-1"> Aaron Poulin</td>
                                                <td>Agent</td>
                                                <td>AaronPoulin@example.com</td>
                                                <td>+21 123456789</td>
                                                <td><button type="button" class="btn btn-success waves-effect waves-light">Message</button><button type="button" class="btn btn-danger waves-effect waves-light">Remove</button></td>
                                                <td>                                                       
                                                <button type="button" class="btn btn-primary waves-effect waves-light">Visit</button></td>
                                                <i class="mdi mdi-message-text-outline"></i>
                                            </tr>
                                            <tr>
                                                <td><img src="../assets/images/users/user-4.jpg" alt="" class="rounded-circle thumb-sm mr-1"> Richard Ali</td>
                                                <td>Administrator</td>
                                                <td>RichardAli@example.com</td>
                                                <td>+41 123456789</td>
                                                <td><button type="button" class="btn btn-success waves-effect waves-light">Message</button><button type="button" class="btn btn-danger waves-effect waves-light">Remove</button></td>
                                                <td>                                                       
                                                <button type="button" class="btn btn-primary waves-effect waves-light">Visit</button></td>
                                            </tr>

                                            <tr>
                                                <td><img src="../assets/images/users/user-5.jpg" alt="" class="rounded-circle thumb-sm mr-1"> Juan Clark</td>
                                                <td>Contributor</td>
                                                <td>JuanClark@example.com</td>
                                                <td>+65 123456789</td>
                                                <td><button type="button" class="btn btn-success waves-effect waves-light">Message</button><button type="button" class="btn btn-danger waves-effect waves-light">Remove</button></td>
                                                <td>                                                       
                                                <button type="button" class="btn btn-primary waves-effect waves-light">Visit</button></td>
                                            </tr>

                                            <tr>
                                                <td><img src="../assets/images/users/user-6.jpg" alt="" class="rounded-circle thumb-sm mr-1"> Albert Hull</td>
                                                <td>Agent</td>
                                                <td>AlbertHull@example.com</td>
                                                <td>+88 123456789</td>
                                                <td><button type="button" class="btn btn-success waves-effect waves-light">Message</button><button type="button" class="btn btn-danger waves-effect waves-light">Remove</button></td>
                                                <td>                                                       
                                                <button type="button" class="btn btn-primary waves-effect waves-light">Visit</button></td>
                                            </tr>

                                            <tr>
                                                <td><img src="../assets/images/users/user-7.jpg" alt="" class="rounded-circle thumb-sm mr-1"> Crystal Darling</td>
                                                <td>Contributor</td>
                                                <td>CrystalDarling@example.com</td>
                                                <td>+56 123456789</td>
                                                <td><button type="button" class="btn btn-success waves-effect waves-light">Message</button><button type="button" class="btn btn-danger waves-effect waves-light">Remove</button></td>
                                                <td>                                                       
                                                <button type="button" class="btn btn-primary waves-effect waves-light">Visit</button>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td><img src="../assets/images/users/user-8.jpg" alt="" class="rounded-circle thumb-sm mr-1"> Thomas Milligan</td>
                                                <td>Administrator</td>
                                                <td>homasMilligan@example.com</td>
                                                <td>+35 123456789</td>
                                                <td><button type="button" class="btn btn-success waves-effect waves-light">Message</button><button type="button" class="btn btn-danger waves-effect waves-light">Remove</button></td>
                                                <td>                                                       
                                                <button type="button" class="btn btn-primary waves-effect waves-light">Visit</button>

                                                </a></td>
                                            </tr>
                                            
                                            
                                            </tbody>
                                        </table><!--end /table-->
                                    </div><!--end /tableresponsive-->
                                <!-- </div>end card-body -->
                            </div><!--end card-->
                        </div> <!-- end col -->
                    </div><!--end row-->



    </body>


    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/loginscript.js"></script>
</html>