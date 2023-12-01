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
if (!isset($_GET['title'], $_GET['filter'])) {
  echo 'Empty';
  die();
}
$id_user = $_COOKIE["auth_user"];
$title = $_GET['title'];
$filter = $_GET['filter'];

// Prepare the SQL query
switch ($filter) {
  case 'date':
    $stmt = $mysqli->prepare("SELECT * FROM activities WHERE id_user = ? AND title LIKE CONCAT('%', ?, '%') ORDER BY date, time");
    break;
  case 'important':
    $stmt = $mysqli->prepare("SELECT * FROM activities WHERE id_user = ? AND title LIKE CONCAT('%', ?, '%') AND priority = 'important' ORDER BY date, time");
    break;
  case 'overdue':
    $stmt = $mysqli->prepare("SELECT * FROM activities WHERE id_user = ? AND title LIKE CONCAT('%', ?, '%') AND date < CURDATE() ORDER BY date, time");
    break;
  case 'daily':
    $stmt = $mysqli->prepare("SELECT * FROM activities WHERE id_user = ? AND title LIKE CONCAT('%', ?, '%') AND repetition = 'daily' ORDER BY date, time");
    break;
  case 'weekly':
    $stmt = $mysqli->prepare("SELECT * FROM activities WHERE id_user = ? AND title LIKE CONCAT('%', ?, '%') AND repetition = 'weekly' ORDER BY date, time");
    break;
  case 'monthly':
    $stmt = $mysqli->prepare("SELECT * FROM activities WHERE id_user = ? AND title LIKE CONCAT('%', ?, '%') AND repetition = 'monthly' ORDER BY date, time");
    break;
  default:
    // Handle any other case or provide a default behavior
    echo 'empty';
    die();
}


// Execute the query
$stmt->bind_param("ss", $id_user, $title);
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