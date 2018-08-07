<?php
$senq = $auth_user->runQuery("SELECT sip_pgb.*, tssekolah.NAMASEKOLAH FROM sip_pgb
INNER JOIN tssekolah ON sip_pgb.KODSEKOLAH = tssekolah.KODSEKOLAH WHERE sip_pgb.SIP = :icsip");
$senq->bindParam(':icsip',$namapengguna);
?>

<style>
    .mtb {
        margin-top:1rem;
        margin-bottom:1rem;
    }
    #example23,
    #example23 th {
        text-align:center;
    }
</style>

<div class="col-md-12 backwhite">
        <div class="row mtb">
            <div class="col-md-12">
                <h2><strong>SENARAI RAKAN PGB</strong></h2>
                <div class="table-responsive">
                    <table id="example23" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>BIL</th>
                                <th>NO KP</th>
                                <th>NAMA RAKAN PGB</th>
                                <th>NAMA SEKOLAH</th>
                                <th>TARIKH AKTIF</th>
                                <th colspan="4">ARAHAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $bil = 1;
                            $senq->execute();
                            while($rsen = $senq->fetch(PDO::FETCH_ASSOC)) {
                                echo '
                                <tr>
                                    <td>'.$bil.'</td>
                                    <td>'.$rsen['NOKP'].'</td>
                                    <td>'.$rsen['NAMAGURU'].'</td>
                                    <td>'.$rsen['NAMASEKOLAH'].'</td>
                                    <td>'.$rsen['TARIKHAKTIF'].'</td>
                                    <td><a href="index.php?page=daftar&idpgb='.$rsen['ID'].'" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Kemaskini Maklumat">
                                    <i class="fa fa-pencil"></i></a></td>
                                    <td><a href="index.php?page=lapor&idpgb='.$rsen['ID'].'" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Tambah Bimbingan">
                                    <i class="fa fa-plus"></i></a></td>
                                    <td><a href="index.php?page=pelaporan&inpage=rumusan&idpgb='.$rsen['ID'].'" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Lihat Pelaporan">
                                    <i class="fa fa-file-text-o"></i></a></td>
                                    <td><a href="" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Buang PGB">
                                    <i class="fa fa-trash"></i></a></td>
                                </tr>'; $bil++;
                            }
                            ?>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-md-offset-9">
                <a href="index.php?page=daftar" class="btn btn-primary btn-block">DAFTAR RAKAN PGB</a>
            </div>
        </div>
</div>