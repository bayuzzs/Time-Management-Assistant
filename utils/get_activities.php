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
  // return an empty array
  echo json_encode([]);
  $stmt->close();
  die();
}
$data = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($data);
$stmt->close();
?>