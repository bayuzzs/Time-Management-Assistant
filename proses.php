<?php 
if (isset($_POST)) {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  
  if ($name == 'bayu') {
    echo "selamat datang, " . $name . "<br>";
  } else {
    echo "selamat datang, " . $name . "<br>";
    echo "Kamu belum terdaftar<br>";
  }
  echo "Email: " . $email . "<br>";
  echo "Password: " . $password . "<br>";
}
?>