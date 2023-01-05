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

//------------------------------------------------------------index.php------------------------------------------------------------
if($f == "prijava"){
    $korIme = $_POST['korIme'];
    $pass = sha1($_POST['pass']);

    $stmt = $db->prepare("SELECT * FROM user WHERE username = ? and deleted_user = 0");
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
//------------------------------------------------------------prijavljen.php------------------------------------------------------------
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
    if($_POST["id"] != 0){
        $currUser = $_POST["id"];
    }
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
    else{
        echo "0 0 ".date("Y m",time());
    }

}
//Private message modal
if($f == "checkPrivateMessages")
{
    $currUser = $_SESSION['id_user'];
    $forUser = $_POST["id"];

    $stmt = $db->prepare("SELECT *
    FROM messages
    JOIN user ON messages.user_from = user.id_user
    JOIN teams ON user.team = teams.team_name
    WHERE user_for = ? AND user_from = ? AND deleted = 0 order by message_date desc");
    $stmt->bind_param('ii',$forUser, $currUser);

    $stmt->execute();
    $rez = $stmt->get_result();

    if(mysqli_num_rows($rez) > 0){
        while($red = mysqli_fetch_object($rez)){
            $message_type = "Private Message";
            // if($red->team == "CEO")              $color = 'black';
            // if($red->team == "Vice President"){  $color = '#38b6ff';}
            // if($red->team == "Sales Manager") {  $color = '#ff1616';}
            // if($red->team == "Account Manager"){ $color = '#3d9e67';}
            // if($red->team == "Developer"){       $color = '#004aad';}
            $color = $red->color;
            $btn = '<button type="button" onclick = "deletePrivateMessageFrom('.$red->id_message.','.$forUser.')" style="color:white" class="position-absolute top-0 end-0 btn waves-effect waves-light">X</button>';
        echo '
        <div class="col-lg-12 mb-3">
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
                       <li class="list-inline-item">by: <span style="font-weight:bold;color:'.$color.'">'.$red->username.'</span></li><br><li class="list" style="font-size:12px" >'.$red->message_date.'</li>

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
    FROM messages
    JOIN user ON messages.user_from = user.id_user
    JOIN teams ON user.team = teams.team_name
    WHERE user_for = 0 AND user_from = ? AND deleted = 0 order by message_date desc");
    $stmt->bind_param('i', $currUser);

    $stmt->execute();
    $rez = $stmt->get_result();

    if(mysqli_num_rows($rez) > 0){
        while($red = mysqli_fetch_object($rez)){
            $message_type = ($red->user_for == 0)? "<b>Global Message</b>" : "Private Message";
            // if($red->team == "CEO")              $color = 'black';
            // if($red->team == "Vice President"){  $color = '#38b6ff';}
            // if($red->team == "Sales Manager") {  $color = '#ff1616';}
            // if($red->team == "Account Manager"){ $color = '#3d9e67';}
            // if($red->team == "Developer"){       $color = '#004aad';}
            $color = $red->color;
            $btn = '<button type="button" onclick = "deletePrivateMessageFrom('.$red->id_message.',0)" style="color:white;box-shadow:none" class="position-absolute top-0 end-0 btn waves-effect waves-light">X</button>';
        echo '
        <div class="col-lg-12 mb-3">
           <div class="card">
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
                       <li class="list-inline-item">by: <span style="color:'.$color.'">'.$red->username.'</span></li><br><li class="list" style="font-size:10px" >'.$red->message_date.'</li>

                           </ul>
                   </div><!--end blog-card-->
               </div><!--end card-body-->
           </div><!--end card-->
       </div> <!--end col-->';
        }
    }
}
if($f == "updateUserEdit"){
    $id_user =      $_POST["id_user"];
    $first_name =   $_POST["first_name"];
    $last_name =    $_POST["last_name"];
    $username =     $_POST["username"];
    $email =        $_POST["email"];
    $role =         $_POST["role"];
    $team =         $_POST["team"];

    //echo $id_user, $first_name, $last_name, $username, $email, $role, $team;
    $stmt = $db->prepare("UPDATE user SET
    first_name = ?, last_name = ?, username = ?, email = ?, team = ?, role = ?
    WHERE id_user = ?");
    $stmt->bind_param("sssssii",$first_name,$last_name,$username,$email,$team, $role,$id_user);
    $stmt->execute();
}
if($f == "fillEditUser"){
    $editUser = $_POST["id"];
    $stmt = $db->prepare("SELECT * FROM user WHERE id_user = ? and deleted_user = 0");
    $stmt->bind_param("i", $editUser);
    $stmt->execute();
    $rez = $stmt->get_result();

    if(mysqli_num_rows($rez) > 0){
        $red = mysqli_fetch_object($rez);
        echo $red->first_name.'|'.$red->last_name.'|'.$red->username.'|'.$red->email.'|';




        echo '
        <label for="user_edit_role">Role</label>
        <select name="" id="user_edit_role" class="form-control">';
        $stmt1 = $db->prepare("SELECT * FROM roles");
        $stmt1->execute();
        $rez1 = $stmt1->get_result();
        if(mysqli_num_rows($rez1) > 0){
            while($red1 = mysqli_fetch_object($rez1)){
                if($red1->id_role == $red->role){
                    echo '<option selected value = "'.$red1->id_role.'">'.$red1->role_name.'</option>';

                }
                else{
                    echo '<option value = "'.$red1->id_role.'">'.$red1->role_name.'</option>';
                }
            }
        }
        echo '</select>
        <label for="user_edit_team">Team</label>
        <select name="" id="user_edit_team" class="form-control">';
        $stmt1 = $db->prepare("SELECT * FROM teams");
        $stmt1->execute();
        $rez1 = $stmt1->get_result();
        if(mysqli_num_rows($rez1) > 0){
            while($red1 = mysqli_fetch_object($rez1)){
                if($red1->team_name == $red->team){
                    echo '<option style="color:'.$red1->color.'" selected value = "'.$red1->team_name.'">'.$red1->team_name.'</option>';

                }
                else{
                    echo '<option style="color:'.$red1->color.'" value = "'.$red1->team_name.'">'.$red1->team_name.'</option>';
                }
            }
        }

        echo '</select>|'.$red->id_user.'';

    }
}
if($f == "fillPrevReportsForUser"){
    $currUser = $_SESSION["id_user"];
    $stmt = $db->prepare("SELECT * FROM `reports` join user on reports.report_user = user.id_user WHERE reports.report_user = ? group by week(report_date) order by report_date desc");
    $stmt->bind_param("i", $currUser);
    $stmt->execute();

    $rez = $stmt->get_result();
    if(mysqli_num_rows($rez) > 0){
        while($red = mysqli_fetch_object($rez)){
            echo '
            <td><div class="file-box" data-toggle="modal" data-target="#exampleModalreport" style=margin-left:10px;text-align:center onclick="viewReportForUser('.date("W", strtotime($red->report_date)).','.$red->id_user.',\''.$red->first_name.'\');">
                <div class="text-center">
                    <i class="far fa-file-alt text-primary" style="font-size:36px;cursor:pointer"></i>
                </div>
                    Week '.date("W", strtotime($red->report_date)).'
                </div>
                    </td>';
        }
    }

}
if($f == "sendTrafficGoal"){
    $traffic = $_POST['inputTraffic'];
    $goalId = $_POST['goalId'];
    echo $goalId.' '.$traffic;
    $stmt = $db->prepare("UPDATE trafic_goals SET goal_reach = ? WHERE id_goal = ?");
    $stmt->bind_param("ii", $traffic, $goalId);
    $stmt->execute();
}
if($f == "deleteUser"){
    $id = $_POST["id"];
    $stmt = $db->prepare("UPDATE user SET deleted_user = 1 WHERE id_user = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
if($f == "deleteUserFill"){
    $id = $_POST["id"];
    $stmt = $db->prepare("SELECT * FROM user WHERE id_user = ? and deleted_user = 0");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $rez = $stmt->get_result();

    if(mysqli_num_rows($rez) > 0){
        if($red = mysqli_fetch_object($rez)){
            echo "Do you really wanna delete user:<b> $red->first_name $red->last_name ($red->username)</b>";
            echo "<div id='deleteUserId' style='position:absolute; visibility:hidden'>$red->id_user</div>";
        }
    }


}
if($f == "fillUsersTableAdmin"){
    $stmt = $db->prepare("SELECT * FROM user JOIN roles ON user.role = roles.id_role JOIN teams ON user.team = teams.team_name WHERE user.deleted_user = 0 order by first_name");
    $stmt->execute();
    $rez = $stmt->get_result();
    if(mysqli_num_rows($rez) > 0){
        while($red = mysqli_fetch_object($rez)){
            $color = $red->color;
            echo  '
            <tr style="vertical-align:middle">
                <td>'.$red->first_name.'</td>
                <td>'.$red->last_name.'</td>
                <td>'.$red->username.'</td>
                <td>'.$red->email.'</td>
                <td>'.$red->role_name.'</td>
                <td style="color:'.$color.';font-weight:bold">'.$red->team.'</td>
                <td><button class="btn btn-warning" data-toggle="modal" data-target="#modalEditUser" onclick="fillEditUser(\''.$red->id_user.'\')"><i class="fas fa-pen"></i></button> <button class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteUser" onclick="fillDeleteUser(\''.$red->id_user.'\')"><i class="fas fa-trash"></i></button></td>
            </tr>';
        }
    }
}

if($f == "trafficSetNewValues"){
    $id_user = $_POST["id_user"];
    $traffic_value = $_POST["traffic_value"];
    $old_goal = $_POST["old_goal"];
    $goal_date = date("Y-m-d", time());

    echo "$id_user $traffic_value $old_goal $goal_date";

    if($old_goal == 0 && $traffic_value != 0){
        $stmt = $db->prepare("INSERT INTO `trafic_goals`(`goal_user`, `goal`, `goal_date`) VALUES (?, ?, ?)");
        $stmt->bind_param("iis",$id_user, $traffic_value, $goal_date);
        $stmt->execute();
        //$rez = $stmt->get_result();
    }
    if($old_goal != 0 && $traffic_value != 0){
        $stmt = $db->prepare("UPDATE `trafic_goals` SET `goal`= ?, `goal_date`= ? WHERE id_goal = ?");
        $stmt->bind_param("isi",$traffic_value, $goal_date, $old_goal);
        $stmt->execute();
        //$rez = $stmt->get_result();
    }
}
if ($f == "openAndSetUserGoals") {
    $stmt = $db->prepare("SELECT * FROM user JOIN teams ON user.team = teams.team_name WHERE user.deleted_user = 0 and user.role = 3;");
    $stmt->execute();
    $rez = $stmt->get_result();
    echo '        <div class="container-fluid">
    <div class = "row">';
    if (mysqli_num_rows($rez) > 0) {
        while ($red = mysqli_fetch_object($rez)) {
            $img = "img/" . $red->team_icon;
            $currentMonth = date("m", time());
            $prevMonth = intval($currentMonth) - 1;
            if ($prevMonth == 0) $prevMonth = 12;
            $currentMonth = '%-' . $currentMonth . '-%';
            $prevMonth = '%-' . $prevMonth . '-%';


            $stmt2 = $db->prepare("SELECT * FROM trafic_goals WHERE goal_user = ? AND goal_date like ? order by goal_date DESC");
            $stmt2->bind_param("is", $red->id_user, $prevMonth);
            $stmt2->execute();
            $rez2 = $stmt2->get_result();

            echo '
                <div class="col-lg-4" style = margin-bottom:10px>
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="' . $img . '" height="80" alt="user" class="rounded-circle thumb-xl">
                            <br>
                            <br>

                            <h5 class=" client-name">' . $red->first_name . ' ' . $red->last_name . '</h5>
                            <h5 class=" client-name">' . $red->team . '</h5>
                            <input type="number" name=""  placeholder ="Traffic goal" id="tr_goal_' . $red->id_user . '" class="form-control">
                            <br>
                            <div class = "row">
                            <div class="col-lg-6">
                            <div class="card" style=box-shadow:none>';

            if (mysqli_num_rows($rez2) > 0) {
                $red2 = mysqli_fetch_object($rez2);
                echo "<h6>Last month traffic: $red2->goal_reach</h6>";
                echo ' </div></div>
                                        <div class="col-lg-6">
                                        <div class="card"style=box-shadow:none>';
                echo "<h6>Last month goal: $red2->goal</h6>";
            } else {
                echo "<h6>Last month traffic: 0</h6>";
                echo ' </div></div>
                                        <div class="col-lg-6">
                                        <div class="card"style=box-shadow:none>';
                echo "<h6>Last month goal: 0</h6>";
            }
            echo '</div></div></div>
                            <p class="text-center mt-3" style = background:#6c4ab6;color:white;border-radius:2px>Current month traffic set: ';

            $stmt1 = $db->prepare("SELECT * FROM trafic_goals WHERE goal_user = ? AND goal_date like ? order by goal_date DESC");
            $stmt1->bind_param("is", $red->id_user, $currentMonth);
            $stmt1->execute();
            $rez1 = $stmt1->get_result();

            if (mysqli_num_rows($rez1) > 0) {
                $red1 = mysqli_fetch_object($rez1);
                echo "<b><span id=\"tr_goal_ex_$red1->id_goal\">$red1->goal</span></b>";
            } else {
                echo "<b><span id=\"tr_goal_ex_0\">0</span></b>";
            }


            echo '</p>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col--><br>
';


            // echo $red->first_name.' '.$red->last_name.' '.'<input type="number" name="" value = "0" placeholder ="Traffic goal" id="tr_goal_'.$red->id_user.'" class="form-control">';


        }
    }
    echo '    </div>
    </div>';
}
if($f == "updateProcValues"){
    $rec_id = $_POST["id"];
    $col_name = $_POST["col"];
    $val = $_POST["updateVal"];
 //   echo $col_name,$val, $rec_id;
    $stmt = $db->prepare("UPDATE procurment SET $col_name = ? WHERE id_proc = ?");
    $stmt->bind_param('si',$val, $rec_id);
    $stmt->execute();
}
if($f == "fillEditProcFormArch"){
    $id = $_POST["id"];
    $stmt = $db->prepare("SELECT * FROM procurment WHERE id_proc = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $rez = $stmt->get_result();
    if(mysqli_num_rows($rez) > 0){
        if($red = mysqli_fetch_object($rez)){
            echo '
            <script src="assets/plugins/nestable/jquery.nestable.min.js"></script>
            <script src="assets/pages/jquery.nastable.init.js"></script>
                        <h4 class="mt-0 header-title" id="proc_title_'.$red->id_proc.'">'.$red->cust_name.'</h4>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label text-right">Customer Name</label>
                                    <div class="col-sm-10">
                                        <input disabled class="form-control" type="text" value="'.$red->cust_name.'" id="cust_name_'.$red->id_proc.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-email-input" class="col-sm-2 col-form-label text-right">Account Manager</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" disabled type="email" value="'.$red->acc_men.'" id="acc_men_'.$red->id_proc.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-tel-input" class="col-sm-2 col-form-label text-right">eNgY Transit Sheet</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" disabled type="text" value="" rows="1" id="trans_sheet_'.$red->id_proc.'">'.$red->trans_sheet.'</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-password-input" class="col-sm-2 col-form-label text-right">NDA</label>
                                    <div class="col-sm-10">
                                        <input class="form-control"  disabled type="text" value="'.$red->nda.'" id="nda_'.$red->id_proc.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-number-input" class="col-sm-2 col-form-label text-right">VAT-/Register ID certificat</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" disabled type="text" value="'.$red->vat.'" id="vat_'.$red->id_proc.'">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-color-input" class="col-sm-2 col-form-label text-right">Service Agreement</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" disabled type="text" value="'.$red->serv_agr.'" id="serv_agr_'.$red->id_proc.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-search-input" class="col-sm-2 col-form-label text-right">Search</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" disabled type="search" value="'.$red->search.'" id="search_'.$red->id_proc.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">DPA (Data Protection Agreement)</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" disabled type="text" value="'.$red->dpa.'" id="dpa_'.$red->id_proc.'">
                                    </div>
                                </div>



                            </div>


                            <div class="col-lg-6">

                                <div class="form-group row">
                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">Customer accounts</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" disabled type="text" value="'.$red->cust_acc.'" id="cust_acc_'.$red->id_proc.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">Supplier accounts</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" disabled type="text" value="'.$red->supp_acc.'" id="supp_acc_'.$red->id_proc.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">Rate Sheet</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" disabled type="text" value="'.$red->rate_sheet.'" id="rate_sheet_'.$red->id_proc.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">Base Routing</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" disabled type="text" value="'.$red->base_rout.'" id="base_rout_'.$red->id_proc.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">Follow Up</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" disabled type="text" value="'.$red->follow_up.'" id="follow_up_'.$red->id_proc.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">Action POINT</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" disabled type="text" value="'.$red->act_point.'" id="act_point_'.$red->id_proc.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">Comments</label>
                                    <div class="col-sm-10">
                                        <textarea name="" disabled class="form-control" id="comment_'.$red->id_proc.'" cols="30" rows="5">'.$red->comment.'</textarea>
                                    </div>
                                </div>
                                <div class="form-group row" style=text-align:right;margin-top:5px>
                                <div class="col-sm-10">
                                    <button class="btn btn-warning"
                                        onclick="ArchiveProc('.$red->id_proc.',0)" id="archiveProcBtn">Return From Archive</button>
                                </div>
                            </div>
                            </div>
                        </div>
            ';
        }
    }
}
if($f == "fillEditProcForm"){
    $id = $_POST["id"];
    if($id == 0){
        echo '
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
                                                            <textarea class="form-control"  rows="1" type="text" value=""
                                                                id="trans_sheet"></textarea>
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
                                                    <div class="form-group row"style=margin-bottom:5px>
                                                        <label for="example-url-input"
                                                            class="col-sm-2 col-form-label text-right">Comments</label>
                                                        <div class="col-sm-10">
                                                            <textarea name="" class="form-control" id="comment"
                                                                cols="30" rows="5"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row" style=text-align:right>
                                                        <div class="col-sm-10">
                                                            <button class="btn btn-success"
                                                                onclick="addNewProc()">Add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
        ';
        return;
    }
    $stmt = $db->prepare("SELECT * FROM procurment WHERE id_proc = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $rez = $stmt->get_result();
    if(mysqli_num_rows($rez) > 0){
        if($red = mysqli_fetch_object($rez)){
            echo '
            <script src="assets/plugins/nestable/jquery.nestable.min.js"></script>
            <script src="assets/pages/jquery.nastable.init.js"></script>
                        <h4 class="mt-0 header-title" id="proc_title_'.$red->id_proc.'">'.$red->cust_name.'</h4>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label text-right">Customer Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" oninput = "changeTitle('.$red->id_proc.',\'cust_name\')" onfocusout="updateProcField('.$red->id_proc.',\'cust_name\')" type="text" value="'.$red->cust_name.'" id="cust_name_'.$red->id_proc.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-email-input" class="col-sm-2 col-form-label text-right">Account Manager</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" onfocusout="updateProcField('.$red->id_proc.',\'acc_men\')" type="email" value="'.$red->acc_men.'" id="acc_men_'.$red->id_proc.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-tel-input" class="col-sm-2 col-form-label text-right">eNgY Transit Sheet</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control"  rows="1" onfocusout="updateProcField('.$red->id_proc.',\'trans_sheet\')" type="text" id="trans_sheet_'.$red->id_proc.'">'.$red->trans_sheet.'</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-password-input" class="col-sm-2 col-form-label text-right">NDA</label>
                                    <div class="col-sm-10">
                                        <input class="form-control"  onfocusout="updateProcField('.$red->id_proc.',\'nda\')" type="text" value="'.$red->nda.'" id="nda_'.$red->id_proc.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-number-input" class="col-sm-2 col-form-label text-right">VAT-/Register ID certificat</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" onfocusout="updateProcField('.$red->id_proc.',\'vat\')" type="text" value="'.$red->vat.'" id="vat_'.$red->id_proc.'">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-color-input" class="col-sm-2 col-form-label text-right">Service Agreement</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" onfocusout="updateProcField('.$red->id_proc.',\'serv_agr\')" type="text" value="'.$red->serv_agr.'" id="serv_agr_'.$red->id_proc.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-search-input" class="col-sm-2 col-form-label text-right">Search</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" onfocusout="updateProcField('.$red->id_proc.',\'search\')" type="search" value="'.$red->search.'" id="search_'.$red->id_proc.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">DPA (Data Protection Agreement)</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" onfocusout="updateProcField('.$red->id_proc.',\'dpa\')" type="text" value="'.$red->dpa.'" id="dpa_'.$red->id_proc.'">
                                    </div>
                                </div>



                            </div>


                            <div class="col-lg-6">

                                <div class="form-group row">
                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">Customer accounts</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" onfocusout="updateProcField('.$red->id_proc.',\'acc_men\')" type="text" value="'.$red->cust_acc.'" id="cust_acc_'.$red->id_proc.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">Supplier accounts</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" onfocusout="updateProcField('.$red->id_proc.',\'acc_men\')" type="text" value="'.$red->supp_acc.'" id="supp_acc_'.$red->id_proc.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">Rate Sheet</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" onfocusout="updateProcField('.$red->id_proc.',\'rate_sheet\')" type="text" value="'.$red->rate_sheet.'" id="rate_sheet_'.$red->id_proc.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">Base Routing</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" onfocusout="updateProcField('.$red->id_proc.',\'base_rout\')" type="text" value="'.$red->base_rout.'" id="base_rout_'.$red->id_proc.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">Follow Up</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" onfocusout="updateProcField('.$red->id_proc.',\'follow_up\')" type="text" value="'.$red->follow_up.'" id="follow_up_'.$red->id_proc.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">Action POINT</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" onfocusout="updateProcField('.$red->id_proc.',\'act_point\')" type="text" value="'.$red->act_point.'" id="act_point_'.$red->id_proc.'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-url-input" class="col-sm-2 col-form-label text-right">Comments</label>
                                    <div class="col-sm-10">
                                        <textarea name="" onfocusout="updateProcField('.$red->id_proc.',\'comment\')" class="form-control" id="comment_'.$red->id_proc.'" cols="30" rows="5">'.$red->comment.'</textarea>
                                    </div>
                                </div>
                                <div class="form-group row" style=text-align:right;margin-top:5px>
                                <div class="col-sm-10">
                                    <button class="btn btn-warning"
                                        onclick="ArchiveProc('.$red->id_proc.',1)">Archive</button>
                                </div>
                            </div>
                            </div>
                        </div>
            ';
        }
    }
}
if($f == "archiveProc"){
    $id = $_POST["id"];
    $val = $_POST["val"];
    $stmt = $db->prepare("UPDATE procurment SET archived = ? WHERE id_proc = ?");
    $stmt->bind_param("ii", $val, $id);
    echo $stmt->execute();
}
if($f == "fillProcTable"){
    $currUser = $_SESSION["id_user"];
    if($_POST["user_visit"] != 0){
        $currUser = $_POST["user_visit"];
    }
    $arch = $_POST["arch"];
    $stmt = $db->prepare("SELECT * FROM procurment WHERE deleted = 0 and archived = $arch and user_proc = ? order by date_added desc");
    $stmt->bind_param("i", $currUser);
    $stmt->execute();
    $rez = $stmt->get_result();
    if(mysqli_num_rows($rez) > 0){
        while($red = mysqli_fetch_object($rez)){

            echo'
                <div class="col-lg-12">
                <div class="card" onclick="fillEditProcForm(\''.$red->id_proc.'\', this)" style= border:none;margin:10px;background:#E0E0E0;>
                    <div class="card-body">

                        <div class="media new-message">
                            <div class="media-left">
                            </div><!-- media-left -->
                            <div class="media-body">
                                <h6 id="proc_field_'.$red->id_proc.'"
                                    style=text-align:center;margin-bottom:0px>
                                    '.$red->cust_name.'</h6>
                            </div><!-- end media-body -->
                        </div>
                        <!--end media-->
                    </div>
                </div>
            </div>

            ';
        }
    }
}
if($f == "insertProcRow"){
    $currUser = $_SESSION["id_user"];

    $cust_name=     $_POST["cust_name"];
    $acc_men=       $_POST["acc_men"];
    $trans_sheet=   $_POST["trans_sheet"];
    $nda     =      $_POST["nda"];
    $vat=           $_POST["vat"];
    $serv_agr=      $_POST["serv_agr"];
    $search=        $_POST["search"];
    $dpa=           $_POST["dpa"];
    $cust_acc=      $_POST["cust_acc"];
    $supp_acc=      $_POST["supp_acc"];
    $rate_sheett=   $_POST["rate_sheett"];
    $base_rout=     $_POST["base_rout"];
    $follow_up=     $_POST["follow_up"];
    $act_point=     $_POST["act_point"];
    $comment=       $_POST["comment"];

    //echo "$cust_name $acc_men $trans_sheet $nda $vat $serv_agr $search $dpa $cust_acc $supp_acc $rate_sheett $base_rout $follow_up $act_point $comment";

    $stmt = $db->prepare("INSERT INTO `procurment`(`cust_name`, `acc_men`, `trans_sheet`, `nda`, `vat`, `serv_agr`, `search`, `dpa`, `cust_acc`, `supp_acc`, `rate_sheet`, `base_rout`, `follow_up`, `act_point`, `comment`, `user_proc`)
                                           VALUES (?, ?, ?, ?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?)");
    $stmt->bind_param("sssssssssssssssi",
    $cust_name,
    $acc_men,
    $trans_sheet,
    $nda,
    $vat,
    $serv_agr,
    $search,
    $dpa,
    $cust_acc,
    $supp_acc,
    $rate_sheett,
    $base_rout,
    $follow_up,
    $act_point,
    $comment,
    $currUser);
    $stmt->execute();
    $rez = $stmt->get_result();
}
if($f == "usersStatistics"){
    $stmt = $db->prepare("SELECT roles.id_role, sum((CASE WHEN user.deleted_user = 0 THEN 1 ELSE 0 END)) as 'num' FROM user right join roles on user.role = roles.id_role group by id_role;");
    $stmt->execute();
    $rez = $stmt->get_result();
    if(mysqli_num_rows($rez) > 0){
        while($red = mysqli_fetch_object($rez)){
            echo $red->num.'|';
        }
    }
    $stmt = $db->prepare("SELECT teams.team_name, sum((CASE WHEN user.deleted_user = 0 THEN 1 ELSE 0 END)) as 'num' FROM user right join teams on user.team = teams.team_name group by team_name;");
    $stmt->execute();
    $rez = $stmt->get_result();
    if(mysqli_num_rows($rez) > 0){
        while($red = mysqli_fetch_object($rez)){
            echo $red->num.'|';
        }
    }

}
if($f == "fillTrafficGoal"){
    $currUser = $_SESSION['id_user'];
    $stmt = $db->prepare("SELECT * FROM trafic_goals WHERE goal_user = ?  AND goal_reach = 0 order by goal_date");
    $stmt->bind_param("i", $currUser);
    $stmt->execute();
    $rez = $stmt->get_result();
    $curr_month =  date("F",time());
    if(mysqli_num_rows($rez) > 0){
        if($red = mysqli_fetch_object($rez)){
            echo $red->goal.'|';
            echo date("F|", strtotime($red->goal_date));
            echo $red->id_goal;
        }
    }
    else{
        echo "No goal for current month|$curr_month|";
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
    $stmt = $db->prepare("SELECT * FROM user WHERE role = 3 and deleted_user = 0 order by first_name");

    $i = 0;
    $fridays = array();
    $ind = 0;
    while($ind < 4)
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
        FROM messages JOIN user ON messages.user_from = user.id_user JOIN teams ON user.team = teams.team_name
        WHERE user_for = 0 AND deleted = 0 order by message_date desc");
    }
    else{
        $stmt = $db->prepare("SELECT *
        FROM messages JOIN user ON messages.user_from = user.id_user JOIN teams ON user.team = teams.team_name
        WHERE user_for = ? AND deleted = 0 order by message_date desc");
        $stmt->bind_param('i', $currUser);
    }
    $stmt->execute();
    $rez = $stmt->get_result();
    if(mysqli_num_rows($rez) > 0){
        while($red = mysqli_fetch_object($rez)){
            $message_type = ($red->user_for == 0)? "<b>Global Message</b>" : "Private Message";
            // if($red->team == "CEO")              $color = 'black';
            // if($red->team == "Vice President"){  $color = '#38b6ff';}
            // if($red->team == "Sales Manager") {  $color = '#ff1616';}
            // if($red->team == "Account Manager"){ $color = '#3d9e67';}
            // if($red->team == "Developer"){       $color = '#004aad';}
            $color = $red->color;
            $btn = '<button type="button" onclick = "deletePrivateMessageFrom('.$red->id_message.')" style="color:white;box-shadow:none" class="position-absolute top-0 end-0 btn waves-effect waves-light">X</button>';
        if($message_type != "Private Message") $btn = "";
        echo '
        <div class="col-lg-12 mb-3">
           <div class="card">
               <div class="card-body" >
                   <div class="blog-card">
                       <div class="meta-box" >

                       </div><!--end meta-box-->
                       '.$btn.'
                       <h4 class="mt-2 mb-3" style="text-align:left;font-weight:bold">
                       '.$red->username."'s".' Message'.'
                       </h4>
                       <hr>
                       <p class="text" style="text-align:left;font-weight:bold;font-size:18px">'.$red->message_text.'</p>
                       <ul class="p-0 mt-4 list-inline " style="text-align:left;">

                       <li class="list-inline-item">by: <span style="font-weight:bold;font-size:16px;color:'.$color.'">'.$red->username.'</span></li><br><li class="list" style="font-size:12px" >'.$red->message_date.'</li>

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
                echo '<br><hr><p>Date: '.$red->report_date.'</p>';
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
    WHERE role <> 1 AND user.id_user != $currUser AND deleted_user = 0 ORDER BY first_name, last_name");
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
        <td  style="max-width:1px;"               >'.$red->prod.'</td>
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
?>