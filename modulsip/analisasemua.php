<?php
    $std1array = array("S111","S112","S113","S114","S115","S116","S117","S121","S122","S131","S132","S133");
    $std2array = array("S211","S212","S221","S231","S241","S251","S252","S261","S271");
    $data = array();
    
    if(isset($_GET['pgb'])) {
        if(@$_GET['std']==2) {
            foreach($std2array as $std) {
                $qbar1 = "SELECT COUNT(sip_pgb_data.$std) AS std FROM sip_pgb_data INNER JOIN sip_pgb ON sip_pgb_data.NOKP = sip_pgb.NOKP
                WHERE sip_pgb_data.$std <> 0 AND sip_pgb.KODNEGERI = :negeri AND sip_pgb.KODPPD = :daerah AND sip_pgb.SIP = :sip AND sip_pgb.NOKP = :pgb";
                $qbar = $auth_user->runQuery($qbar1);
                $qbar->bindParam(':negeri',$_GET['negeri']);
                $qbar->bindParam(':daerah',$_GET['daerah']);
                $qbar->bindParam(':sip',$_GET['sip']);
                $qbar->bindParam(':pgb',$_GET['pgb']);
                $qbar->execute();
                $data[] = $qbar->fetch(PDO::FETCH_ASSOC)['std'];
            }
            $label = $std2array;
            $stdk = 2;
        } else {
            foreach($std1array as $std) {
                $qbar1 = "SELECT COUNT(sip_pgb_data.$std) AS std FROM sip_pgb_data INNER JOIN sip_pgb ON sip_pgb_data.NOKP = sip_pgb.NOKP
                WHERE sip_pgb_data.$std <> 0 AND sip_pgb.KODNEGERI = :negeri AND sip_pgb.KODPPD = :daerah AND sip_pgb.SIP = :sip AND sip_pgb.NOKP = :pgb";
                $qbar = $auth_user->runQuery($qbar1);
                $qbar->bindParam(':negeri',$_GET['negeri']);
                $qbar->bindParam(':daerah',$_GET['daerah']);
                $qbar->bindParam(':sip',$_GET['sip']);
                $qbar->bindParam(':pgb',$_GET['pgb']);
                $qbar->execute();
                $data[] = $qbar->fetch(PDO::FETCH_ASSOC)['std'];
            }
            $label = $std1array;
            $stdk = 1;
        }   
    } elseif(isset($_GET['sip'])) {
        if(@$_GET['std']==2) {
            foreach($std2array as $std) {
                $qbar1 = "SELECT COUNT(sip_pgb_data.$std) AS std FROM sip_pgb_data INNER JOIN sip_pgb ON sip_pgb_data.NOKP = sip_pgb.NOKP
                WHERE sip_pgb_data.$std <> 0 AND sip_pgb.KODNEGERI = :negeri AND sip_pgb.KODPPD = :daerah AND sip_pgb.SIP = :sip";
                $qbar = $auth_user->runQuery($qbar1);
                $qbar->bindParam(':negeri',$_GET['negeri']);
                $qbar->bindParam(':daerah',$_GET['daerah']);
                $qbar->bindParam(':sip',$_GET['sip']);
                $qbar->execute();
                $data[] = $qbar->fetch(PDO::FETCH_ASSOC)['std'];
            }
            $label = $std2array;
            $stdk = 2;
        } else {
            foreach($std1array as $std) {
                $qbar1 = "SELECT COUNT(sip_pgb_data.$std) AS std FROM sip_pgb_data INNER JOIN sip_pgb ON sip_pgb_data.NOKP = sip_pgb.NOKP
                WHERE sip_pgb_data.$std <> 0 AND sip_pgb.KODNEGERI = :negeri AND sip_pgb.KODPPD = :daerah AND sip_pgb.SIP = :sip";
                $qbar = $auth_user->runQuery($qbar1);
                $qbar->bindParam(':negeri',$_GET['negeri']);
                $qbar->bindParam(':daerah',$_GET['daerah']);
                $qbar->bindParam(':sip',$_GET['sip']);
                $qbar->execute();
                $data[] = $qbar->fetch(PDO::FETCH_ASSOC)['std'];
            }
            $label = $std1array;
            $stdk = 1;
        }   
    } elseif(isset($_GET['daerah'])) {
        if(@$_GET['std']==2) {
            foreach($std2array as $std) {
                $qbar1 = "SELECT COUNT(sip_pgb_data.$std) AS std FROM sip_pgb_data INNER JOIN sip_pgb ON sip_pgb_data.NOKP = sip_pgb.NOKP
                WHERE sip_pgb_data.$std <> 0 AND sip_pgb.KODNEGERI = :negeri AND sip_pgb.KODPPD = :daerah";
                $qbar = $auth_user->runQuery($qbar1);
                $qbar->bindParam(':negeri',$_GET['negeri']);
                $qbar->bindParam(':daerah',$_GET['daerah']);
                $qbar->execute();
                $data[] = $qbar->fetch(PDO::FETCH_ASSOC)['std'];
            }
            $label = $std2array;
            $stdk = 2;
        } else {
            foreach($std1array as $std) {
                $qbar1 = "SELECT COUNT(sip_pgb_data.$std) AS std FROM sip_pgb_data INNER JOIN sip_pgb ON sip_pgb_data.NOKP = sip_pgb.NOKP
                WHERE sip_pgb_data.$std <> 0 AND sip_pgb.KODNEGERI = :negeri AND sip_pgb.KODPPD = :daerah";
                $qbar = $auth_user->runQuery($qbar1);
                $qbar->bindParam(':negeri',$_GET['negeri']);
                $qbar->bindParam(':daerah',$_GET['daerah']);
                $qbar->execute();
                $data[] = $qbar->fetch(PDO::FETCH_ASSOC)['std'];
            }
            $label = $std1array;
            $stdk = 1;
        }   
    } elseif(isset($_GET['negeri'])) {
        if(@$_GET['std']==2) {
            foreach($std2array as $std) {
                $qbar1 = "SELECT COUNT(sip_pgb_data.$std) AS std FROM sip_pgb_data INNER JOIN sip_pgb ON sip_pgb_data.NOKP = sip_pgb.NOKP
                WHERE sip_pgb_data.$std <> 0 AND sip_pgb.KODNEGERI = :negeri";
                $qbar = $auth_user->runQuery($qbar1);
                $qbar->bindParam(':negeri',$_GET['negeri']);
                $qbar->execute();
                $data[] = $qbar->fetch(PDO::FETCH_ASSOC)['std'];
            }
            $label = $std2array;
            $stdk = 2;
        } else {
            foreach($std1array as $std) {
                $qbar1 = "SELECT COUNT(sip_pgb_data.$std) AS std FROM sip_pgb_data INNER JOIN sip_pgb ON sip_pgb_data.NOKP = sip_pgb.NOKP
                WHERE sip_pgb_data.$std <> 0 AND sip_pgb.KODNEGERI = :negeri";
                $qbar = $auth_user->runQuery($qbar1);
                $qbar->bindParam(':negeri',$_GET['negeri']);
                $qbar->execute();
                $data[] = $qbar->fetch(PDO::FETCH_ASSOC)['std'];
            }
            $label = $std1array;
            $stdk = 1;
        }   
    } else {
        if(@$_GET['std']==2) {
            foreach($std2array as $std) {
                $qbar1 = "SELECT COUNT(sip_pgb_data.$std) AS std FROM sip_pgb_data INNER JOIN sip_pgb ON sip_pgb_data.NOKP = sip_pgb.NOKP WHERE sip_pgb_data.$std <> 0";
                $qbar = $auth_user->runQuery($qbar1);
                $qbar->execute();
                $data[] = $qbar->fetch(PDO::FETCH_ASSOC)['std'];
            }
            $label = $std2array;
            $stdk = 2;
        } else {
            foreach($std1array as $std) {
                $qbar1 = "SELECT COUNT(sip_pgb_data.$std) AS std FROM sip_pgb_data INNER JOIN sip_pgb ON sip_pgb_data.NOKP = sip_pgb.NOKP WHERE sip_pgb_data.$std <> 0";
                $qbar = $auth_user->runQuery($qbar1);
                $qbar->execute();
                $data[] = $qbar->fetch(PDO::FETCH_ASSOC)['std'];
            }
            $label = $std1array;
            $stdk = 1;
        }   
    }
?>

<style>
    .backwhite {
        background-color:white;
        min-height:500px;
        padding-left:2rem;
        padding-right:2rem;
    }
    .mypanel {
        border-style: solid;
        border-width: 1px;
        border-color: silver;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        border-radius: 3px; /* 5px rounded corners */
    }
    .mtb {
        margin-top:1rem;
        margin-bottom:1rem;
    }
    .mtb2 {
        margin-top:2rem;
        margin-bottom:2rem;
    }
    .pad {
        padding:1rem;
    }
</style>

<div class="col-md-12 backwhite">
    <div class="row mtb text-center">
        <h1>ANALISA BILANGAN BIMBINGAN MENGIKUT STANDARD</h1>
    </div>
    <div class="row">
        <div class="col-md-3 pad">
            <div class="mypanel pad text-center">
                <h3><strong>MENU SARING</strong></h3>

                <form class="mtb2 text-left">
                    <h5>PILIH NEGERI</h5>
                    <select name="negeri" class="form-control" onchange="this.form.submit()">
                        <option value="" disabled selected>Sila Pilih Negeri...</option>
                    <?php
                        $qneg = $auth_user->runQuery("SELECT * FROM tknegeri");
                        $qneg->execute();
                        while($qnegr = $qneg->fetch(PDO::FETCH_ASSOC)) {
                            if($_GET['negeri'] == $qnegr['KODNEGERI']) {$sel = 'selected';} else {$sel = '';}
                            echo'<option value="'.$qnegr['KODNEGERI'].'" '.$sel.'>'.$qnegr['NAMANEGERI'].'</option>';
                        }
                    ?>
                    </select>
                    <input type="hidden" name="page" value="analisasemua">
                </form>

                <form class="mtb2 text-left <?php if(!isset($_GET['negeri'])) {echo 'hidden';}?>">
                    <h5>PILIH PPD</h5>
                    <select name="daerah" class="form-control" onchange="this.form.submit()">
                        <option value="" disabled selected>Sila Pilih PPD...</option>
                    <?php
                        $qdis = $auth_user->runQuery("SELECT * FROM tkppd WHERE KODNEGERI = :negeri");
                        $qdis->bindParam(':negeri',$_GET['negeri']);
                        $qdis->execute();
                        while($qdisr = $qdis->fetch(PDO::FETCH_ASSOC)) {
                            if($_GET['daerah'] == $qdisr['KODPPD']) {$sel = 'selected';} else {$sel = '';}
                            echo'<option value="'.$qdisr['KODPPD'].'" '.$sel.'>'.$qdisr['NAMAPPD'].'</option>';
                        }
                    ?>
                    </select>
                    <input type="hidden" name="page" value="analisasemua">
                    <input type="hidden" name="negeri" value="<?php echo $_GET['negeri'];?>">
                </form>

                <form class="mtb2 text-left" <?php if(!isset($_GET['daerah'])) {echo 'hidden';}?>>
                    <h5>PILIH SIP</h5>
                    <select name="sip" class="form-control" onchange="this.form.submit()">
                        <option value="" disabled selected>Sila Pilih SIP...</option>
                    <?php
                        $qsip = $auth_user->runQuery("SELECT * FROM users WHERE kodppd = :daerah");
                        $qsip->bindParam(':daerah',$_GET['daerah']);
                        $qsip->execute();
                        while($qsipr = $qsip->fetch(PDO::FETCH_ASSOC)) {
                            if($_GET['sip'] == $qsipr['user_name']) {$sel = 'selected';} else {$sel = '';}
                            echo'<option value="'.$qsipr['user_name'].'" '.$sel.'>'.$qsipr['real_name'].'</option>';
                        }
                    ?>
                    </select>
                    <input type="hidden" name="page" value="analisasemua">
                    <input type="hidden" name="negeri" value="<?php echo $_GET['negeri'];?>">
                    <input type="hidden" name="daerah" value="<?php echo $_GET['daerah'];?>">
                </form>

                <form class="mtb2 text-left" <?php if(!isset($_GET['sip'])) {echo 'hidden';}?>>
                    <h5>PILIH PGB</h5>
                    <select name="pgb" class="form-control" onchange="this.form.submit()">
                        <option value="" disabled selected>Sila Pilih...</option>
                    <?php
                        $qpgb = $auth_user->runQuery("SELECT * FROM sip_pgb WHERE SIP = :sip");
                        $qpgb->bindParam(':sip',$_GET['sip']);
                        $qpgb->execute();
                        while($qpgbr = $qpgb->fetch(PDO::FETCH_ASSOC)) {
                            if($_GET['pgb'] == $qpgbr['NOKP']) {$sel = 'selected';} else {$sel = '';}
                            echo'<option value="'.$qpgbr['NOKP'].'" '.$sel.'>'.$qpgbr['NAMAGURU'].'</option>';
                        }
                    ?>
                    </select>
                    <input type="hidden" name="page" value="analisasemua">
                    <input type="hidden" name="negeri" value="<?php echo $_GET['negeri'];?>">
                    <input type="hidden" name="daerah" value="<?php echo $_GET['daerah'];?>">
                    <input type="hidden" name="sip" value="<?php echo $_GET['sip'];?>">
                </form>

            </div>
        </div>
        <div class="col-md-9 pad">
            <div class="mypanel pad text-center">
                <h3><strong>GRAF ANALISA</strong></h3>
                <form class="row">
                    <?php
                        if(isset($_GET['pgb'])) { echo'
                            <input type="hidden" name="page" value="analisasemua">
                            <input type="hidden" name="negeri" value="'.$_GET['negeri'].'">
                            <input type="hidden" name="daerah" value="'.$_GET['daerah'].'">
                            <input type="hidden" name="sip" value="'.$_GET['sip'].'">
                            <input type="hidden" name="pgb" value="'.$_GET['pgb'].'">';
                        } elseif(isset($_GET['sip'])) { echo'
                            <input type="hidden" name="page" value="analisasemua">
                            <input type="hidden" name="negeri" value="'.$_GET['negeri'].'">
                            <input type="hidden" name="daerah" value="'.$_GET['daerah'].'">
                            <input type="hidden" name="sip" value="'.$_GET['sip'].'">';
                        } elseif(isset($_GET['daerah'])) { echo'
                            <input type="hidden" name="page" value="analisasemua">
                            <input type="hidden" name="negeri" value="'.$_GET['negeri'].'">
                            <input type="hidden" name="daerah" value="'.$_GET['daerah'].'">';
                        } elseif(isset($_GET['negeri'])) { echo'
                            <input type="hidden" name="page" value="analisasemua">
                            <input type="hidden" name="negeri" value="'.$_GET['negeri'].'">';
                        } else { echo'
                            <input type="hidden" name="page" value="analisasemua">';
                        }
                    ?>
                    <div class="col-md-2 col-md-offset-4">
                        <button type="submit" name="std" value="1" class="btn btn-sm btn-block btn-primary <?php if(@$_GET['std']<>2){echo'active';}?>">
                            STANDARD 1
                        </button>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" name="std" value="2" class="btn btn-sm btn-block btn-primary <?php if(@$_GET['std']==2){echo'active';}?>">
                            STANDARD 2
                        </button>
                    </div>
                </form>
                <div class="mtb2">
                    <canvas id="graf"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
var data = <?php echo json_encode($data); ?>;
var label = <?php echo json_encode($label); ?>;
var std = <?php echo json_encode($stdk); ?>;

var max = Math.max(...data);
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

if(std == 1) {
    var color = "rgb(0, 230, 172,1)";
    var border = "rgb(0, 153, 115,1)";
} else {
    var color = "rgb(255, 102, 51,1)";
    var border = "rgb(204, 51, 0,1)";
}

new Chart(document.getElementById("graf"), {
    type: 'horizontalBar',
    data: {
      labels: label,
      datasets: [
        {
          label: "Bilangan Bimbingan",
          backgroundColor: color,
          borderColor: border,
          borderWidth: 2,
          data: data
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: false,
        text: ''
      },
      scales: {
          xAxes: [{
              ticks: {
                beginAtZero:true,
                stepSize: step,
                fontSize: 14
              },
              scaleLabel: {
                  display: true,
                  labelString: "Bilangan Bimbingan",
                  fontSize: 14
              }
          }],
          yAxes: [{
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

