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

$query = "DELETE FROM activities WHERE id_activity = ? AND id_user = ?";
$stmt = $mysqli->prepare($query);

$stmt->bind_param("ss", $id_activity, $id_user);

if ($stmt->execute()) {
  // Deletion successful
  $_SESSION['message'] = "Activity deleted successfully!";
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