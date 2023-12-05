<?php
require_once 'mysqli.php';
require_once 'auth.php';
session_start();

// if doesn't have cookie
if (!isset($_COOKIE["auth_user"], $_COOKIE["auth_token"])) {
  echo json_encode(['error' => 'no cookie']);
  die();
}

$userId = $_COOKIE["auth_user"];
// if user cookie invalid
if (!checkAuthCookie($_COOKIE["auth_user"], $_COOKIE["auth_token"])) {
  echo json_encode(['error' => 'Invalid cookie']);
  die();
}

$filter = $_GET['filter'];
$userId = $_COOKIE["auth_user"];
switch ($filter) {
  case 'week':
    $query = "SELECT DAYNAME(date) as day, count(*) as total FROM history_activities WHERE id_user = ? AND YEARWEEK(date) = YEARWEEK(CURDATE()) GROUP BY day";
    $label = "Activities in Day";
    break;
  case 'month':
    $query = "SELECT WEEKOFYEAR(date) - WEEKOFYEAR(date - INTERVAL DAY(date) - 1 DAY) + 1 AS week_number, count(*) AS total FROM history_activities WHERE id_user = ? AND YEAR(date) = YEAR(CURDATE()) AND MONTH(date) = MONTH(CURDATE()) GROUP BY WEEKOFYEAR(date)";
    $label = "Activities in Week";
    break;
  case 'year':
    $query = "SELECT MONTHNAME(date) as month, count(*) as total FROM history_activities WHERE id_user = ? AND YEAR(date) = YEAR(CURDATE()) GROUP BY MONTH(date)";
    $label = "Activities in Month";
    break;
}

// Prepare the statement
$stmt = $mysqli->prepare($query);
if (!$stmt) {
  echo json_encode(['error' => 'Failed to prepare statement']);
  die();
}

// Bind the parameter
$stmt->bind_param("s", $userId);

// Execute the query
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$data = [
  "labels" => [],
  "datasets" => [
    [
      "label" => $label,
      "data" => [],
      "backgroundColor" => "#acdaff",
      "borderColor" => "#0091ff",
      "borderWidth" => 1
    ]
  ]
];
// initial max value
$max = 0;
foreach ($result as $row) {
  $key = array_keys($row);
  array_push($data["labels"], $row[$key[0]]);
  array_push($data["datasets"][0]["data"], $row[$key[1]]);
  $row["total"] > $max ? $max = $row["total"] : null;
}
$options = [
  "scales" => [
    "y" => [
      "beginAtZero" => true,
      "max" => round($max + 10, -1, PHP_ROUND_HALF_DOWN),
      "stepSize" => round($max + 10, -1, PHP_ROUND_HALF_DOWN) / 2
    ]
  ],
  "responsive" => true
];

$result = [
  "data" => $data,
  "options" => $options
];
echo json_encode($result);
?>