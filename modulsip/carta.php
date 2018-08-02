<style>
    .centex {
        text-align:center;
    }
</style>
<h3 class="centex"><strong>CARTA RADAR RUMUSAN BIMBINGAN PGB</strong></h3>
<div class="row mtb">
    <div class="col-md-12 mtb">
        <h4 class="centex"><strong>STANDARD 1</strong></h4>
        <canvas id="std1"></canvas>
    </div>
    <div class="col-md-12 mtb">
        <h4 class="centex"><strong>STANDARD 2</strong></h4>
        <canvas id="std2"></canvas>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
new Chart(document.getElementById("std1"), {
    type: 'radar',
    data: {
      labels: ["1.1.1", "1.1.2", "1.1.3", "1.1.4", "1.1.5", "1.1.6", "1.1.7", "1.2.1", "1.2.2", "1.3.1", "1.3.2", "1.1.3"],
      datasets: [
        {
          label: "TOV",
          fill: false,
          backgroundColor: "rgba(179,181,198,0.2)",
          borderColor: "rgba(179,181,198,1)",
          pointBorderColor: "#fff",
          pointBackgroundColor: "rgba(179,181,198,1)",
          data: [2.77,1.23,3,2,1.22,2.1,4,4,3.3,2,2.4,4]
        }, {
          label: "AKHIR",
          fill: false,
          backgroundColor: "rgba(255,99,132,0.2)",
          borderColor: "rgba(255,99,132,1)",
          pointBorderColor: "#fff",
          pointBackgroundColor: "rgba(255,99,132,1)",
          pointBorderColor: "#fff",
          data: [2.48,4,4,4,3.45,3.9,3.5,2.9,4,4,3.2,3]
        }
      ]
    },
    options: {
      title: {
        display: false,
        text: 'PERBANDINGAN TOV DAN PENILAIAN AKHIR'
      }
    }
});

new Chart(document.getElementById("std2"), {
    type: 'radar',
    data: {
      labels: ["1.1.1", "1.1.2", "1.1.3", "1.1.4", "1.1.5", "1.1.6", "1.1.7", "1.2.1", "1.2.2", "1.3.1", "1.3.2", "1.1.3"],
      datasets: [
        {
          label: "TOV",
          fill: false,
          backgroundColor: "rgba(179,181,198,0.2)",
          borderColor: "rgba(179,181,198,1)",
          pointBorderColor: "#fff",
          pointBackgroundColor: "rgba(179,181,198,1)",
          data: [2.77,1.23,3,2,1.22,2.1,4,4,3.3,2,2.4,4]
        }, {
          label: "AKHIR",
          fill: false,
          backgroundColor: "rgba(255,99,132,0.2)",
          borderColor: "rgba(255,99,132,1)",
          pointBorderColor: "#fff",
          pointBackgroundColor: "rgba(255,99,132,1)",
          pointBorderColor: "#fff",
          data: [2.48,4,4,4,3.45,3.9,3.5,2.9,4,4,3.2,3]
        }
      ]
    },
    options: {
      title: {
        display: false,
        text: 'PERBANDINGAN TOV DAN PENILAIAN AKHIR'
      }
    }
});
</script>