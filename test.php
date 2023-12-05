<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chart.js Example</title>
  <!-- Include Chart.js library -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <!-- Chart untuk 7 hari dalam 1 minggu -->
  <canvas id="chartWeek" width="800" height="400"></canvas>

  <!-- Chart untuk 4 minggu dalam 1 bulan -->
  <canvas id="chartMonth" width="800" height="400"></canvas>

  <!-- Chart untuk 12 bulan dalam 1 tahun -->
  <canvas id="chartYear" width="800" height="400"></canvas>

  <script>
    // Fungsi untuk menghasilkan data acak
    function generateRandomData(length, maxValue) {
      return Array.from({ length }, () => Math.floor(Math.random() * maxValue) + 1);
    }

    // Data untuk 7 hari dalam 1 minggu
    var dataWeek = {
      labels: ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"],
      datasets: [
        {
          label: 'Minggu Ini',
          data: generateRandomData(7, 30),
          backgroundColor: 'rgba(75, 192, 192, 0.5)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        }
      ]
    };

    // Data untuk 4 minggu dalam 1 bulan
    var dataMonth = {
      labels: ["Minggu 1", "Minggu 2", "Minggu 3", "Minggu 4"],
      datasets: [
        {
          label: 'Bulan Ini',
          data: generateRandomData(4, 100),
          backgroundColor: 'rgba(255, 99, 132, 0.5)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
        }
      ]
    };

    // Data untuk 12 bulan dalam 1 tahun
    var dataYear = {
      labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
      datasets: [
        {
          label: 'Tahun Ini',
          data: generateRandomData(12, 200),
          backgroundColor: 'rgba(54, 162, 235, 0.5)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }
      ]
    };

    // Konfigurasi chart
    var options = {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    };

    // Inisialisasi chart untuk 7 hari dalam 1 minggu
    var ctxWeek = document.getElementById('chartWeek').getContext('2d');
    var chartWeek = new Chart(ctxWeek, {
      type: 'bar',
      data: dataWeek,
      options: options
    });

    // Inisialisasi chart untuk 4 minggu dalam 1 bulan
    var ctxMonth = document.getElementById('chartMonth').getContext('2d');
    var chartMonth = new Chart(ctxMonth, {
      type: 'bar',
      data: dataMonth,
      options: options
    });

    // Inisialisasi chart untuk 12 bulan dalam 1 tahun
    var ctxYear = document.getElementById('chartYear').getContext('2d');
    var chartYear = new Chart(ctxYear, {
      type: 'bar',
      data: dataYear,
      options: options
    });
  </script>
</body>

</html>