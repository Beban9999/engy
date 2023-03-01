<?php
session_start();
require_once("f.php");
page_validation();
$db = db_connect();

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
    <meta charset="utf-8" />
    <title>FAQ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A premium admin dashboard template by Mannatthemes" name="description" />
    <meta content="Mannatthemes" name="author" />
    <link rel="icon" href="logo.png" type="image/x-icon" />

    <!-- Sweet Alert -->
    <!-- <link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css"> -->
    <link href="assets/plugins/animate/animate.css" rel="stylesheet" type="text/css">
    <script src="js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link href="/assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <!-- App css -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/metricacss.css" />
    <script src="jquary/jquary.js"></script>
    <script src="jquary/jquary.form.js"></script>
    <script src="jquary/functions.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/info.js"></script>

</head>
<?php
    navbar();
    ?>

<br>
<div class="page-content">

<div class="container-fluid">
<div class='row'>
<img src="assets/images/widgets/faq.png" class="center-block d-block mx-auto" alt="" style = "max-width: 500px; width:100%;"
<br>
                <div class="col-lg-12">
                    <br>


            <div class='row'>
                <div class="col-lg-12" >
                    <div class='card'>
                    <div class='card-body'>


                        <div class="row" id="faq" style="margin-left:1px;margin-top:15px;margin-right:1px;">
                        <div class="row">
                                        <div class="col-md-12 col-lg-6">
                                            <ul class="list-unstyled faq-qa">
                                                <li class="mb-5">
                                                    <h6 class="" style = font-weight:bold>1. What is Scipio?</h6>
                                                    <hr>
                                                    <p class="font-16 text-muted ml-3">Scipio is a SalesForce Web Application for
                                                        managing traffic, writting weekly reports, procurment and client managment.
                                                    </p>
                                                </li>
                                                <li class="mb-5">
                                                <h6 class="" style = font-weight:bold>2. Who can use Scipio?</h6>
                                                    <hr>

                                                    <p class="font-16 text-muted  ml-3"> If you are reading this, you are probably
                                                        part of eNgY Solutions - Telecommunications SMS Company. Every employee got his
                                                        personal account.
                                                    </p>
                                                </li>
                                                <li class="mb-5">
                                                <h6 class="" style = font-weight:bold>3. Data of my profile is not correct.</h6>                                                    <hr>

                                                    <p class="font-16 text-muted ml-3">If you see yourself in different team, or
                                                        have a wrong name, you'll need to contact administrator. <a href="https://www.ngrubii.com/">Contact Administrator</a>
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-12 col-lg-6">
                                            <ul class="list-unstyled faq-qa">
                                                <li class="mb-5">
                                                <h6 class="" style = font-weight:bold>4. Who can see my profile page?</h6>                                                    <hr>

                                                    <p class="font-16 text-muted ml-3">Every administrator and manager can see your
                                                        profile page(your traffic, your tables).
                                                        <br>
                                                        <br>
                                                    </p>
                                                </li>
                                                <li class="mb-5">
                                                <h6 class="" style = font-weight:bold>5. Can i transfer data from excel to the application?</h6>                                                    <hr>

                                                    <p class="font-16 text-muted ml-3">Yes! Administrators can do it for you.
                                                        <br>
                                                        <br>
                                                    </p>
                                                </li>
                                                <li class="mb-5">
                                                <h6 class="" style = font-weight:bold>6. If I delete something, is it permanently lost?</h6>                                                    <hr>

                                                    <p class="font-16 text-muted ml-3">No data is permanently lost.
                                                        Everything, even deleted things are stored in database, administrators can
                                                        return it from recycle bin!
                                                    </p>
                                                </li>
                                            </ul>
                                        </div><!--end col-->
                                    </div> <!--end row-->

                    </div>
                    </div>

                </div>
                <br>
                <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title">Scipio Details</h4>
                                    <p class="text-muted">Page by page explanation.
                                    </p>
                                    <div class="accordion" id="accordionExample-faq">
                                        <div class="card shadow-none border mb-1">
                                            <div class="card-header" id="headingOne">
                                            <h5 class="my-0">
                                                <button class="btn btn-link ml-4" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <b>Portal and Company Roles</b>
                                                </button>
                                            </h5>
                                            </div>

                                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample-faq">
                                            <div class="card-body" style = text-align:center>
                                          
                                                On the portal, there are three types of users:<hr>
                                                <ul style = "list-style-type: none">
                                                <li><b>Administrator</b> - Can access to all pages. Have ability to change users credentials.
                                                Other users cannot see them in any list. Can do everything that manager can.</li><br>
                                                <li><b>Manager</b> - Can access to Managment Panel. Can set traffic goals for Account/Sales teams.
                                                Have ability to read all weekly reports. Can write global & private messages. Can do everything that user does.</li><br>
                                                <li><b>User</b> - can fill tables, write weekly reports and access to archive. Cannot write messages, only can read it.</li>
                                                </ul>
                                                <br>

<br>
<div class="card">
                                <div class="card-body" style = text-align:center>
                                                <b>Employees are also devided into company teams:</b>
                                                <hr>
                                                <ul style = "list-style-type: none">
                                                <img src="img/am.png" alt="" style = "max-width:100px" class="img-fluid">
                                                <li><span style = color:green;font-weight:bold>Account Managers</span></li><br>
                                                <img src="img/sm.png" alt="" style = "max-width:100px" class="img-fluid">
                                                <li><span style = color:red;font-weight:bold>Sales Managers</span></li><br>
                                                <img src="img/pm.png" alt="" style = "max-width:100px" class="img-fluid">
                                                <li><span style = color:darkgreen;font-weight:bold>Procurment Managers</span></li><br>
                                                <img src="img/vp.png" alt="" style = "max-width:100px" class="img-fluid">
                                                <li><span style = color:dodgerblue;font-weight:bold>Vice Presidents</span></li><br>
                                                <img src="img/ceo.png" alt="" style = "max-width:100px" class="img-fluid">

                                                <li><span style = color:black;font-weight:bold>C Level</span></li><br>
                                                <img src="img/dev.png" alt="" style = "max-width:100px" class="img-fluid">

                                                <li><span style = color:blue;font-weight:bold>Developers</span></li><br>

                                                </ul>
</div></div>


                                            </div>
                                            </div>
                                        </div>



                                        <div class="card shadow-none border mb-1">
                                            <div class="card-header" id="headingTwo">
                                            <h5 class="my-0">
                                                <button class="btn btn-link collapsed ml-4 align-self-center" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                               <b> How to use traffic table graph?</b>
                                            </button>
                                            </h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample-faq">
                                            <div class="card-body">

                                            <div class="card">
                                            <div class="card-body" style = text-align:center>
                                            <h4>Manager and User are working with Traffic goal tables.</h4><hr>

                                        <h5>Manager is setting goals for every employee, every month through Managment Panel.</h5>
                                        
                                        <img src="assets/images/widgets/am.png" alt="" class="img-fluid">
<hr>
                                        <h5>Users can see added values on their graphs on Dashboard, and also add their monthly results at the beginning of next month.</h5><br>
                                        <img src="assets/images/widgets/value.png" alt=""  class="img-fluid">
<br>
                                        <img src="assets/images/widgets/table.png" alt=""  class="img-fluid">



                                            </div></div>
                                        

                                        </div>
                                            </div>
                                        </div>



                                        <div class="card shadow-none border mb-1">
                                            <div class="card-header" id="headingThree">
                                            <h5 class="my-0">
                                                <button class="btn btn-link collapsed ml-4" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                 <b>  Writting Weekly Reports</b>
                                                </button>
                                            </h5>
                                            </div>
                                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample-faq">
                                            <div class="card-body" style = text-align:center>
                                               <h5> When you upload your weekly report it is visible under writting space on your Reports section.
                                                If you overwrite your report, last one is going to be visible.</h5><br>
                                                <br>
                                                <img src="assets/images/widgets/reports.png" alt="" class="img-fluid">
                                                <hr>
                                                <h5>Managers can see your weekly report every Friday, until Friday everything you upload is visible only to you.</h5><br>
                                                <h5>They can see your last 4 reports.</h5><br>

                                                <img src="assets/images/widgets/pastreports.png" alt="" class="img-fluid"><br><br>

    
                                            </div>

                                            </div>
                                        </div>
                                        <div class="card shadow-none border mb-1">
                                            <div class="card-header" id="headingFour">
                                            <h5 class="my-0">
                                                <button class="btn btn-link collapsed ml-4" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                 <b>   What cryptocurrency can i use to buy Frogetor? </b>
                                                </button>
                                            </h5>
                                            </div>
                                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample-faq">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
                                            </div>
                                            </div>
                                        </div>
                                    </div><!--end accordion-->
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div>



                </div>
                </div>



    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/waves.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>


    <!--Wysiwig js-->
    <script src="assets/plugins/tinymce/tinymce.min.js"></script>
    <script src="assets/pages/jquery.form-editor.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/loginscript.js"></script>


</body>

</html>