<?php
    $qskool = $auth_user->runQuery("SELECT NAMASEKOLAH,KODSEKOLAH FROM tssekolah WHERE KODPPD = :kod");
    $qskool->bindParam(':kod',$kodppd);

    if(isset($_POST['addpgb'])) {
        $qadd = $auth_user->runQuery("INSERT INTO sip_pgb (SIP,NOKP,NAMAGURU,KODSEKOLAH,KODNEGERI,KODPPD) VALUES
        (:sip,:nokp,:nama,:kodsek,:kodneg,:kodppd)");
        $qadd->bindParam(':sip',$namapengguna);
        $qadd->bindParam(':nokp',$_POST['ic']);
        $qadd->bindParam(':nama',$_POST['nama']);
        $qadd->bindParam(':kodsek',$_POST['sekolah']);
        $qadd->bindParam(':kodneg',$kodnegeri);
        $qadd->bindParam(':kodppd',$kodppd);
        $qadd->execute();

        header("Location: index.php?page=senarai");
    }

    if(isset($_POST['editpgb'])) {
        $qadd = $auth_user->runQuery("UPDATE sip_pgb SET NOKP = :nokp, NAMAGURU = :nama, KODSEKOLAH = :kod WHERE ID = :id");
        $qadd->bindParam(':nokp',$_POST['ic']);
        $qadd->bindParam(':nama',$_POST['nama']);
        $qadd->bindParam(':kod',$_POST['sekolah']);
        $qadd->bindParam(':id',$_POST['id']);
        $qadd->execute();

        header("Location: index.php?page=senarai");
    }

    if(isset($_GET['idpgb'])) {
        $qinfo = $auth_user->runQuery("SELECT * FROM sip_pgb WHERE ID = :id");
        $qinfo->bindParam(':id',$_GET['idpgb']);
        $qinfo->execute();

        $rinfo = $qinfo->fetch(PDO::FETCH_ASSOC);
        $icpgb = $rinfo['NOKP'];
        $namapgb = $rinfo['NAMAGURU'];
        $kodsek = $rinfo['KODSEKOLAH'];
        $ro = 'readonly';
    } else {
        $icpgb = "";
        $namapgb = "";
        $kodsek = "";
        $ro = "";
    }
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
</style>

<div class="col-md-12 backwhite">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2><strong>DAFTAR PGB</strong></h2>
            </div>
        </div>
        <div class="row mtb">
            <form action="index.php?page=daftar" method="POST" class="form-horizontal">
                <div class="form-group">
                    <label for="ic" class="col-sm-2 control-label">NO KP</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="ic" value="<?php echo $icpgb;?>" <?php echo $ro;?>>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama" class="col-sm-2 control-label">NAMA PGB</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" value="<?php echo $namapgb;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="sekolah" class="col-sm-2 control-label">NAMA SEKOLAH</label>
                    <div class="col-sm-10">
                        <select name="sekolah" id="" class="form-control">
                            <option value="" disabled selected>Sila Pilih Sekolah PGB...</option>
                            <?php
                            $qskool->execute();
                            while($listsk = $qskool->fetch(PDO::FETCH_ASSOC)) {
                                if($listsk['KODSEKOLAH'] == $kodsek) {$sel = 'selected';} else {$sel = '';}
                                echo'
                                <option value="'.$listsk['KODSEKOLAH'].'" '.$sel.'>'.$listsk['NAMASEKOLAH'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-md-offset-9">
                    <?php
                    if(isset($_GET['idpgb'])) {
                        echo '
                        <input type="hidden" name="id" value="'.$_GET['idpgb'].'">
                        <button type="submit" name="editpgb" class="btn btn-success btn-block">KEMASKINI</button>';
                    } else {
                        echo '
                        <button type="submit" name="addpgb" class="btn btn-info btn-block">TAMBAH</button>';
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>