<?php
$takeic = $auth_user->runQuery("SELECT NOKP FROM sip_pgb WHERE ID = :id");
$takeic->bindParam(':id',$_GET['idpgb']);
$takeic->execute();
$icpgb = $takeic->fetch(PDO::FETCH_ASSOC)['NOKP'];

$qraf = $auth_user->runQuery("SELECT BILKE,JENIS FROM sip_pgb_data WHERE NOKP = :nokp");
$qraf->bindParam(':nokp',$icpgb);

if(isset($_POST['compare'])) {
  

  if(isset($_POST['choose']) && isset($_POST['graf1']) && isset($_POST['graf2'])) {
    $std = $_POST['choose'];
    $graf1 = $_POST['graf1'];
    $graf2 = $_POST['graf2'];
    $std1array = array("S111","S112","S113","S114","S115","S116","S117","S121","S122","S131","S132","S133");
    $std2array = array("S211","S212","S221","S231","S241","S251","S252","S261","S271");
    $carta1 = array();
    $carta2 = array();
  
    if($std == 1) {
      foreach ($std1array as $std1) {
        $sqlradar = $auth_user->runQuery("SELECT $std1 AS std FROM sip_pgb_data WHERE NOKP = :nokp AND BILKE = :bilke AND YEAR(TARIKH) = YEAR(CURDATE())");
        $sqlradar->bindParam(':nokp',$icpgb);
        $sqlradar->bindParam(':bilke',$graf1);
        $sqlradar->execute();
        $carta1[] = $sqlradar->fetch(PDO::FETCH_ASSOC)['std'];
        
        $sqlradar->bindParam(':nokp',$icpgb);
        $sqlradar->bindParam(':bilke',$graf2);
        $sqlradar->execute();
        $carta2[] = $sqlradar->fetch(PDO::FETCH_ASSOC)['std'];
      }
      $stdsebenar = $std1array;
      $namagraf1 = 'Bimbingan '.$graf1;
      $namagraf2 = 'Bimbingan '.$graf2;
      $namastd = 'STANDARD 1';
    }
  
    if($std == 2) {
      foreach ($std2array as $std2) {
        $sqlradar = $auth_user->runQuery("SELECT $std2 AS std FROM sip_pgb_data WHERE NOKP = :nokp AND BILKE = :bilke AND YEAR(TARIKH) = YEAR(CURDATE())");
        $sqlradar->bindParam(':nokp',$icpgb);
        $sqlradar->bindParam(':bilke',$graf1);
        $sqlradar->execute();
        $carta1[] = $sqlradar->fetch(PDO::FETCH_ASSOC)['std'];
  
        $sqlradar->bindParam(':nokp',$icpgb);
        $sqlradar->bindParam(':bilke',$graf2);
        $sqlradar->execute();
        $carta2[] = $sqlradar->fetch(PDO::FETCH_ASSOC)['std'];
      }
      $stdsebenar = $std2array;
      $namagraf1 = 'Bimbingan '.$graf1;
      $namagraf2 = 'Bimbingan '.$graf2;
      $namastd = 'STANDARD 2';
    }
  
    //print_r($carta1);
    //print_r($carta2);

  } else {
    echo'
    <script>
        window.alert("Tidak cukup maklumat untuk menjana carta radar. Sila pastikan semua maklumat yang diperlukan terisi.");
    </script>';
  }
}
?>

<style>
    .centex {
        text-align:center;
    }
</style>
<h3 class="centex"><strong>CARTA RADAR RUMUSAN BIMBINGAN PGB</strong></h3>
<div class="row mtb">
    <div class="col-md-10 mtb">
        <canvas id="std1"></canvas>
    </div>
    <form class="col-md-2 mtb" action="index.php?idpgb=<?php echo $_GET['idpgb'];?>&page=pelaporan&inpage=carta" method="POST">
        <h6>PILIH STANDARD & 2 BIMBINGAN UNTUK PERBANDINGAN</h6>
        <?php
          if(isset($std)) {
            if($std == 1) {$radio1 = 'checked';$radio2 = '';} else {$radio1 = ''; $radio2 = 'checked';}
          }
        ?>
        <div><input type="radio" name="choose" value="1" <?php if(isset($std)){echo $radio1;}?>> Standard 1</div>
        <div><input type="radio" name="choose" value="2" <?php if(isset($std)){echo $radio2;}?>> Standard 2</div>
        <select name="graf1" class="form-control mtb">
          <option value="" disabled selected>Sila Pilih...</option>
          <?php
            $qraf->execute();
            while($rqraf = $qraf->fetch(PDO::FETCH_ASSOC)) {
              if($graf1 == $rqraf['BILKE']) {$sel1 = 'selected';} else {$sel1 = '';}
              echo '<option value="'.$rqraf['BILKE'].'" '.$sel1.'>B'.$rqraf['BILKE'].'('.$rqraf['JENIS'].')</option>';
            }
          ?>
        </select>
        <select name="graf2" class="form-control mtb">
          <option value="" disabled selected>Sila Pilih...</option>
            <?php
              $qraf->execute();
              while($rqraf2 = $qraf->fetch(PDO::FETCH_ASSOC)) {
                if($graf2 == $rqraf2['BILKE']) {$sel2 = 'selected';} else {$sel2 = '';}
                echo '<option value="'.$rqraf2['BILKE'].'" '.$sel2.'>B'.$rqraf2['BILKE'].'('.$rqraf2['JENIS'].')</option>';
              }
            ?>
        </select>
        <button type="submit" name="compare" class="btn btn-block btn-primary">PILIH</button>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
var labelc = <?php echo json_encode($stdsebenar); ?>;
var graf1 = <?php echo json_encode($carta1); ?>;
var graf2 = <?php echo json_encode($carta2); ?>;
var cname1 = <?php echo json_encode($namagraf1);?>;
var cname2 = <?php echo json_encode($namagraf2);?>;
var namastd = <?php echo json_encode($namastd);?>;

for (var i = 0; i < graf1.length; i++) {
  if (graf1[i] == 99) {
    graf1[i] = 0;
  }
}

for (var i = 0; i < graf2.length; i++) {
  if (graf2[i] == 99) {
    graf2[i] = 0;
  }
}
    
new Chart(document.getElementById("std1"), {
    type: 'radar',
    data: {
      labels: labelc,
      datasets: [
        {
          label: cname1,
          fill: false,
          backgroundColor: "rgba(95,245,62,0.2)",
          borderColor: "rgba(14,221,18,1)",
          pointBorderColor: "rgba(14,221,18,1)",
          pointBackgroundColor: "rgba(179,181,198,1)",
          data: graf1,
          pointBorderWidth: 12
        }, {
          label: cname2,
          fill: false,
          backgroundColor: "rgba(255,99,132,0.2)",
          borderColor: "rgba(255,99,132,1)",
          pointBorderColor: "rgba(255,99,132,1)",
          pointBackgroundColor: "rgba(255,99,132,1)",
          data: graf2,
          pointBorderWidth: 12
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: namastd
      },
      scale: {
        ticks: {
          beginAtZero: true,
          max: 4,
          stepSize: 1
        }
      },
      plugins: {
        datalabels: {
          color: 'white'
        }
      }
    }
});
</script>