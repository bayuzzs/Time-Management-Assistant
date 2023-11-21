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
  exit(header("Location: /dashboard.php"));
}

// convert date and time and check if it's in the future
$datetime = strtotime($date . ' ' . $time);
// kenapa dibalik?, karna klo date null jadi 00000 jadi false klo ga dibalik
if (!($datetime > time())) {
  $_SESSION['message'] = "Can only add upcoming activities!";
  $_SESSION['type'] = "error";
  exit(header("Location: /dashboard.php"));
}

$query = "INSERT INTO activities (id_user, title, description, date, time, repetition, priority) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($query);

$stmt->bind_param("sssssss", $user_id, $title, $description, $date, $time, $repetition, $priority);

if ($stmt->execute()) {
  // Insertion successful
  $_SESSION['message'] = "Activity added successfully!";
  $_SESSION['type'] = "success";
  $stmt->close();
  exit(header("Location: /dashboard.php"));
} else {
  // Insertion failed
  $_SESSION['message'] = "Insertion failed!";
  $_SESSION['type'] = "error";
  $stmt->close();
  exit(header("Location: /dashboard.php"));
}
?>