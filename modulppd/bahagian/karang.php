<?php
    if(isset($_POST['announce'])) {
        $insq = $auth_user->runQuery("INSERT INTO pengumuman (tarikh,sumber,kepada,tajuk,kandungan,status) VALUES (NOW(),:sumber,:kepada,:tajuk,:kandungan,0)");
        $insq->bindParam(':sumber',$kodppd);
        $insq->bindParam(':kepada',$_POST['target']);
        $insq->bindParam(':tajuk',$_POST['tajuk']);
        $insq->bindParam(':kandungan',$_POST['kandungan']);
        $insq->execute();

        echo'<script>alert("Pengumuman berjaya diterbitkan namun belum aktif. Sila aktifkan di dalam menu SENARAI PENGUMUMAN")</script>';
    }

    if(isset($_POST['changetoggle'])) {
        $togq = $auth_user->runQuery("UPDATE pengumuman SET status = :stats WHERE id = :id");
        $togq->bindParam(':stats',$_POST['toggle']);
        $togq->bindParam(':id',$_POST['id']);
        $togq->execute();

        echo'<script>alert("Status pengumuman berjaya ditukar")</script>';
    }

    if(isset($_POST['buang'])) {
        $togq = $auth_user->runQuery("DELETE FROM pengumuman WHERE id = :id");
        $togq->bindParam(':id',$_POST['id']);
        $togq->execute();

        echo'<script>alert("Pengumuman berjaya dibuang daripada pangkalan data")</script>';
    }
?>

<style>
    #tableumum, #tableumum th, #tableumum td {
        border: 1px solid silver;
        text-align:center;
    }

    #tableumum {
        border-collapse: collapse;
        width:100%;
        padding:2px;
    }
</style>

<div class="col-md-12 backwhite text-center">
    <h1>KARANG PENGUMUMAN</h1>
    <p><em>Pengumuman boleh dilihat oleh semua SIP dan SISC di bawah PPD masing-masing.<br>Pengumuman perlu dibuat dengan ringkas dan padat agar mudah dibaca.</em></p>
    <div class="row mtb"></div>
    <form class="row mtb" method="POST" action="index.php?page=karang">
        <div class="form-group">
            <label for="target" class="control-label">SASARAN PENGUMUMAN</label>
            <div>
                <label class="radio-inline">
                    <input type="radio" name="target" id="inlineRadio1" value="sip"> SIP SAHAJA
                </label>
                <label class="radio-inline">
                    <input type="radio" name="target" id="inlineRadio2" value="sisc"> SISC SAHAJA
                </label>
                <label class="radio-inline">
                    <input type="radio" name="target" id="inlineRadio3" value="both"> SIP DAN SISC
                </label>
            </div>
            
        </div>
        <div class="form-group">
            <label for="tajuk">TAJUK</label>
            <input type="text" class="form-control" id="tajuk" name="tajuk">
        </div>
        <div class="form-group">
            <label for="kandungan">KANDUNGAN</label>
            <textarea name="kandungan" id="kandungan" class="form-control" rows="5"></textarea>
        </div>
        <div class="col-12 col-md-4 col-md-offset-2 mtb">
            <button type="submit" name="announce" class="btn btn-primary btn-block">TERBITKAN PENGUMUMAN</button>
        </div>
        <div class="col-12 col-md-4 mtb">
            <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#urus">SENARAI PENGUMUMAN</button>
        </div>
    </form>
    <div class="row mtb"></div>
</div>

<!-- MODAL URUS PENGUMUMAN -->
<div class="modal fade" id="urus" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel">PENGURUSAN PENGUMUMAN</h4>
            </div>
            <div class="modal-body text-center">
                <p>Admin boleh mengurus pengumuman-pengumuman yang pernah diterbitkan sebelum ini.</p>
                <table id="tableumum">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>TARIKH</th>
                            <th>TAJUK</th>
                            <th>STATUS</th>
                            <th>BUANG</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $bil = 1;
                            $umumq = $auth_user->runQuery("SELECT * FROM pengumuman WHERE sumber = :kodppd");
                            $umumq->bindParam(':kodppd',$kodppd);
                            $umumq->execute();
                            
                            while($umumr = $umumq->fetch(PDO::FETCH_ASSOC)) {
                                if($umumr['kepada'] == 'sip') {
                                    $untuk = 'SIP+';
                                } elseif($umumr['kepada'] == 'sisc') {
                                    $untuk = 'SISC+';
                                } else {
                                    $untuk = 'SIP+ dan SISC+';
                                }

                                if($umumr['status'] == 1) {
                                    $toggle = '<div class="text-success"><i class="fa fa-toggle-on"></i> ON<div>';
                                    $suis = 0;
                                } else {
                                    $toggle = '<div class="text-danger"><i class="fa fa-toggle-off"></i> OFF</div>';
                                    $suis = 1;
                                }

                                echo'
                                <tr>
                                    <td>'.$bil.'</td>
                                    <td>'.date('d/m/Y',strtotime($umumr['tarikh'])).'</td>
                                    <td>'.$umumr['tajuk'].' (Sasaran : '.$untuk.')</td>
                                    <td>
                                        <form action="index.php?page=karang" method="POST">
                                            <input type="hidden" name="id" value="'.$umumr['id'].'">
                                            <input type="hidden" name="toggle" value="'.$suis.'">
                                            <button type="submit" name="changetoggle" class="btn btn-sm btn-link">'.$toggle.'</button> 
                                        </form>
                                    </td>
                                    <td>
                                        <form action="index.php?page=karang" method="POST">
                                            <input type="hidden" name="id" value="'.$umumr['id'].'">
                                            <button type="submit" name="buang" class="btn btn-sm btn-link"><i class="fa fa-trash text-danger"></i></button> 
                                        </form>
                                    </td>
                                <tr>';$bil++;
                            }
                        ?>
                    </tbody>
                </table>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL URU PENGUMUMAN -->