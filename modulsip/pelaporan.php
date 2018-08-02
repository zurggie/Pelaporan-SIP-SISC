<?php
if(isset($_POST['fromlapor'])) {
    $nokp = $_POST['icpgb'];
    $bilke = $_POST['bilke'];
    $hari = $_POST['hari'];
    $bulan = $_POST['bulan'];
    $tahun = date('Y');
    $tarikh = $tahun'-'$bulan'-'$hari;
    $jenisb = $_POST['jenisb'];
    
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
    if($_POST['f272'] == 99) {$s272 = 99;} else {$s272 = $_POST['s272'];}

    $sqlindata = "INSERT INTO sip_pgb_data (SIP,NOKP,BILKE,TARIKH,CATATAN,JENISBIMBINGAN,
    S111,S112,S113,S114,S115,S116,S117,S121,S122,S131,S132,S133,S211,S212,S221,S231,S241,S251,S252,S261,S271) VALUES
    (:sip,:nokp,:bilke,:tarikh,:catatan,:jenisb,:S111,:S112,:S113,:S114,:S115,:S116,:S117,:S121,:S122,:S131,:S132,:S133,:S211,:S212,:S221,:S231,:S241,:S251,:S252,:S261,:S271)"
    $indata = $auth_user->runQuery($sqlindata);
    $indata->bindParam(':sip',$user_id);
    $indata->bindParam(':nokp',$nokp);
    $indata->bindParam(':bilke',$bilke);
    $indata->bindParam(':tarikh',$tarikh);
    $indata->bindParam(':catatan',$catatan);
    $indata->bindParam(':jenisb',$jenisb);
    $indata->bindParam(':S111',$user_id);
    $indata->bindParam(':S112',$user_id);
    $indata->bindParam(':S112',$user_id);
    $indata->bindParam(':sip',$user_id);
    $indata->bindParam(':sip',$user_id);
    
}

?>
<style>
    .backwhite {
        background-color:white;
    }
    .mtb {
        margin-top:1rem;
        margin-bottom:1rem;
    }
    .mypanel {
        margin-top: 2rem;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        border-radius: 5px; /* 5px rounded corners */
    }
    .mypanel-body {
        padding: 2px 16px;
    }
    .std1 table,
    .std1 th,
    .std1 td {
        border: 1px solid black;
    }
    .std1 th {
        text-align: center;
    }
</style>

<div class="col-xs-12 backwhite">
    <div class="container">
        <div class="row mtb">
            <div class="col-xs-8">
                <select class="form-control">
                    <option>Sila Pilih PGB...</option>
                    <option>NAMA 1</option>
                    <option>NAMA 2</option>
                </select>
            </div>
            <div class="col-xs-2">
                <button type="submit" class="btn btn-primary btn-block">RUMUSAN</button>
            </div>
            <div class="col-xs-2">
                <button type="submit" class="btn btn-success btn-block">CARTA</button>
            </div>
        </div>
        <div class="row mtb">
            <div class="col-xs-12">
                <div class="mypanel">
                    <div class="mypanel-body">
                        <!-- ============ START RUMUSAN & GRAF PAGE ============== -->
                        <?php  
                            if($_GET['inpage']=='rumusan') {
                                include 'rumusan.php';
                            } elseif ($_GET['inpage'] == 'carta') {
                                include 'carta.php';
                            } else {
                                echo 'TIADA';
                            }
                        ?>
                        <!-- ============ START RUMUSAN & GRAF PAGE ============== -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>