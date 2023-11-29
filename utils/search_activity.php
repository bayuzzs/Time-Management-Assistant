<?php
require_once 'mysqli.php';
require_once 'auth.php';

// if doesn't have cookie
if (!isset($_COOKIE["auth_user"], $_COOKIE["auth_token"])) {
  echo 'You need to login first!';
  die();
}

// if user cookie invalid
if (!checkAuthCookie($_COOKIE["auth_user"], $_COOKIE["auth_token"])) {
  echo 'You need to login first!';
  die();
}

// Check if the 'title' parameter is set in the $_GET array
if (!isset($_GET['title'])) {
  echo 'Empty';
  die();
}
$id_user = $_COOKIE["auth_user"];
$title = $_GET['title'];

// Prepare the SQL query
$query = "SELECT * FROM activities WHERE id_user = ? AND title LIKE CONCAT('%', ?, '%')";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ss", $id_user, $title);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$mysqli->close();

// Check if any rows were returned
if (!$result->num_rows) {
  echo 'empty';
  die();
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