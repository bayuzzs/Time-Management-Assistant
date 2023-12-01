<?php
date_default_timezone_set('Asia/Jakarta');
// Establish connection with MySQLi
$servername = "localhost";
$username = "root";
$password = "";
$database = "tma";

$mysqli = new mysqli($servername, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}
$id_user = '655ea72c62a';
$stmt = $mysqli->prepare("SELECT * FROM activities WHERE id_user = ? ORDER BY date, time");
$stmt->bind_param("s", $id_user);
$stmt->execute();
$activities = $stmt->get_result();
$activities = $activities->fetch_all(MYSQLI_ASSOC);
$stmt->close();
var_dump($activities);
// $totalActivities = 0;
// $importantActivities = 0;
// $overdueActivities = 0;
// if (count($activities)) {
//   foreach ($activities as $activity) {
//     $totalActivities++;
//     if ($activity['priority'] == 'important') {
//       $importantActivities++;
//     }
//     if (strtotime($activity['date'] . ' ' . $activity['time']) < time()) {
//       $overdueActivities++;
//     }
//   }
// }
?>