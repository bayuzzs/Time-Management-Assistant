<?php
// Set the timezone to Asia/Jakarta
date_default_timezone_set('Asia/Jakarta');
// Ambil waktu server
$serverTime = new DateTime('now', new DateTimeZone('UTC')); // Menggunakan zona waktu UTC sebagai referensi

// Format waktu server sebagai string ISO dan tambahkan zona waktu
$serverTimeISO = $serverTime->format("Y-m-d\TH:i:sP");

// Kirim waktu server dan zona waktu ke browser
$response = [
  'serverTime' => $serverTimeISO,
  'serverTimeZone' => 'UTC', // Atau zona waktu server yang sesuai
];

echo json_encode($response);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <script>
    console.log(new Date().getTimezoneOffset());
  </script>
</body>

</html>