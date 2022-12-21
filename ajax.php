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
if($f == "fillMessages")
{
    $currUser = $_SESSION['id_user'];
    $stmt = $db->prepare("SELECT * 
    FROM messages JOIN user ON messages.user_from = user.id_user
    WHERE user_for in (?, 0) AND deleted = 0 order by message_date desc");
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

        echo '                   
        <div class="col-lg-3 mb-3">
           <div class="card"style="background:none;border:solid;border-color:gray">
               <div class="card-body" >
                   <div class="blog-card">
                       <div class="meta-box" >
                          
                       </div><!--end meta-box-->            
                       <h4 class="mt-2 mb-3" style="text-align:center">
                           '.$message_type.'
                       </h4>
                       <p class="text" style="text-align:center;">'.$red->message_text.'</p>
                       <ul class="p-0 mt-4 list-inline " style="text-align:center">
                       <button type="button" class="btn btn-inline-light waves-effect waves-light"><li class="list-inline-item" >'.$red->message_date.'</li><li class="list-inline-item">by: <span style="color:'.$color.'">'.$red->username.'</span></li></button>
                               
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
    $d=strtotime("now");
    $date = date("Y-m-d h:i:sa", $d);
    $stmt = $db->prepare("INSERT INTO `messages`(`message_text`, `user_from`,`message_date`, `user_for`) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('sisi', $message_text, $currUser, $date, $to_user);
    $stmt->execute();
}

if($f == "sendGlobalMessage"){
    $currUser = $_SESSION['id_user'];
    $message_text = $_POST['message_text'];
    $d=strtotime("now");
    $date = date("Y-m-d h:i:sa", $d);
    $stmt = $db->prepare("INSERT INTO `messages`(`message_text`, `user_from`,`message_date`) VALUES (?, ?, ?)");
    $stmt->bind_param('sis', $message_text, $currUser, $date);
    $stmt->execute();
}

if($f == "fillUsersTable"){
    $currUser = $_SESSION['id_user'];
    $stmt = $db->prepare("SELECT * 
    FROM user JOIN roles ON user.role = roles.id_role
    WHERE role <> 1 ORDER BY first_name DESC");
    $stmt->execute();

    $rez = $stmt->get_result();
    if(mysqli_num_rows($rez) > 0){
        while($red = mysqli_fetch_object($rez)){
        echo '<tr>
        <td>'.$red->first_name.' '.$red->last_name.'</td>
        <td>'.$red->team.'</td>
        <td>'.$red->email.'</td>
        <td>
        <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" onclick = "saveClickedUserInfo(\''.$red->username.'\', \''.$red->id_user.'\')" data-animation="bounce" data-target=".bs-example-modal-center">Private Message</button>
        <button type="button" class="btn btn-danger waves-effect waves-light">Remove</button></td>
        <td>                                                       
        <button type="button" class="btn btn-primary waves-effect waves-light">Visit</button></td>
        <i class="mdi mdi-message-text-outline"></i>
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
        while($red = mysqli_fetch_object($rez)){
        echo '<tr>
        <th id="'.$red->data_id.'customer"  contenteditable style="max-width:1px" scope="row" oninput="execUpdate('.$red->data_id.',\'customer\')"      >'.$red->customer.'</th>
        <td id="'.$red->data_id.'prod"      contenteditable style="max-width:1px"             oninput="execUpdate('.$red->data_id.',\'prod\')"          >'.$red->prod.'</td>
        <td id="'.$red->data_id.'traff"     contenteditable style="max-width:1px"             oninput="execUpdate('.$red->data_id.',\'traff\')"         >'.$red->traff.'</td>
        <td id="'.$red->data_id.'maincomp"  contenteditable style="max-width:1px"             oninput="execUpdate('.$red->data_id.',\'maincomp\')"      >'.$red->maincomp.'</td>
        <td id="'.$red->data_id.'dest"      contenteditable style="max-width:1px"             oninput="execUpdate('.$red->data_id.',\'dest\')"          >'.$red->dest.'</td>
        <td id="'.$red->data_id.'looking"   contenteditable style="max-width:1px"             oninput="execUpdate('.$red->data_id.',\'looking\')"       >'.$red->looking.'</td>
        <td id="'.$red->data_id.'pot"       contenteditable style="max-width:1px"             oninput="execUpdate('.$red->data_id.',\'pot\')"           >'.$red->pot.'</td>
        <td id="'.$red->data_id.'act"       contenteditable style="max-width:1px"             oninput="execUpdate('.$red->data_id.',\'act\')"           >'.$red->act.'</td>
        <td id="'.$red->data_id.'next"      contenteditable style="max-width:1px"             oninput="execUpdate('.$red->data_id.',\'next\')"          >'.$red->next.'</td>
        <td id="'.$red->data_id.'result"    contenteditable style="max-width:1px"             oninput="execUpdate('.$red->data_id.',\'result\')"        >'.$red->result.'</td>
        <td id="'.$red->data_id.'datecomm"  contenteditable style="max-width:1px"             oninput="execUpdate('.$red->data_id.',\'datecomm\')"      >'.$red->datecomm.'</td>

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