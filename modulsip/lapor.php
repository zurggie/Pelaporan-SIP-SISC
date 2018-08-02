<?php
if (isset($_GET['idpgb'])) {
    $idpgb = $_GET['idpgb'];

    $sqlpgb = $auth_user->runQuery("SELECT sip_pgb.*, tssekolah.NAMASEKOLAH FROM sip_pgb
    INNER JOIN tssekolah ON sip_pgb.KODSEKOLAH = tssekolah.KODSEKOLAH WHERE ID = :id");
    $sqlpgb->bindParam(':id',$idpgb);
    $sqlpgb->execute();
    $rpgb = $sqlpgb->fetch(PDO::FETCH_ASSOC);
?>

<style>
    .mtb {
        margin-top:1rem;
        margin-bottom:1rem;
    }
    .tbllapor tr {
        height: 30px;
    }
    .tblstd table {
        border: 1px solid black;
    }
    .tblstd th{
        border: 1px solid black;
    }
    .tblstd td{
        border: 1px solid black;
    }
    .tblstd th{
        text-align:center;
    }
    .wik {
        width:50px;
        margin:5px;
    }
</style>

<form action="proclapor.php" method="POST" class="col-xs-12" style="background-color:white;">
    <div class="container">
        <div class="row mtb">
            <h3>Pelaporan Bimbingan Oleh Pegawai SIP+</h3>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table class="tbllapor" style="width:100%">
                    <tbody>
                        <tr>
                            <td><strong>No Kad Pengenalan</strong></td>
                            <td style="width:3%;">:</td>
                            <td><?php echo $rpgb['NOKP'];?></td>
                        </tr>
                        <tr>
                            <td><strong>Nama PGB Yang Dibimbing</strong></td>
                            <td>:</td>
                            <td><?php echo $rpgb['NAMAGURU'];?></td>
                        </tr>
                        <tr>
                            <td><strong>Nama Sekolah</strong></td>
                            <td>:</td>
                            <td><?php echo $rpgb['NAMASEKOLAH'];?></td>
                        </tr>
                        <tr>
                            <td><strong>Bimbingan yang ke</strong></td>
                            <td>:</td>
                            <td>
                                <select name="bilke">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                                 / <?php echo date('Y');?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Tarikh Bimbingan</strong></td>
                            <td>:</td>
                            <td>
                                <select name="hari">
                                    <?php
                                    for($h=1;$h<=31;$h++) {
                                        echo'<option value="'.$h.'">'.$h.'</option>';
                                    }
                                    ?>
                                </select> / 
                                <select name="bulan">
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Mac</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Jun</option>
                                    <option value="07">Julai</option>
                                    <option value="08">Ogos</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Disember</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Jenis Bimbingan</strong></td>
                            <td>:</td>
                            <td>
                                <select name="jenisb">
                                    <option selected disabled>Sila Pilih...</option>
                                    <option value="TOV">TOV</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Standard 1 SKPMg2</strong></td>
                            <td>:</td>
                            <td>
                                <table class="tblstd mtb" style="width:100%;text-align:center;">
                                    <tr>
                                        <th colspan="12">STANDARD 1</th>
                                    </tr>
                                    <tr>
                                        <td>1.1.1</td>
                                        <td>1.1.2</td>
                                        <td>1.1.3</td>
                                        <td>1.1.4</td>
                                        <td>1.1.5</td>
                                        <td>1.1.6</td>
                                        <td>1.1.7</td>
                                        <td>1.2.1</td>
                                        <td>1.2.2</td>
                                        <td>1.3.1</td>
                                        <td>1.3.2</td>
                                        <td>1.3.3</td>
                                    </tr>
                                    <tr>
                                        <th colspan="12">FOKUS</th>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="f111" value="99"></td>
                                        <td><input type="checkbox" name="f112" value="99"></td>
                                        <td><input type="checkbox" name="f113" value="99"></td>
                                        <td><input type="checkbox" name="f114" value="99"></td>
                                        <td><input type="checkbox" name="f115" value="99"></td>
                                        <td><input type="checkbox" name="f116" value="99"></td>
                                        <td><input type="checkbox" name="f117" value="99"></td>
                                        <td><input type="checkbox" name="f121" value="99"></td>
                                        <td><input type="checkbox" name="f122" value="99"></td>
                                        <td><input type="checkbox" name="f131" value="99"></td>
                                        <td><input type="checkbox" name="f132" value="99"></td>
                                        <td><input type="checkbox" name="f133" value="99"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="12">SKOR</th>
                                    </tr>
                                    <tr>
                                        <td><input type="number" class="wik" name="s111"></td>
                                        <td><input type="number" class="wik" name="s112"></td>
                                        <td><input type="number" class="wik" name="s113"></td>
                                        <td><input type="number" class="wik" name="s114"></td>
                                        <td><input type="number" class="wik" name="s115"></td>
                                        <td><input type="number" class="wik" name="s116"></td>
                                        <td><input type="number" class="wik" name="s117"></td>
                                        <td><input type="number" class="wik" name="s121"></td>
                                        <td><input type="number" class="wik" name="s122"></td>
                                        <td><input type="number" class="wik" name="s131"></td>
                                        <td><input type="number" class="wik" name="s132"></td>
                                        <td><input type="number" class="wik" name="s133"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Standard 2 SKPMg2</strong></td>
                            <td>:</td>
                            <td>
                                <table class="tblstd mtb" style="width:100%;text-align:center;">
                                    <tr>
                                        <th colspan="12">STANDARD 2</th>
                                    </tr>
                                    <tr>
                                        <td>2.1.1</td>
                                        <td>2.1.2</td>
                                        <td>2.2.1</td>
                                        <td>2.3.1</td>
                                        <td>2.4.1</td>
                                        <td>2.5.1</td>
                                        <td>2.5.2</td>
                                        <td>2.6.1</td>
                                        <td>2.7.2</td>
                                    </tr>
                                    <tr>
                                        <th colspan="12">FOKUS</th>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="f211" value="99"></td>
                                        <td><input type="checkbox" name="f212" value="99"></td>
                                        <td><input type="checkbox" name="f221" value="99"></td>
                                        <td><input type="checkbox" name="f231" value="99"></td>
                                        <td><input type="checkbox" name="f241" value="99"></td>
                                        <td><input type="checkbox" name="f251" value="99"></td>
                                        <td><input type="checkbox" name="f252" value="99"></td>
                                        <td><input type="checkbox" name="f261" value="99"></td>
                                        <td><input type="checkbox" name="f271" value="99"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="12">SKOR</th>
                                    </tr>
                                    <tr>
                                        <td><input type="number" max="4" class="wik" name="s211"></td>
                                        <td><input type="number" class="wik" name="s212"></td>
                                        <td><input type="number" class="wik" name="s221"></td>
                                        <td><input type="number" class="wik" name="s231"></td>
                                        <td><input type="number" class="wik" name="s241"></td>
                                        <td><input type="number" class="wik" name="s251"></td>
                                        <td><input type="number" class="wik" name="s252"></td>
                                        <td><input type="number" class="wik" name="s261"></td>
                                        <td><input type="number" class="wik" name="s271"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Catatan</strong></td>
                            <td>:</td>
                            <td><textarea name="catatan" class="form-control" rows="5"></textarea></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="row mtb">
                                    <div class="col-xs-3">
                                        <input type="hidden" name="idpgb" value="<?php echo $idpgb;?>">
                                        <input type="hidden" name="icpgb" value="<?php echo $rpgb['NOKP'];?>">
                                        <button type="submit" name="fromlapor" class="btn btn-primary btn-block">SIMPAN</button>
                                    </div>
                                    <div class="col-xs-3">
                                        <button class="btn btn-danger btn-block">BATAL</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tdbody>
                </table>
            </div>
        </div>
    </div>
</form>

<?php
} else {
   echo 'Tiada';
}
?>