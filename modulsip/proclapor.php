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
    
    if($_POST['f111'] == 99) {$s111 = 99;} else {$s111 = $_POST['s111'];}
    if($_POST['f112'] == 99) {$s112 = 99;} else {$s112 = $_POST['s112'];}
    if($_POST['f113'] == 99) {$s113 = 99;} else {$s113 = $_POST['s113'];}
    if($_POST['f114'] == 99) {$s114 = 99;} else {$s114 = $_POST['s114'];}
    if($_POST['f115'] == 99) {$s115 = 99;} else {$s115 = $_POST['s115'];}
    if($_POST['f116'] == 99) {$s116 = 99;} else {$s116 = $_POST['s116'];}
    if($_POST['f117'] == 99) {$s117 = 99;} else {$s117 = $_POST['s117'];}
    if($_POST['f121'] == 99) {$s121 = 99;} else {$s121 = $_POST['s121'];}
    if($_POST['f122'] == 99) {$s122 = 99;} else {$s122 = $_POST['s122'];}
    if($_POST['f131'] == 99) {$s131 = 99;} else {$s131 = $_POST['s131'];}
    if($_POST['f132'] == 99) {$s132 = 99;} else {$s132 = $_POST['s132'];}
    if($_POST['f133'] == 99) {$s133 = 99;} else {$s133 = $_POST['s133'];}

    if($_POST['f211'] == 99) {$s211 = 99;} else {$s211 = $_POST['s211'];}
    if($_POST['f212'] == 99) {$s212 = 99;} else {$s212 = $_POST['s212'];}
    if($_POST['f221'] == 99) {$s221 = 99;} else {$s221 = $_POST['s221'];}
    if($_POST['f231'] == 99) {$s231 = 99;} else {$s231 = $_POST['s231'];}
    if($_POST['f241'] == 99) {$s241 = 99;} else {$s241 = $_POST['s241'];}
    if($_POST['f251'] == 99) {$s251 = 99;} else {$s251 = $_POST['s251'];}
    if($_POST['f252'] == 99) {$s252 = 99;} else {$s252 = $_POST['s252'];}
    if($_POST['f261'] == 99) {$s261 = 99;} else {$s261 = $_POST['s261'];}
    if($_POST['f271'] == 99) {$s272 = 99;} else {$s271 = $_POST['s271'];}

    
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
    $indata->bindParam(':S111',$s111);
    $indata->bindParam(':S112',$s112);
    $indata->bindParam(':S113',$s113);
    $indata->bindParam(':S114',$s114);
    $indata->bindParam(':S115',$s115);
    $indata->bindParam(':S116',$s116);
    $indata->bindParam(':S117',$s117);
    $indata->bindParam(':S121',$s121);
    $indata->bindParam(':S122',$s122);
    $indata->bindParam(':S131',$s131);
    $indata->bindParam(':S132',$s132);
    $indata->bindParam(':S133',$s133);
    $indata->bindParam(':S211',$s211);
    $indata->bindParam(':S212',$s212);
    $indata->bindParam(':S221',$s221);
    $indata->bindParam(':S231',$s231);
    $indata->bindParam(':S241',$s241);
    $indata->bindParam(':S251',$s251);
    $indata->bindParam(':S252',$s252);
    $indata->bindParam(':S261',$s261);
    $indata->bindParam(':S271',$s271);

    $indata->execute();
    
    header("Location: index.php?page=pelaporan&inpage=rumusan&idpgb=$idpgb");

} else {
    exit();
}