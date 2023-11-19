<?php
require_once "process.php";
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

var_dump($name, $email, $password);
// // Check if the email already exists
// $query = "SELECT * FROM users WHERE email = '$email'";
// $result = mysqli_query($conn, $query);
// if (mysqli_num_rows($result) > 0) {
//   die("Email already exists");
// }
// // Insert the data into the database
// $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
// $result = mysqli_query($conn, $query);
// if (!$result) {
//   die("Error inserting data: " . mysqli_error($conn));
// }

?>