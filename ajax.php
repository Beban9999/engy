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

    $stmt = $db->prepare("DELETE FROM data WHERE data_id = ?");
    $stmt->bind_param('i', $rec_id);
    $stmt->execute();

}
if($f == "fillDataTable"){
    $currUser = $_SESSION['id_user'];
    $stmt = $db->prepare("SELECT * FROM data WHERE user = ?");
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

        <td><button id="deleteRecord" onclick="deleteRecord('.$red->data_id.')">DELETE</button> <button id="sendToArchive" onclick="sendToArch('.$red->data_id.')">ARCHIVE</button></td>
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