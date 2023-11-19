<?php
require_once "process.php";
session_start();
$name = $mysqli->real_escape_string($_POST["name"]);
$email = $mysqli->real_escape_string($_POST["email"]);
$password = $mysqli->real_escape_string($_POST["password"]);

// kalau email pengguna sudah ada dalam database
if ($mysqli->query("SELECT * FROM `users` WHERE `email` = '$email'")->num_rows > 0) {
  $_SESSION["error"] = "Email already exists";
  header("Location: /sign-in.php");
  exit();
}
$sql = "INSERT INTO `users` (`name`, `email`, `password`) VALUES (?, ?, ?)";

if ($stmt = $mysqli->prepare($sql)) {
  $stmt->bind_param("sss", $name, $email, $password);
  $stmt->execute();
  $mysqli->close();
}
$_SESSION["success"] = "Account created successfully";
header("Location: /sign-in.php");
?>