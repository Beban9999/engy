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
      background: #818589	;
      }
      .table>:not(caption)>*>*{
         vertical-align:middle;
         padding:1px;
      }
      .btn-danger{
         height:10px;
      }
     #trf_cntr1, #trf_cust1, #trf_type1{
         margin:10px;
      }
      #trf_cntr2, #trf_cust2, #trf_type2{
         margin:10px;
      }
      #trf_cntr3, #trf_cust3, #trf_type3{
         margin:10px;
      }
      #trf_cntr4, #trf_cust4, #trf_type4{
         margin:10px;
      }
      #trf_cntr5, #trf_cust5, #trf_type5{
         margin:10px;
      }
      #trf_cntr6, #trf_cust6, #trf_type6{
         margin:10px;
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
     
      <div class="container-fluid">
      <div class="row">
      <div class="col-lg-6" style="margin-bottom:15px;">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title" style=text-align:center><b>Europe</b></h4>
               <img src="img/europa.png" alt="" style = "max-width: 250px; width:100%;" class="img-fluid center-block d-block mx-auto">
               <hr>
               <div class="table-responsive" style= max-height:1000px>
                  <table class="table table-hover" style=margin:0px;>
                  <thead style=background:#4B0082;color:white;position:sticky;top:0;>
                        <tr>
                           <th id='first' scope="col" style=text-align:center;>Customer</th>
                           <th scope="col"style=text-align:center>Country</th>
                           <th scope="col"style=text-align:center>Type of Traffic</th>
                           <th scope="col"style=text-align:center>Add/Remove</th>
                        </tr>
                        <tr>
                               <td scope="col" style=text-align:center;width:100px><input id='trf_cust1' type="text"></td>
                               <td scope="col"style=text-align:center><input  id='trf_cntr1' type="text"></td>
                              <td scope="col"style=text-align:center><input   id='trf_type1' type="text"></td>
                              <td scope="col"style=text-align:center><button id='insertTrafficRow1'style = border:none;background:none;padding:0px;color:white><i class="fas fa-plus"></i></button></td>
                              
                       </tr>
                     </thead>
                     <tbody id='eur_body'>
                     </tbody>
                  </table>
               </div>
               
               <div class="row"> 
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-6" style="margin-bottom:15px">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title" style=text-align:center><b>Asia</b></h4>
               <img src="img/asia.png" alt="" style = "max-width: 386px; width:100%;" class="img-fluid center-block d-block mx-auto">
               <hr>
               <div class="table-responsive"style= max-height:1000px>
                  <table class="table table-hover" style=margin:0px;>
                  <thead style=background:#4B0082;color:white;position:sticky;top:0;>
                  <tr>
                           <th id='first' scope="col" style=text-align:center>Customer</th>
                           <th scope="col"style=text-align:center>Country</th>
                           <th scope="col"style=text-align:center>Type of Traffic</th>
                           <th scope="col"style=text-align:center>Add/Remove</th>
                        </tr>
                        <tr>
                               <td scope="col" style=text-align:center><input id='trf_cust2' type="text"></td>
                               <td scope="col"style=text-align:center><input  id='trf_cntr2' type="text"></td>
                              <td scope="col"style=text-align:center><input   id='trf_type2' type="text"></td>
                              <td scope="col"style=text-align:center><button id='insertTrafficRow2' style = border:none;background:none;padding:0px;color:white><i class="fas fa-plus"></i></button></td>
                                    
                           </tr>

                     </thead>
                     <tbody id='asia_body'>
                     </tbody>
                  </table>
               </div>
               <div class="row">
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-6" style="margin-bottom:15px">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title" style=text-align:center><b>North America</b></h4>
               <img src="img/na.png" alt="" style = "max-width: 250px; width:100%;" class="img-fluid center-block d-block mx-auto">
               <hr>
               <div class="table-responsive" style= max-height:1000px>
                  <table class="table table-hover" style=margin:0px;>
                  <thead style=background:#4B0082;color:white;position:sticky;top:0;>
                        <tr>
                           <th id='first' scope="col" style=text-align:center>Customer</th>
                           <th scope="col"style=text-align:center>Country</th>
                           <th scope="col"style=text-align:center>Type of Traffic</th>
                           <th scope="col"style=text-align:center>Add/Remove</th>
                        </tr>
                        <tr>
                               <td scope="col" style=text-align:center><input id='trf_cust3' type="text"></td>
                               <td scope="col"style=text-align:center><input  id='trf_cntr3' type="text"></td>
                              <td scope="col"style=text-align:center><input   id='trf_type3' type="text"></td>
                              <td scope="col"style=text-align:center><button id='insertTrafficRow3'style = border:none;background:none;padding:0px;color:white><i class="fas fa-plus"></i></button></td>
                           </tr>
                     </thead>
                     <tbody id='north_body'>
                     </tbody>
                  </table>
               </div>
               <div class="row">
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-6" style="margin-bottom:15px">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title" style=text-align:center><b>South America</b></h4>
               <img src="img/sa.png" alt="" style = "max-width: 187px; width:100%;" class="img-fluid center-block d-block mx-auto">
               <hr>
               <div class="table-responsive" style= max-height:1000px>
                  <table class="table table-hover" style=margin:0px;>
                  <thead style=background:#4B0082;color:white;position:sticky;top:0;>
                        <tr>
                           <th id='first' scope="col" style=text-align:center>Customer</th>
                           <th scope="col"style=text-align:center>Country</th>
                           <th scope="col"style=text-align:center>Type of Traffic</th>
                           <th scope="col"style=text-align:center>Add/Remove</th>
                        </tr>
                        <tr>
                               <td scope="col" style=text-align:center><input id='trf_cust4' type="text"></td>
                               <td scope="col"style=text-align:center><input  id='trf_cntr4' type="text"></td>
                              <td scope="col"style=text-align:center><input   id='trf_type4' type="text"></td>
                              <td scope="col"style=text-align:center><button id='insertTrafficRow4'style = border:none;background:none;padding:0px;color:white><i class="fas fa-plus"></i></button></td>
                           </tr>
                     </thead>
                     <tbody id='south_body'>
                     </tbody>
                  </table>
               </div>
               <div class="row">
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-6" style="margin-bottom:15px">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title" style=text-align:center><b>Africa</b></h4>
               <img src="img/africa.png" alt="" style = "max-width: 250px; width:100%;" class="img-fluid center-block d-block mx-auto">
               <hr>
               <div class="table-responsive" style= max-height:1000px>
                  <table class="table table-hover" style=margin:0px;>
                  <thead style=background:#4B0082;color:white;position:sticky;top:0;>
                        <tr>
                           <th id='first' scope="col" style=text-align:center>Customer</th>
                           <th scope="col"style=text-align:center>Country</th>
                           <th scope="col"style=text-align:center>Type of Traffic</th>
                           <th scope="col"style=text-align:center>Add/Remove</th>
                        </tr>
                        <tr>
                               <td scope="col" style=text-align:center><input id='trf_cust5' type="text"></td>
                               <td scope="col"style=text-align:center><input  id='trf_cntr5' type="text"></td>
                              <td scope="col"style=text-align:center><input   id='trf_type5' type="text"></td>
                              <td scope="col"style=text-align:center><button id='insertTrafficRow5'style = border:none;background:none;padding:0px;color:white><i class="fas fa-plus"></i></button></td>
                           </tr>
                     </thead>
                     <tbody id='africa_body'>
                     </tbody>
                  </table>
               </div>
               <div class="row">
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-6">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title" style=text-align:center><b>Australia</b></h4>
               <img src="img/australia.png" alt="" style = "max-width: 275px; width:100%;" class="img-fluid center-block d-block mx-auto">
               <hr>
               <div class="table-responsive" style= max-height:1000px>
                  <table class="table table-hover" style=margin:0px;>
                  <thead style=background:#4B0082;color:white;position:sticky;top:0;>
                        <tr>
                           <th id='first' scope="col" style=text-align:center>Customer</th>
                           <th scope="col"style=text-align:center>Country</th>
                           <th scope="col"style=text-align:center>Type of Traffic</th>
                           <th scope="col"style=text-align:center>Add/Remove</th>
                        </tr>
                        <tr>
                               <td scope="col" style=text-align:center><input id='trf_cust6' type="text"></td>
                               <td scope="col"style=text-align:center><input  id='trf_cntr6' type="text"></td>
                              <td scope="col"style=text-align:center><input   id='trf_type6' type="text"></td>
                              <td scope="col"style=text-align:center><button id='insertTrafficRow6'style = border:none;background:none;padding:0px;color:white><i class="fas fa-plus"></i></button></td>
                           </tr>
                     </thead>
                     <tbody id='australia_body'>
                     </tbody>
                  </table>
               </div>
               <div class="row">
               </div>
            </div>
         </div>
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
    function updateTrafficField(id, col){
        console.log(id, col);
        let updateVal = document.getElementById(id+col).innerHTML;

        $.post("ajax.php?f=updateTrafficField", {
                    id: id,
                    col: col,
                    updateVal: updateVal
                },
                function(response) {
                    console.log(response);
                })
    }
    function deleteTraffic(traffic_id, cont){
      console.log(traffic_id)
      $.post("ajax.php?f=deleteTraffic", {
                  traffic_id: traffic_id,
                },
                function(response) {
                    console.log(response);
                    fillUnknownTraffic(cont)
                })
    }
   </script>
</html>