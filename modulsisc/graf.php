<style>
.kad {
    background-color: white;
    padding: 1rem 1rem;
    height: auto;
}
.mt {
    margin-top: 2rem;
}
.mb {
    margin-bottom: 2rem;
}
.mts {
    margin-top: 1rem;
}
</style>

<?php

if($userlevel == 15) {
    $negeri = $kodnegeri;
    $ppd = $kodppd;
    $sisc = $nokpsisc;
    $xneg = 'disabled';
    $xppd = 'disabled';
    $xsisc = 'disabled';
    
    $arr = array();
    for($i=1;$i<=8;$i++) {
        if($i==1){$cols = 'S411';}
        if($i==2){$cols = 'S421';}
        if($i==3){$cols = 'S422';}
        if($i==4){$cols = 'S431';}
        if($i==5){$cols = 'S441';}
        if($i==6){$cols = 'S442';}
        if($i==7){$cols = 'S451';}
        if($i==8){$cols = 'S461';}

        $tps = $auth_user->runQuery("SELECT COUNT($cols) AS ou FROM sisc_guru_data WHERE SISC = :kodsisc AND $cols <> 0");
        $tps->bindParam(':kodsisc',$sisc);
        $tps->execute();
        $rowt = $tps->fetch(PDO::FETCH_ASSOC);
        $arr[] = $rowt['ou'];
    }
}

if($userlevel == 50 && (!isset($_POST['tapissisc']) || !isset($_POST['tapisgdb']))) {
    $negeri = $kodnegeri;
    $ppd = $kodppd;
    $xneg = 'disabled';
    $xppd = 'disabled';
    $xsisc = '';
    
    $arr = array();
    for($i=1;$i<=8;$i++) {
        if($i==1){$cols = 'S411';}
        if($i==2){$cols = 'S421';}
        if($i==3){$cols = 'S422';}
        if($i==4){$cols = 'S431';}
        if($i==5){$cols = 'S441';}
        if($i==6){$cols = 'S442';}
        if($i==7){$cols = 'S451';}
        if($i==8){$cols = 'S461';}

        $tps = $auth_user->runQuery("SELECT COUNT($cols) AS ou FROM sisc_guru_data WHERE KODPPD = :kodppd AND $cols <> 0");
        $tps->bindParam(':kodppd',$ppd);
        $tps->execute();
        $rowt = $tps->fetch(PDO::FETCH_ASSOC);
        $arr[] = $rowt['ou'];
    }
}


if(isset($_POST['tapisnegeri'])) {
    $negeri = $_POST['negeri'];
    $arr = array();
    for($i=1;$i<=8;$i++) {
        if($i==1){$cols = 'S411';}
        if($i==2){$cols = 'S421';}
        if($i==3){$cols = 'S422';}
        if($i==4){$cols = 'S431';}
        if($i==5){$cols = 'S441';}
        if($i==6){$cols = 'S442';}
        if($i==7){$cols = 'S451';}
        if($i==8){$cols = 'S461';}

        $tps = $auth_user->runQuery("SELECT COUNT($cols) AS ou FROM sisc_guru_data WHERE KODNEGERI = :kodnegeri AND $cols <> 0");
        $tps->bindParam(':kodnegeri',$negeri);
        $tps->execute();
        $rowt = $tps->fetch(PDO::FETCH_ASSOC);
        $arr[] = $rowt['ou'];
    }
}

if(isset($_POST['tapisppd'])) {
    $negeri = $_POST['negeri'];
    $ppd = $_POST['ppd'];
    $arr = array();
    for($i=1;$i<=8;$i++) {
        if($i==1){$cols = 'S411';}
        if($i==2){$cols = 'S421';}
        if($i==3){$cols = 'S422';}
        if($i==4){$cols = 'S431';}
        if($i==5){$cols = 'S441';}
        if($i==6){$cols = 'S442';}
        if($i==7){$cols = 'S451';}
        if($i==8){$cols = 'S461';}

        $tps = $auth_user->runQuery("SELECT COUNT($cols) AS ou FROM sisc_guru_data WHERE KODPPD = :kodppd AND $cols <> 0");
        $tps->bindParam(':kodppd',$ppd);
        $tps->execute();
        $rowt = $tps->fetch(PDO::FETCH_ASSOC);
        $arr[] = $rowt['ou'];
    }
}

if(isset($_POST['tapissisc'])) {
    $negeri = $_POST['negeri'];
    $ppd = $_POST['ppd'];
    $sisc = $_POST['sisc'];
    $arr = array();
    for($i=1;$i<=8;$i++) {
        if($i==1){$cols = 'S411';}
        if($i==2){$cols = 'S421';}
        if($i==3){$cols = 'S422';}
        if($i==4){$cols = 'S431';}
        if($i==5){$cols = 'S441';}
        if($i==6){$cols = 'S442';}
        if($i==7){$cols = 'S451';}
        if($i==8){$cols = 'S461';}

        $tps = $auth_user->runQuery("SELECT COUNT($cols) AS ou FROM sisc_guru_data WHERE SISC = :kodsisc AND $cols <> 0");
        $tps->bindParam(':kodsisc',$sisc);
        $tps->execute();
        $rowt = $tps->fetch(PDO::FETCH_ASSOC);
        $arr[] = $rowt['ou'];
    }
}

if(isset($_POST['tapisgdb'])) {
    $negeri = $_POST['negeri'];
    $ppd = $_POST['ppd'];
    $sisc = $_POST['sisc'];
    $gdb = $_POST['gdb'];
    $arr = array();
    for($i=1;$i<=8;$i++) {
        if($i==1){$cols = 'S411';}
        if($i==2){$cols = 'S421';}
        if($i==3){$cols = 'S422';}
        if($i==4){$cols = 'S431';}
        if($i==5){$cols = 'S441';}
        if($i==6){$cols = 'S442';}
        if($i==7){$cols = 'S451';}
        if($i==8){$cols = 'S461';}

        $tps = $auth_user->runQuery("SELECT COUNT($cols) AS ou FROM sisc_guru_data WHERE NOKP = :kodgdb AND $cols <> 0");
        $tps->bindParam(':kodgdb',$gdb);
        $tps->execute();
        $rowt = $tps->fetch(PDO::FETCH_ASSOC);
        $arr[] = $rowt['ou'];
    }
}
    $s411 = $arr[0];
    $s421 = $arr[1];
    $s422 = $arr[2];
    $s431 = $arr[3];
    $s441 = $arr[4];
    $s442 = $arr[5];
    $s451 = $arr[6];
    $s461 = $arr[7];
    
$stneg = $auth_user->runQuery("SELECT KODNEGERI,NAMANEGERI FROM tknegeri ORDER BY NAMANEGERI ASC");
$stneg->execute();

$stppd = $auth_user->runQuery("SELECT KODPPD,NAMAPPD FROM tkppd WHERE KODNEGERI = :kodnegeri ORDER BY NAMAPPD ASC");
if($userlevel <= 60) {
    $stppd->bindParam(':kodnegeri',$negeri);
} else {
    $stppd->bindParam(':kodnegeri',$_POST['negeri']);
}
$stppd->execute();

$stsisc = $auth_user->runQuery("SELECT user_name,real_name FROM users WHERE userlevel = 15 AND kodppd = :kodppd ORDER BY real_name ASC");
if($userlevel <= 50) {
    $stsisc->bindParam(':kodppd',$ppd);
} else {
    $stsisc->bindParam(':kodppd',$_POST['ppd']);
}
$stsisc->execute();

$stgdb = $auth_user->runQuery("SELECT NOKP,NAMAGURU FROM sisc_guru WHERE SISC = :kodsisc ORDER BY NAMAGURU ASC");
if($userlevel == 15) {
    $stgdb->bindParam(':kodsisc',$sisc);
} else {
    $stgdb->bindParam(':kodsisc',$_POST['sisc']);
}
$stgdb->execute();

?>
<div class="col-sm-12">
    <div class="row" style="margin-top: 1rem;">
        <div class="col-sm-12 col-md-3">
            <div class="row kad" style="margin-right:0.5rem;">
                <div class="col-sm-12">
                    <h4 style="text-align: center; background-color:#2F323E; color:white; padding:1rem; border-radius: 5px;"><i class="fa fa-line-chart" ></i> TAPIS DATA</h4>
                </div>
                <div class="col-sm-12 mt">
                    Negeri
                </div>
                <form class="col-sm-12" method="POST">
                    <select class="form-control" name="negeri" <?php echo $xneg;?>>
                        <?php
                        while($rowneg = $stneg->fetch(PDO::FETCH_ASSOC)) {
                            $kodneg = $rowneg['KODNEGERI'];
                            $namaneg = $rowneg['NAMANEGERI'];
                            if($kodneg == $negeri){$negsel = 'selected';} else {$negsel = "";}
                            echo'
                            <option value='.$kodneg.' '.$negsel.'>'.$namaneg.'</option>
                        ';}?>
                    </select>
                    <button <?php echo $xneg;?> class="btn btn-primary btn-block mts" type="submit" name="tapisnegeri">TAPIS NEGERI</button>
                </form>
                <div class="col-sm-12 mt">
                    Daerah
                </div>
                <form class="col-sm-12" method="POST">
                    <select class="form-control" name="ppd" <?php echo $xppd;?>>
                        <?php
                        while($rowppd = $stppd->fetch(PDO::FETCH_ASSOC)) {
                            $kodppd2 = $rowppd['KODPPD'];
                            $namappd = $rowppd['NAMAPPD'];
                            if($kodppd2 == $ppd){$ppdsel = 'selected';} else {$ppdsel = "";}
                            echo'
                            <option value='.$kodppd2.' '.$ppdsel.'>'.$namappd.'</option>
                        ';}?>
                    </select>
                    <input type="hidden" value="<?echo $negeri;?>" name="negeri">
                    <?php if($userlevel == 50) { echo '
                    <a href="../modulppd/analisappd.php?id=graf" class="btn btn-primary btn-block mts">TAPIS PPD</a>';
                    } else { echo'
                    <button '.$xppd.' class="btn btn-primary btn-block mts" type="submit" name="tapisppd">TAPIS PPD</button>';
                    } ?>
                </form>
                <div class="col-sm-12 mt">
                    SISC+
                </div>
                <form class="col-sm-12" method="POST">
                    <select class="form-control" name="sisc" <?php echo $xsisc;?>>
                        <option value="" disabled <?php if($sisc==""){echo 'selected';}?>>Pilih SISC...</option>
                        <?php
                        while($rowsisc = $stsisc->fetch(PDO::FETCH_ASSOC)) {
                            $kodsisc = $rowsisc['user_name'];
                            $namasisc = $rowsisc['real_name'];
                            if($kodsisc == $sisc){$siscsel = 'selected';} else {$siscsel = "";}
                            echo'
                            <option value='.$kodsisc.' '.$siscsel.'>'.$namasisc.'</option>
                        ';}?>
                    </select>
                    <input type="hidden" value="<?echo $negeri;?>" name="negeri">
                    <input type="hidden" value="<?echo $ppd;?>" name="ppd">
                    <?php if($userlevel == 15) { echo '
                    <a href="analisa.php?id=graf" class="btn btn-primary btn-block mts">TAPIS SISC</a>';
                    } else { echo'
                    <button class="btn btn-primary btn-block mts" type="submit" name="tapissisc">TAPIS SISC</button>';
                    } ?>
                </form>
                <div class="col-sm-12 mt">
                    GDB
                </div>
                <form class="col-sm-12" method="POST">
                    <select class="form-control" name="gdb">
                        <option value="" disabled <?php if($gdb==""){echo 'selected';}?>>Pilih GDB...</option>
                        <?php
                        while($rowgdb = $stgdb->fetch(PDO::FETCH_ASSOC)) {
                            $kodgdb = $rowgdb['NOKP'];
                            $namagdb = $rowgdb['NAMAGURU'];
                            if($kodgdb == $gdb){$gdbsel = 'selected';} else {$gdbsel = "";}
                            echo'
                            <option value='.$kodgdb.' '.$gdbsel.'>'.$namagdb.'</option>
                        ';}?>
                    </select>
                    <input type="hidden" value="<?echo $negeri;?>" name="negeri">
                    <input type="hidden" value="<?echo $ppd;?>" name="ppd">
                    <input type="hidden" value="<?echo $sisc;?>" name="sisc">
                    <button class="btn btn-primary btn-block mts" type="submit" name="tapisgdb">TAPIS GDB</button>
                </form>

            </div>
        </div>
        <div class="col-sm-12 col-md-9">
            <div class="row kad">
                <div class="col-sm-12" style="height:550px;">
                    <canvas id="bar-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
var arr = <?php echo json_encode($arr); ?>;

var grafColor = [
  "#C0392B",
  "#884EA0",
  "#2E86C1",
  "#17A589",
  "#ffea00",
  "#FF5733",
  "#aeea00",
  "#5D6D7E",
  "#85C1E9",
  "#7DCEA0",
  "#F9E79F"
];
var myColor = new Array(arr.length);

for(var i=0;i<=arr.length;i++) {
  myColor[i] = grafColor[i];
}
var max = Math.max(...arr);
var step;

if(max <= 10) {
  step = 1;
} else if (max > 10 && max <= 50) {
  step = 5;
} else if (max > 50 && max <= 100) {
  step = 10;
} else {
  step = 20;
}

new Chart(document.getElementById("bar-chart"), {
    type: 'bar',
    data: {
      labels: ["S4.1.1", "S4.2.1", "S4.2.2", "S4.3.1", "S4.4.1", "S4.4.2", "S4.5.1", "S4.6.1"],
      datasets: [
        {
          label: "Bilangan Bimbingan",
          backgroundColor: myColor,
          data: arr
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Analisa Bilangan Bimbingan Mengikut Standard 4 SKPMg2',
        fontSize: 20,
        fontStyle: 'bold',
        padding: 20
      },
      scales: {
          yAxes: [{
              ticks: {
                  beginAtZero:true,
                  stepSize: step
              },
              scaleLabel: {
                  display: true,
                  labelString: "Bilangan Bimbingan"
              }
          }],
          xAxes: [{
            ticks: {
                fontSize: 14
            }
          }]
        },
        plugins: {
          datalabels: {
            color: 'white',
            anchor: 'end',
            align: 'start',
            font : {
              weight: 'bold',
              size: 18
            }
          }
        }
    }
});
</script>