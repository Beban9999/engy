<?php
session_start();
$db = mysqli_connect("localhost", "root", "", "engy");

if (!$db) {
    echo "ERROR WITH DB CONNECTION" . mysqli_connect_errno();
    echo "<br>" . mysqli_connect_error();
    exit();
}

mysqli_query($db, "SET NAMES utf8");

$f = $_GET['f'];

if($f == "insertRow"){
    $currUser = $_SESSION['id_user'];
    $ins_customer = $_POST["ins_customer"];
    $ins_prod     = $_POST["ins_prod"];
    $ins_traff    = $_POST["ins_traff"];
    $ins_maincomp = $_POST["ins_maincomp"];
    $ins_dest     = $_POST["ins_dest"];
    $ins_looking  = $_POST["ins_looking"];
    $ins_pot      = $_POST["ins_pot"];
    $ins_act      = $_POST["ins_act"];
    $ins_next     = $_POST["ins_next"];
    $ins_result   = $_POST["ins_result"];
    $ins_datecomm = $_POST["ins_datecomm"];

    $stmt = $db->prepare("INSERT INTO `data`(`customer`, `prod`, `traff`, `maincomp`, `dest`, `looking`, `pot`, `act`, `next`, `result`, `datecomm`, `user`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param('sssssssssssi',$ins_customer,$ins_prod    ,$ins_traff   ,$ins_maincomp,$ins_dest    ,$ins_looking ,$ins_pot     ,$ins_act     ,$ins_next    ,$ins_result  ,$ins_datecomm, $currUser);
    $stmt->execute();

    $rez = $stmt->get_result();
    echo $rez;
}
if($f == "deletePrivateMessageFrom")
{
    $msg_id = $_POST["id"];
    $stmt = $db->prepare("UPDATE messages SET deleted = 1 WHERE id_message = ?");
    $stmt->bind_param('i', $msg_id);
    $stmt->execute();
}

if($f == "trafficChart"){
    $currUser = $_SESSION['id_user'];
    $stmt = $db->prepare("SELECT * FROM trafic_goals WHERE goal_user = ? order by goal_date");
    $stmt->bind_param("i", $currUser);
    $stmt->execute();
    $rez = $stmt->get_result();
    $goals = "";
    $reached = "";
    $dates = "";
    if(mysqli_num_rows($rez) > 0){
        while($red = mysqli_fetch_object($rez)){
            $goals.=$red->goal. ',';
            $reached.=$red->goal_reach. ',';
            $dates.=$red->goal_date. ',';
        }
        $goals = substr($goals, 0, -1);
        $dates = substr($dates, 0, -1);
        $reached = substr($reached, 0, -1);
        echo $goals.' '.$reached.' '.$dates;
    }

}
//Private message modal
if($f == "checkPrivateMessages")
{
    $currUser = $_SESSION['id_user'];
    $forUser = $_POST["id"];

    $stmt = $db->prepare("SELECT *
    FROM messages JOIN user ON messages.user_from = user.id_user
    WHERE user_for = ? AND user_from = ? AND deleted = 0 order by message_date desc");
    $stmt->bind_param('ii',$forUser, $currUser);

    $stmt->execute();
    $rez = $stmt->get_result();

    if(mysqli_num_rows($rez) > 0){
        while($red = mysqli_fetch_object($rez)){
            $message_type = "Private Message";
            if($red->team == "CEO")              $color = 'black';
            if($red->team == "Vice President"){  $color = '#38b6ff';}
            if($red->team == "Sales Manager") {  $color = '#ff1616';}
            if($red->team == "Account Manager"){ $color = '#3d9e67';}
            if($red->team == "Developer"){       $color = '#004aad';}
            $btn = '<button type="button" onclick = "deletePrivateMessageFrom('.$red->id_message.','.$forUser.')" style="color:white" class="position-absolute top-0 end-0 btn waves-effect waves-light">X</button>';
        echo '
        <div class="col-lg-6 mb-3">
           <div class="card"style="background:#8d72e1;color:white">
               <div class="card-body" >
                   <div class="blog-card">
                       <div class="meta-box" >

                       </div><!--end meta-box-->
                       '.$btn.'
                       <h4 class="mt-2 mb-3" style="text-align:center">
                       '.$message_type.'
                       </h4>
                       <p class="text" style="text-align:center;">'.$red->message_text.'</p>
                       <ul class="p-0 mt-4 list-inline " style="text-align:center;margin-bottom:1px;">
                       <li class="list-inline-item">by: <span style="color:'.$color.'">'.$red->username.'</span></li><br><li class="list" style="font-size:12px" >'.$red->message_date.'</li>

                           </ul>
                   </div><!--end blog-card-->
               </div><!--end card-body-->
           </div><!--end card-->
       </div> <!--end col-->';
        }
    }
}
//Global message modal
if($f == "checkGlobalMessages")
{
    $currUser = $_SESSION['id_user'];

    $stmt = $db->prepare("SELECT *
    FROM messages JOIN user ON messages.user_from = user.id_user
    WHERE user_for = 0 AND user_from = ? AND deleted = 0 order by message_date desc");
    $stmt->bind_param('i', $currUser);

    $stmt->execute();
    $rez = $stmt->get_result();

    if(mysqli_num_rows($rez) > 0){
        while($red = mysqli_fetch_object($rez)){
            $message_type = ($red->user_for == 0)? "<b>Global Message</b>" : "Private Message";
            if($red->team == "CEO")              $color = 'black';
            if($red->team == "Vice President"){  $color = '#38b6ff';}
            if($red->team == "Sales Manager") {  $color = '#ff1616';}
            if($red->team == "Account Manager"){ $color = '#3d9e67';}
            if($red->team == "Developer"){       $color = '#004aad';}
            $btn = '<button type="button" onclick = "deletePrivateMessageFrom('.$red->id_message.',0)" style="color:white" class="position-absolute top-0 end-0 btn waves-effect waves-light">X</button>';
        echo '
        <div class="col-lg-6 mb-3">
           <div class="card"style="background:#8d72e1;color:white">
               <div class="card-body" >
                   <div class="blog-card">
                       <div class="meta-box" >

                       </div><!--end meta-box-->
                       '.$btn.'
                       <h4 class="mt-2 mb-3" style="text-align:center">
                       '.$message_type.'
                       </h4>
                       <p class="text" style="text-align:center;">'.$red->message_text.'</p>
                       <ul class="p-0 mt-4 list-inline " style="text-align:center;margin-bottom:1px;">
                       <li class="list-inline-item">by: <span style="color:'.$color.'">'.$red->username.'</span></li><br><li class="list" style="font-size:12px" >'.$red->message_date.'</li>

                           </ul>
                   </div><!--end blog-card-->
               </div><!--end card-body-->
           </div><!--end card-->
       </div> <!--end col-->';
        }
    }
}
if($f == "fillTrafficGoal")
{
    $currUser = $_SESSION['id_user'];
    $stmt = $db->prepare("SELECT * FROM trafic_goals WHERE goal_user = ? order by goal_date desc");
    $stmt->bind_param("i", $currUser);
    $stmt->execute();
    $rez = $stmt->get_result();
    if(mysqli_num_rows($rez) > 0){
        if($red = mysqli_fetch_object($rez)){
            echo $red->goal;
        }
    }
}
if($f == "sendReport")
{
    $report_content = $_POST["myContent"];
    $currUser = $_SESSION['id_user'];
    echo $report_content;
    $stmt = $db->prepare("INSERT INTO `reports` (`report_message`, `report_user`) VALUES (?,?)");
    $stmt->bind_param("si", $report_content, $currUser);
    $stmt->execute();
}
if($f == "fillReportsTable")
{
    $stmt = $db->prepare("SELECT * FROM user WHERE role = 3 order by first_name");

    $i = 0;
    $fridays = array();
    $ind = 0;
    while($ind < 20)
    {
        //echo date("[W]", time()-($i*24*60*60));
        //echo date("j F Y", time()-($i*24*60*60));
        if(date("w", time()-($i*24*60*60)) != 5)
        {
            $i++;
        }
        else{
            $fridays[$ind++] = date("W", time()-($i*24*60*60));
            $i++;
            //echo $fridays[$ind-1];
        }
    }
    echo'
    <thead>
        <tr >
            <th style> </th>
            <th id = "week1" style = "background:#6c4ab6;color:white">Last Week - '.$fridays[0].'</th>
            <th id = "week2" style = "background:#6c4ab6;color:white">Week '.$fridays[1].'</th>
            <th id = "week3" style = "background:#6c4ab6;color:white">Week '.$fridays[2].'</th>
            <th id = "week4" style = "background:#6c4ab6;color:white">Week '.$fridays[3].'</th>
        </tr>
    </thead>
    <tbody>';
    $stmt->execute();
    $rez = $stmt->get_result();
    if(mysqli_num_rows($rez) > 0){
        while($red = mysqli_fetch_object($rez)){

        echo '
        <tr style="vertical-align:middle">
            <td style = "background:#8d72e1;color:white;font-weight:bold">'.$red->first_name.' '.$red->last_name.'<br>'.$red->team.'</td>
            <td><div class="file-box" data-toggle="modal" data-target="#exampleModalreport"onclick="viewReportForUser('.$fridays[0].','.$red->id_user.',\''.$red->first_name.'\');">
            </a>
            <div class="text-center">
                <i class="far fa-file-alt text-primary" style="font-size:36px;cursor:pointer"></i>
<br>

            </div>
        </div></td>
        <td><div class="file-box" data-toggle="modal" data-target="#exampleModalreport" onclick="viewReportForUser('.$fridays[1].','.$red->id_user.',\''.$red->first_name.'\');">
            </a>
            <div class="text-center">
                <i class="far fa-file-alt text-primary" style="font-size:36px;cursor:pointer"></i>
<br>

            </div>
        </div></td>
        <td><div class="file-box" data-toggle="modal" data-target="#exampleModalreport"onclick="viewReportForUser('.$fridays[2].','.$red->id_user.',\''.$red->first_name.'\');">
            </a>
            <div class="text-center">
                <i class="far fa-file-alt text-primary" style="font-size:36px;cursor:pointer"></i>
<br>

            </div>
        </div></td>
        <td><div class="file-box" data-toggle="modal" data-target="#exampleModalreport"onclick="viewReportForUser('.$fridays[3].','.$red->id_user.',\''.$red->first_name.'\');">
            </a>
            <div class="text-center">
                <i class="far fa-file-alt text-primary" style="font-size:36px;cursor:pointer;color:red !important"></i>
                <br>
                <small style="color:red">Last week visible</small>

            </div>
        </div></td>

        </tr></tbody>';
        }
   }

}
if($f == "fillMessages")
{
    $currUser = $_SESSION['id_user'];
    $type = $_POST["type"];
    if($type == 0){
        $stmt = $db->prepare("SELECT *
        FROM messages JOIN user ON messages.user_from = user.id_user
        WHERE user_for = 0 AND deleted = 0 order by message_date desc");
    }
    else{
        $stmt = $db->prepare("SELECT *
        FROM messages JOIN user ON messages.user_from = user.id_user
        WHERE user_for = ? AND deleted = 0 order by message_date desc");
        $stmt->bind_param('i', $currUser);
    }
    $stmt->execute();
    $rez = $stmt->get_result();
    if(mysqli_num_rows($rez) > 0){
        while($red = mysqli_fetch_object($rez)){
            $message_type = ($red->user_for == 0)? "<b>Global Message</b>" : "Private Message";
            if($red->team == "CEO")              $color = 'black';
            if($red->team == "Vice President"){  $color = '#38b6ff';}
            if($red->team == "Sales Manager") {  $color = '#ff1616';}
            if($red->team == "Account Manager"){ $color = '#3d9e67';}
            if($red->team == "Developer"){       $color = '#004aad';}
            $btn = '<button type="button" onclick = "deletePrivateMessageFrom('.$red->id_message.')" style="color:white" class="position-absolute top-0 end-0 btn waves-effect waves-light">X</button>';
        if($message_type != "Private Message") $btn = "";
        echo '
        <div class="col-lg-6 mb-3">
           <div class="card"style="background:#8d72e1;color:white">
               <div class="card-body" >
                   <div class="blog-card">
                       <div class="meta-box" >

                       </div><!--end meta-box-->
                       '.$btn.'
                       <h4 class="mt-2 mb-3" style="text-align:center">
                       '.$message_type.'
                       </h4>
                       <p class="text" style="text-align:center;">'.$red->message_text.'</p>
                       <ul class="p-0 mt-4 list-inline " style="text-align:center;margin-bottom:1px;">
                       <li class="list-inline-item">by: <span style="color:'.$color.'">'.$red->username.'</span></li><br><li class="list" style="font-size:12px" >'.$red->message_date.'</li>

                           </ul>
                   </div><!--end blog-card-->
               </div><!--end card-body-->
           </div><!--end card-->
       </div> <!--end col-->';
        }
    }
}
if($f == "execUpdate")
{
    $rec_id = $_POST["id"];
    $col_name = $_POST["col"];
    $val = $_POST["updateVal"];
 //   echo $col_name,$val, $rec_id;
    $stmt = $db->prepare("UPDATE data SET $col_name = ? WHERE data_id = ?");
    $stmt->bind_param('si',$val, $rec_id);
    $stmt->execute();
}
if($f == "deleteRecord"){
    $rec_id = $_POST["id"];

    $stmt = $db->prepare("UPDATE data SET deleted = 1 WHERE data_id = ?");
    $stmt->bind_param('i', $rec_id);
    $stmt->execute();

}
if($f == "sendToArch"){
    $rec_id = $_POST["id"];

    $stmt = $db->prepare("UPDATE data SET archived = 1 WHERE data_id = ?");
    $stmt->bind_param('i', $rec_id);
    $stmt->execute();
}
if($f == "returnFromArchive"){
    $rec_id = $_POST["id"];

    $stmt = $db->prepare("UPDATE data SET archived = 0 WHERE data_id = ?");
    $stmt->bind_param('i', $rec_id);
    $stmt->execute();
}
if($f == "sendPrivateMessage"){
    $currUser = $_SESSION['id_user'];
    $message_text = $_POST['message_text'];
    $to_user = $_POST['to_user'];
    $stmt = $db->prepare("INSERT INTO `messages`(`message_text`, `user_from`,`user_for`) VALUES (?, ?, ?)");
    $stmt->bind_param('sii', $message_text, $currUser, $to_user);
    $stmt->execute();
}

if($f == "sendGlobalMessage"){
    $currUser = $_SESSION['id_user'];
    $message_text = $_POST['message_text'];
    $stmt = $db->prepare("INSERT INTO `messages`(`message_text`, `user_from`) VALUES (?, ?)");
    $stmt->bind_param('si', $message_text, $currUser);
    $stmt->execute();
}

if($f == "viewReportForUser"){
    $user = $_POST["userID"];
    $week = $_POST["week"];
    $stmt = $db->prepare("SELECT * FROM reports WHERE report_user = ? ORDER BY report_date DESC;");
    $stmt->bind_param("i",$user);
    $stmt->execute();
    $isThereReport = 0;
    $rez = $stmt->get_result();
    if(mysqli_num_rows($rez) > 0){
        while($red = mysqli_fetch_object($rez)){

            $reports_week = date("W", strtotime(explode(" ", $red->report_date)[0]));

            if($reports_week == $week){
                echo $red->report_message;
                echo '<br><br><p>Date: '.$red->report_date.'</p>';
                $isThereReport = 1;
                break;
            }
        }
        if($isThereReport == 0)
        {
            echo "No report for user";
        }
    }
    else{
        echo "No report for user";
    }
}
if($f == "fillUsersTable"){
    $currUser = $_SESSION['id_user'];
    $stmt = $db->prepare("SELECT *
    FROM user JOIN roles ON user.role = roles.id_role
    WHERE role <> 1 AND user.id_user != $currUser ORDER BY first_name, last_name");
    $stmt->execute();

    $rez = $stmt->get_result();
    if(mysqli_num_rows($rez) > 0){
        while($red = mysqli_fetch_object($rez)){
        echo '<tr>
        <td>'.$red->first_name.' '.$red->last_name.'</td>
        <td>'.$red->team.'</td>
        <td>'.$red->email.'</td>
        <td>
        <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" onclick = "saveClickedUserInfo(\''.$red->username.'\', \''.$red->id_user.'\')" data-animation="bounce" data-target="#exampleModal">Private Message</button>
        <button type="button" class="btn btn-danger waves-effect waves-light" data-toggle="modal"  onclick = "saveClickedUserRemove(\''.$red->username.'\', \''.$red->id_user.'\')" data-animation="bounce" data-target="#exempleScroll">Remove</button></td>
        <td>
        <a href="visit_user.php?user='.$red->id_user.'">
        <button type="button" id="buttonVisit" class="btn btn-primary waves-effect waves-light">Visit</button>
        </a>
        </td>
        <i class="mdi mdi-message-text-outline"></i>
        </tr>';
        }
    }
}
if($f == "fillArchiveTableVisit"){
    $currUser = $_POST["id"];
    $stmt = $db->prepare("SELECT * FROM data WHERE user = ? AND deleted = 0 AND archived = 1 order by data_id desc");
    $stmt->bind_param('i', $currUser);
    $stmt->execute();

    $rez = $stmt->get_result();
    if(mysqli_num_rows($rez) > 0){
        while($red = mysqli_fetch_object($rez)){
        echo '<tr>
        <th  style="max-width:1px" scope="row"   >'.$red->customer.'</th>
        <td  style="max-width:1px"               >'.$red->prod.'</td>
        <td  style="max-width:1px"               >'.$red->traff.'</td>
        <td  style="max-width:1px"               >'.$red->maincomp.'</td>
        <td  style="max-width:1px"               >'.$red->dest.'</td>
        <td  style="max-width:1px"               >'.$red->looking.'</td>
        <td  style="max-width:1px"               >'.$red->pot.'</td>
        <td  style="max-width:1px"               >'.$red->act.'</td>
        <td  style="max-width:1px"               >'.$red->next.'</td>
        <td  style="max-width:1px"               >'.$red->result.'</td>
        <td  style="max-width:1px"               >'.$red->datecomm.'</td>
        </tr>';
        }
    }
}
if($f == "fillDataTableVisit"){
    $currUser = $_POST["id"];
    $stmt = $db->prepare("SELECT * FROM data WHERE user = ? AND deleted = 0 AND archived = 0 order by data_id desc");
    $stmt->bind_param('i', $currUser);
    $stmt->execute();

    $rez = $stmt->get_result();
    if(mysqli_num_rows($rez) > 0){
        while($red = mysqli_fetch_object($rez)){
        echo '<tr>
        <th  style="max-width:1px" scope="row"   >'.$red->customer.'</th>
        <td  style="max-width:1px"               >'.$red->prod.'</td>
        <td  style="max-width:1px"               >'.$red->traff.'</td>
        <td  style="max-width:1px"               >'.$red->maincomp.'</td>
        <td  style="max-width:1px"               >'.$red->dest.'</td>
        <td  style="max-width:1px"               >'.$red->looking.'</td>
        <td  style="max-width:1px"               >'.$red->pot.'</td>
        <td  style="max-width:1px"               >'.$red->act.'</td>
        <td  style="max-width:1px"               >'.$red->next.'</td>
        <td  style="max-width:1px"               >'.$red->result.'</td>
        <td  style="max-width:1px"               >'.$red->datecomm.'</td>
        </tr>';
        }
    }
}
if($f == "fillArchiveTable"){
    $currUser = $_SESSION['id_user'];
    $stmt = $db->prepare("SELECT * FROM data WHERE user = ? AND deleted = 0 AND archived = 1 order by data_id desc");
    $stmt->bind_param('i', $currUser);
    $stmt->execute();

    $rez = $stmt->get_result();
    if(mysqli_num_rows($rez) > 0){
        while($red = mysqli_fetch_object($rez)){
        echo '<tr>
        <th  style="max-width:1px" scope="row"   >'.$red->customer.'</th>
        <td  style="max-width:1px"               >'.$red->prod.'</td>
        <td  style="max-width:1px"               >'.$red->traff.'</td>
        <td  style="max-width:1px"               >'.$red->maincomp.'</td>
        <td  style="max-width:1px"               >'.$red->dest.'</td>
        <td  style="max-width:1px"               >'.$red->looking.'</td>
        <td  style="max-width:1px"               >'.$red->pot.'</td>
        <td  style="max-width:1px"               >'.$red->act.'</td>
        <td  style="max-width:1px"               >'.$red->next.'</td>
        <td  style="max-width:1px"               >'.$red->result.'</td>
        <td  style="max-width:1px"               >'.$red->datecomm.'</td>

        <td><button id="returnFromArchive" class="btn btn-warning" onclick="returnFromArchive('.$red->data_id.')"><i class="fas fa-archive"></i></button></td>
        </tr>';
        }
    }
}



if($f == "fillDataTable"){
    $currUser = $_SESSION['id_user'];
    $stmt = $db->prepare("SELECT * FROM data WHERE user = ? AND deleted = 0 AND archived = 0 order by data_id desc");
    $stmt->bind_param('i', $currUser);
    $stmt->execute();

    $rez = $stmt->get_result();
    if(mysqli_num_rows($rez) > 0){
        while($red = mysqli_fetch_object($rez)){ //onfocusout alternative
        echo '<tr>
        <th id="'.$red->data_id.'customer"  contenteditable style="max-width:1px" scope="row" onfocusout="execUpdate('.$red->data_id.',\'customer\')"      >'.$red->customer.'</th>
        <td id="'.$red->data_id.'prod"      contenteditable style="max-width:1px"             onfocusout="execUpdate('.$red->data_id.',\'prod\')"          >'.$red->prod.'</td>
        <td id="'.$red->data_id.'traff"     contenteditable style="max-width:1px"             onfocusout="execUpdate('.$red->data_id.',\'traff\')"         >'.$red->traff.'</td>
        <td id="'.$red->data_id.'maincomp"  contenteditable style="max-width:1px"             onfocusout="execUpdate('.$red->data_id.',\'maincomp\')"      >'.$red->maincomp.'</td>
        <td id="'.$red->data_id.'dest"      contenteditable style="max-width:1px"             onfocusout="execUpdate('.$red->data_id.',\'dest\')"          >'.$red->dest.'</td>
        <td id="'.$red->data_id.'looking"   contenteditable style="max-width:1px"             onfocusout="execUpdate('.$red->data_id.',\'looking\')"       >'.$red->looking.'</td>
        <td id="'.$red->data_id.'pot"       contenteditable style="max-width:1px"             onfocusout="execUpdate('.$red->data_id.',\'pot\')"           >'.$red->pot.'</td>
        <td id="'.$red->data_id.'act"       contenteditable style="max-width:1px"             onfocusout="execUpdate('.$red->data_id.',\'act\')"           >'.$red->act.'</td>
        <td id="'.$red->data_id.'next"      contenteditable style="max-width:1px"             onfocusout="execUpdate('.$red->data_id.',\'next\')"          >'.$red->next.'</td>
        <td id="'.$red->data_id.'result"    contenteditable style="max-width:1px"             onfocusout="execUpdate('.$red->data_id.',\'result\')"        >'.$red->result.'</td>
        <td id="'.$red->data_id.'datecomm"  contenteditable style="max-width:1px"             onfocusout="execUpdate('.$red->data_id.',\'datecomm\')"      >'.$red->datecomm.'</td>

        <td><button id="deleteRecord" class="btn btn-danger" onclick="deleteRecord('.$red->data_id.')"><i class="fas fa-trash"></i></button> <button id="sendToArchive" class="btn btn-warning" onclick="sendToArch('.$red->data_id.')"><i class="fas fa-archive"></i></button></td>
        </tr>';
        }
    }
}
if($f == "prijava"){
    $korIme = $_POST['korIme'];
    $pass = $_POST['pass'];

    $stmt = $db->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param('s', $korIme);
    $stmt->execute();

    $rez = $stmt->get_result();

    if(mysqli_num_rows($rez) > 0){
        $red = mysqli_fetch_object($rez);
        if($red->password != $pass){
            echo '<div class="alert alert-danger" role="alert">Password for user '.$red->username.' is not correct!</div>';
        }
        else{
            $_SESSION['user'] = "$red->first_name $red->last_name";
            $_SESSION['username'] = "$red->username";
            $_SESSION['status'] = $red->role;
            $_SESSION['id_user'] = $red->id_user;
            $_SESSION['team'] = $red->team;
            echo "prijavljen.php";
        }
    }
    else{
        echo '<div class="alert alert-danger" role="alert">
        User with entered credentials doesn&apos;t exist!
      </div>';
    }
}
?>