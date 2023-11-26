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

$query = "SELECT * FROM activities WHERE id_activity = ? AND id_user = ?";
$activityId = $_GET['id'];
$userId = $_COOKIE["auth_user"];

// Prepare the statement
$stmt = $mysqli->prepare($query);
if (!$stmt) {
  echo json_encode(['error' => 'Failed to prepare statement']);
  die();
}

// Bind the parameter
$stmt->bind_param("ss", $activityId, $userId);

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result()->fetch_assoc();
// Output the JSON data
echo json_encode($result);
?>