<?php
require_once 'mysqli.php';
require_once 'auth.php';

// if doesn't have cookie
if (!isset($_COOKIE["auth_user"], $_COOKIE["auth_token"])) {
  echo json_encode([]);
  die();
}

// if user cookie invalid
if (!checkAuthCookie($_COOKIE["auth_user"], $_COOKIE["auth_token"])) {
  echo json_encode([]);
  die();
}

// Check if the 'title' parameter is set in the $_GET array
if (!isset($_GET['title'])) {
  echo json_encode([]);
  die();
}
// Sanitize the input value to prevent SQL injection
$title = $mysqli->real_escape_string($_GET['title']);

// Prepare the SQL query
$query = "SELECT * FROM activities WHERE title LIKE '%$title%'";

// Execute the query
$result = $mysqli->query($query);
$mysqli->close();

// Check if any rows were returned
if (!$result->num_rows) {
  echo json_encode([]);
}

// Loop through the rows and display the activity details
while ($row = $result->fetch_assoc()) {
  [
    'id_activity' => $id_activity,
    'title' => $title,
    'description' => $description,
    'date' => $date,
    'time' => $time,
    'priority' => $priority,
    'repetition' => $repetition
  ] = $row;
  require '../templates/activity_card.php';
}
?>