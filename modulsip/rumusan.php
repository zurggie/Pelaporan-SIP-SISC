<?php
function displaystd($std) {
    if($std == 0) {$op = '';}
    elseif ($std == 99) {$op = '<i class="fa fa-check-circle text-success"></i>';}
    else {$op = $std;}
    return $op;
}

if(isset($_POST['delbim'])) {
    $xbim = $auth_user->runQuery("DELETE FROM sip_pgb_data WHERE ID = :id");
    $xbim->bindParam(':id',$_POST['id']);
    $xbim->execute();
    echo'
    <script>
        window.alert("Proses buang berjaya");
    </script>';
}

$sqlpgb = $auth_user->runQuery("SELECT NOKP FROM sip_pgb WHERE ID = :id");
$sqlpgb->bindParam(':id',$idpgb);
$sqlpgb->execute();
$rpgb = $sqlpgb->fetch(PDO::FETCH_ASSOC);
$ic2 = $rpgb['NOKP'];

$sqlbim = $auth_user->runQuery("SELECT * FROM sip_pgb_data WHERE NOKP = :nokp");
$sqlbim->bindParam(':nokp',$ic2);
?>

<h3><strong>RUMUSAN LAPORAN BIMBINGAN PGB</strong></h3>
<div class="row mtb">
    <div class="col-md-12" style="overflow-x:auto;">
        <table class="std1" style="width:100%;text-align:center;">
            <thead>
                <tr style="height:30px;background-color:silver;">
                    <th colspan="14">STANDARD 1</th>
                </tr>
                <tr style="height:30px;background-color:silver;">
                    <th>BILANGAN & JENIS BIMBINGAN</th>
                    <th>TARIKH BIMBINGAN</th>
                    <th>1.1.1</th>
                    <th>1.1.2</th>
                    <th>1.1.3</th>
                    <th>1.1.4</th>
                    <th>1.1.5</th>
                    <th>1.1.6</th>
                    <th>1.1.7</th>
                    <th>1.2.1</th>
                    <th>1.2.2</th>
                    <th>1.3.1</th>
                    <th>1.3.2</th>
                    <th>1.3.3</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $s1c = 1;
                $sqlbim->execute();
                while($rbim = $sqlbim->fetch(PDO::FETCH_ASSOC)) {
                    
                    
                    echo '
                    <tr style="height:25px;";>
                        <td>BIMBINGAN '.$s1c.' ('.$rbim["JENIS"].')</td>
                        <td>'.date('d/m/Y',strtotime($rbim["TARIKH"])).'</td>
                        <td>'.displaystd($rbim["S111"]).'</td>
                        <td>'.displaystd($rbim["S112"]).'</td>
                        <td>'.displaystd($rbim["S112"]).'</td>
                        <td>'.displaystd($rbim["S113"]).'</td>
                        <td>'.displaystd($rbim["S114"]).'</td>
                        <td>'.displaystd($rbim["S115"]).'</td>
                        <td>'.displaystd($rbim["S116"]).'</td>
                        <td>'.displaystd($rbim["S117"]).'</td>
                        <td>'.displaystd($rbim["S121"]).'</td>
                        <td>'.displaystd($rbim["S122"]).'</td>
                        <td>'.displaystd($rbim["S131"]).'</td>
                        <td>'.displaystd($rbim["S132"]).'</td>
                    </tr>'; $s1c++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row mtb"></div>
<div class="row mtb">
    <div class="col-md-12" style="overflow-x:auto;">
        <table class="std1" style="width:100%;text-align:center;">
            <thead>
                <tr style="height:30px;background-color:silver;">
                    <th colspan="11">STANDARD 2</th>
                </tr>
                <tr style="height:30px;background-color:silver;">
                    <th>BILANGAN & JENIS BIMBINGAN</th>
                    <th>TARIKH BIMBINGAN</th>
                    <th>2.1.1</th>
                    <th>2.1.2</th>
                    <th>2.2.1</th>
                    <th>2.3.1</th>
                    <th>2.4.1</th>
                    <th>2.5.1</th>
                    <th>2.5.2</th>
                    <th>2.6.1</th>
                    <th>2.7.1</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $s2c = 1;
                $sqlbim->execute();
                while($rbim = $sqlbim->fetch(PDO::FETCH_ASSOC)) {
                    echo '
                    <tr style="height:25px;";>
                        <td>BIMBINGAN '.$s2c.' ('.$rbim["JENIS"].')</td>
                        <td>'.date('d/m/Y',strtotime($rbim["TARIKH"])).'</td>
                        <td>'.displaystd($rbim["S211"]).'</td>
                        <td>'.displaystd($rbim["S212"]).'</td>
                        <td>'.displaystd($rbim["S221"]).'</td>
                        <td>'.displaystd($rbim["S231"]).'</td>
                        <td>'.displaystd($rbim["S241"]).'</td>
                        <td>'.displaystd($rbim["S251"]).'</td>
                        <td>'.displaystd($rbim["S252"]).'</td>
                        <td>'.displaystd($rbim["S261"]).'</td>
                        <td>'.displaystd($rbim["S271"]).'</td>
                    </tr>'; $s2c++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row mtb">
    <div class="col-md-3 col-md-offset-6">
        <a href="index.php?page=lapor&idpgb=<?php echo $idpgb;?>" class="btn btn-primary btn-block"><i class="fa fa-plus-circle"></i> TAMBAH BIMBINGAN</a>
    </div>
    <div class="col-md-3">
        <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#buang"><i class="fa fa-minus-circle"></i> BUANG BIMBINGAN</button>
    </div>
</div>

<!-- MODAL BUANG BIMBINGAN -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" id="buang">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">MENU BUANG BIMBINGAN</h4>
        </div>
        <div class="modal-body text-center">
            <p>Sila pilih bimbingan yang ingin dibuang. Sistem akan membuang semua maklumat bimbingan pada sesi berkenaan.</p>
            <form class="row" method="POST">
                <div class="col-md-12">
                    <select name="id" class="form-control">
                        <option value="" disabled selected>Sila Pilih...</option>
                        <?php
                        $sqlbim->execute();
                        while($xbil = $sqlbim->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="'.$xbil['ID'].'">Bimbingan Ke-'.$xbil['BILKE'].' Pada '.date('d/m/Y',strtotime($xbil['TARIKH'])).'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-12 mtb">
                    <button type="submit" name="delbim" class="btn btn-danger btn-block"><i class="fa fa-trash"></i> BUANG</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
<!-- MODAL BUANG BIMBINGAN -->