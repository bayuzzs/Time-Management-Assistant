<?php
require_once 'mysqli.php';
require_once 'auth.php';
session_start();

// if doesn't have cookie
if (!isset($_COOKIE["auth_user"], $_COOKIE["auth_token"])) {
  echo json_encode(['error' => 'no cookie']);
  die();
}

// if user cookie invalid
if (!checkAuthCookie($_COOKIE["auth_user"], $_COOKIE["auth_token"])) {
  echo json_encode(['error' => 'Invalid cookie']);
  die();
}

$query = "SELECT * FROM activities WHERE id_user = ?";
$userId = $_COOKIE["auth_user"];

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
$result = $stmt->get_result();
// no activity
if (!$result->num_rows) {
  echo json_encode(['data' => ['activities' => []]]);
  $stmt->close();
  die();
}

// Get the result
$total = 0;
$priority = 0;
$overdue = 0;
$activities = [];
while ($row = $result->fetch_assoc()) {
  $total++;
  if ($row['priority'] == 'important') {
    $priority++;
  }
  if (strtotime($row['date'] . ' ' . $row['time']) < time()) {
    $overdue++;
  }
  array_push($activities, $row);
}

$data = [
  'total' => $total,
  'priority' => $priority,
  'overdue' => $overdue,
  'activities' => $activities,
];

echo json_encode($data);
$stmt->close();
?>