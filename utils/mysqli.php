<?php
date_default_timezone_set('Asia/Jakarta');
// Establish connection with MySQLi
$servername = "localhost";
$username = "root";
$password = "";
$database = "tma";

$mysqli = new mysqli($servername, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

?>