<?php
session_start();
// Clear the authentication cookies
setcookie("auth_user", "", time() - 3600, "/");
setcookie("auth_token", "", time() - 3600, "/");

session_unset();
// Redirect the user to the login page
$_SESSION['message'] = "You have been logged out.";
$_SESSION['type'] = "success";
header("Location: /sign-in.php");
exit();
?>