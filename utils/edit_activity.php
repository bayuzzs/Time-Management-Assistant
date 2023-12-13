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


$user_id = $_COOKIE['auth_user'];
// Destructuring the associative array
[
  'id_activity' => $id_activity,
  'title' => $title,
  'description' => $description,
  'date' => $date,
  'time' => $time,
  'priority' => $priority,
  'repetition' => $repetition
] = $_POST;


// if doesn't submit all field
if (empty($title) || empty($description) || empty($date) || empty($time) || empty($priority) || empty($repetition)) {
  $_SESSION['message'] = "All fields are required!";
  $_SESSION['type'] = "error";
  exit(header("Location: " . $_SERVER['HTTP_REFERER']));
}

// convert date and time and check if it's in the future
$datetime = strtotime($date . ' ' . $time);
// kenapa dibalik?, karna klo date null itu = 00000 jadi false klo ga dibalik
if (!($datetime > time())) {
  $_SESSION['message'] = "Activity date and time must be in the future!";
  $_SESSION['type'] = "error";
  exit(header("Location: " . $_SERVER['HTTP_REFERER']));
}
// If datetime more than 10 Year
if ($datetime > time() + (3600 * 24 * 30 * 12 * 10)) {
  $_SESSION['message'] = "Cannot add activities more than 10 years!";
  $_SESSION['type'] = "error";
  exit(header("Location: " . $_SERVER['HTTP_REFERER']));
}

$query = "UPDATE activities SET title = ?, description = ?, date = ?, time = ?, repetition = ?, priority = ? WHERE id_activity = ? AND id_user = ?";
$stmt = $mysqli->prepare($query);

$stmt->bind_param("ssssssss", $title, $description, $date, $time, $repetition, $priority, $id_activity, $user_id);

if ($stmt->execute()) {
  // Edition successful
  $_SESSION['message'] = "Activity edited successfully!";
  $_SESSION['type'] = "success";
  $stmt->close();
  exit(header("Location: " . $_SERVER['HTTP_REFERER']));
} else {
  // Edition failed
  $_SESSION['message'] = "Edition failed!";
  $_SESSION['type'] = "error";
  $stmt->close();
  exit(header("Location: " . $_SERVER['HTTP_REFERER']));
}
?>