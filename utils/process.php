<?php

// Establish connection with MySQLi
$servername = "localhost";
$username = "root";
$password = "";
$database = "tma";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Connection successful
echo "Connected to database successfully";

?>