<?php
$email = 'contoh@email.com'; // Ganti dengan email pengguna
$salt = 'r4nd0mS@lt'; // Ganti dengan salt yang sesuai dengan kebutuhan Anda

$userID = hash('sha256', $email . $salt);

echo uniqid($userID) . '<br>';
echo uniqid($userID) . '<br>';
echo uniqid($userID, true) . '<br>';
?>