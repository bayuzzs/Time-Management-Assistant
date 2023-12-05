<?php
require_once 'mysqli.php';
require_once 'auth.php';
session_start();

// if doesn't have cookie
if (!isset($_COOKIE["auth_user"], $_COOKIE["auth_token"])) {
  $_SESSION['message'] = "You need to login first!";
  $_SESSION['type'] = "error";
  exit(header("Location: /sign-in.php"));
}

// if user cookie invalid
if (!checkAuthCookie($_COOKIE["auth_user"], $_COOKIE["auth_token"])) {
  $_SESSION['message'] = "You need to login first!";
  $_SESSION['type'] = "error";
  exit(header("Location: /sign-in.php"));
}

$id_activity = $_POST['id_activity'];
$id_user = $_COOKIE["auth_user"];
$title = $_POST['title'];
$description = $_POST['description'];
$date = $_POST['date'];
$repetition = $_POST['repetition'];

switch ($repetition) {
  case 'none':
    $stmt = $mysqli->prepare("DELETE FROM activities WHERE id_activity = ? AND id_user = ?");
    $stmt->bind_param("ss", $id_activity, $id_user);
    $stmt->execute();
    break;
  case 'daily':
    $stmt = $mysqli->prepare("UPDATE activities SET date = DATE_ADD(date, INTERVAL 1 DAY) WHERE id_activity = ? AND id_user = ?");
    $stmt->bind_param("ss", $id_activity, $id_user);
    $stmt->execute();
    break;
  case 'weekly':
    $stmt = $mysqli->prepare("UPDATE activities SET date = DATE_ADD(date, INTERVAL 7 DAY) WHERE id_activity = ? AND id_user = ?");
    $stmt->bind_param("ss", $id_activity, $id_user);
    $stmt->execute();
    break;
  case 'monthly':
    $stmt = $mysqli->prepare("UPDATE activities SET date = DATE_ADD(date, INTERVAL 1 MONTH) WHERE id_activity = ? AND id_user = ?");
    $stmt->bind_param("ss", $id_activity, $id_user);
    $stmt->execute();
    break;
}

$query = "INSERT INTO history_activities (id_user, title, description, date) VALUES (?, ?, ?, ?)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ssss", $id_user, $title, $description, $date);

if ($stmt->execute()) {
  // Deletion successful
  $_SESSION['message'] = "Activity completed successfully!";
  $_SESSION['type'] = "success";
  $stmt->close();
  exit(header("Location: " . $_SERVER['HTTP_REFERER']));
} else {
  // Deletion failed
  $_SESSION['message'] = "Action failed!";
  $_SESSION['type'] = "error";
  $stmt->close();
  exit(header("Location: " . $_SERVER['HTTP_REFERER']));
}
?>