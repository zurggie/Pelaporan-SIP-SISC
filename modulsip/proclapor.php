<?php

date_default_timezone_set("Asia/Kuala_Lumpur");
require_once("../modul/session.php");
require_once("../modul/class.user.php");
$auth_user = new USER();

$user_id = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT user_name,userlevel FROM users WHERE user_id=:user_id");
$stmt->bindParam(':user_id',$user_id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$icsip = $row['user_name'];
$userlevel = $row['userlevel'];

if(isset($_POST['fromlapor']) && $userlevel == 20) {
    
    $nokp = $_POST['icpgb'];
    $bilke = $_POST['bilke'];
    $hari = $_POST['hari'];
    $bulan = $_POST['bulan'];
    $tahun = date('Y');
    $tarikh = $tahun.'-'.$bulan.'-'.$hari;
    $jenisb = $_POST['jenisb'];
    $catatan = $_POST['catatan'];
    $idpgb = $_POST['idpgb'];
    
    function insStd($f,$s) {
        if ($f == 99 && $s <> "") {$x = $s;}
        elseif($f == 99 && $s == "") {$x = 99;}
        else {$x = $s;}
        return $x;
    }

    $sqlindata = "INSERT INTO sip_pgb_data (SIP,NOKP,BILKE,TARIKH,CATATAN,JENIS,
    S111,S112,S113,S114,S115,S116,S117,S121,S122,S131,S132,S133,S211,S212,S221,S231,S241,S251,S252,S261,S271) VALUES
    (:sip,:nokp,:bilke,:tarikh,:catatan,:jenisb,:S111,:S112,:S113,:S114,:S115,:S116,:S117,:S121,:S122,:S131,:S132,:S133,:S211,:S212,:S221,:S231,:S241,:S251,:S252,:S261,:S271)";
    $indata = $auth_user->runQuery($sqlindata);
    $indata->bindParam(':sip',$icsip);
    $indata->bindParam(':nokp',$nokp);
    $indata->bindParam(':bilke',$bilke);
    $indata->bindParam(':tarikh',$tarikh);
    $indata->bindParam(':catatan',$catatan);
    $indata->bindParam(':jenisb',$jenisb);
    $indata->bindParam(':S111',insStd($_POST['f111'],$_POST['s111']));
    $indata->bindParam(':S112',insStd($_POST['f112'],$_POST['s112']));
    $indata->bindParam(':S113',insStd($_POST['f113'],$_POST['s113']));
    $indata->bindParam(':S114',insStd($_POST['f114'],$_POST['s114']));
    $indata->bindParam(':S115',insStd($_POST['f115'],$_POST['s115']));
    $indata->bindParam(':S116',insStd($_POST['f116'],$_POST['s116']));
    $indata->bindParam(':S117',insStd($_POST['f117'],$_POST['s117']));
    $indata->bindParam(':S121',insStd($_POST['f121'],$_POST['s121']));
    $indata->bindParam(':S122',insStd($_POST['f122'],$_POST['s122']));
    $indata->bindParam(':S131',insStd($_POST['f131'],$_POST['s131']));
    $indata->bindParam(':S132',insStd($_POST['f132'],$_POST['s132']));
    $indata->bindParam(':S133',insStd($_POST['f133'],$_POST['s133']));
    $indata->bindParam(':S211',insStd($_POST['f211'],$_POST['s211']));
    $indata->bindParam(':S212',insStd($_POST['f212'],$_POST['s212']));
    $indata->bindParam(':S221',insStd($_POST['f221'],$_POST['s221']));
    $indata->bindParam(':S231',insStd($_POST['f231'],$_POST['s231']));
    $indata->bindParam(':S241',insStd($_POST['f241'],$_POST['s241']));
    $indata->bindParam(':S251',insStd($_POST['f251'],$_POST['s251']));
    $indata->bindParam(':S252',insStd($_POST['f252'],$_POST['s252']));
    $indata->bindParam(':S261',insStd($_POST['f261'],$_POST['s261']));
    $indata->bindParam(':S271',insStd($_POST['f271'],$_POST['s271']));

    $indata->execute();
    
    header("Location: index.php?page=pelaporan&inpage=rumusan&idpgb=$idpgb");

} else {
    exit();
}