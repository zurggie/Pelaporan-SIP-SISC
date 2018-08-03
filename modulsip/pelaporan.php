<?php
if (isset($_GET['idpgb']) || isset($_GET['inpage'])) {
    $idpgb = $_GET['idpgb'];
}
$sensem = $auth_user->runQuery("SELECT ID, NOKP, NAMAGURU FROM sip_pgb WHERE SIP = :sip");
$sensem->bindParam(':sip',$namapengguna);
?>

<style>
    .backwhite {
        background-color:white;
        min-height:500px;
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

<div class="col-md-12 backwhite">
    <div class="container">
        <form class="row mtb">
            <div class="col-md-8">
                <select class="form-control" name="idpgb">
                    <option>Sila Pilih PGB...</option>
                    <?php
                        $sensem->execute();
                        while($sSemua = $sensem->fetch(PDO::FETCH_ASSOC)) {
                            if($sSemua['ID']==$idpgb) {$selic = 'selected';} else {$selic = '';}
                            echo'<option value="'.$sSemua['ID'].'" '.$selic.'>'.$sSemua['NAMAGURU'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <input type="hidden" name="page" value="pelaporan">
                <button type="submit" name="inpage" value="rumusan" class="btn btn-primary btn-block"><i class="fa fa-file-text"></i> RUMUSAN</button>
            </div>
            <div class="col-md-2">
                <button type="submit" name="inpage" value="carta" class="btn btn-success btn-block"><i class="fa fa-bar-chart"></i> CARTA</button>
            </div>
        </form>
        <div class="row mtb">
            <div class="col-md-12">
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