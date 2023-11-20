<?php
// Clear the authentication cookies
setcookie("auth_user", "", time() - 3600, "/");
setcookie("auth_token", "", time() - 3600, "/");

// Redirect the user to the login page
header("Location: /sign-in.php");
exit;
?>