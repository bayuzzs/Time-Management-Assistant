<?php 
if (isset($_POST)) {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  
  echo "Name: " . $name . "<br>";
  echo "Email: " . $email . "<br>";
  echo "Password: " . $password . "<br>";
}
?>