<?php
require_once "mysqli.php";
require_once "auth.php";
session_start();

// ambil data dari form dan bersihkan
$email = $mysqli->real_escape_string($_POST["email"]);
$password = $mysqli->real_escape_string($_POST["password"]);

// login with loginUser function
$user = loginUser($email, $password);

// if email or password doesn't match, id will be false
if (!$user) {
  $_SESSION["message"] = "Invalid email or password!";
  $_SESSION["type"] = "error";
  exit(header("Location: /sign-in.php"));
}

// all condition passed, execute this code
setAuthCookie($user["id_user"], $user["email"]);
$_SESSION["message"] = "Login Successfully!";
$_SESSION["type"] = "success";
exit(header("Location: /dashboard.php"));

// INI KODE LAMA JAGA-JAGA AJA! 
// // fetch email, password field from database according to use input
// $sql = "SELECT email, password FROM `users` WHERE `email` = '$email'";
// $result = $mysqli->query($sql);

// if email not found
// if ($result->num_rows == 0) {
//   $_SESSION["error"] = "Invalid email or password";
//   header("Location: /sign-in.php");
//   exit();
// }

// fetch data from database to associative array
// $row = $result->fetch_assoc();

// if password incorrect
// if (!password_verify($password, $row["password"])) {
//   $_SESSION["error"] = "Invalid email or password";
//   header("Location: /sign-in.php");
//   exit();
// }

// all condition fulfilled, execute this code
// $_SESSION["success"] = "Login Successfully";
// header("Location: /dashboard.php");
?>