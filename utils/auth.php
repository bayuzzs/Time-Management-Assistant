<?php
require_once 'mysqli.php';

function loginUser($email, $password)
{
  global $mysqli;

  $stmt = $mysqli->prepare("SELECT id_user, email, password FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user && password_verify($password, $user['password'])) {
    // Successful login
    return $user['id_user'];
  } else {
    // Failed login
    return false;
  }
}

function setAuthCookie($userID)
{
  setcookie("auth_user", $userID, time() + (3600 * 24 * 30), "/");
  $token = $userID;
  $salt = "garam_laut";

  $token .= $salt;
  $hashedToken = hash('sha2156', $token);

  setcookie("auth_token", $hashedToken, time() + (3600 * 24 * 30), "/");

  // Save the token in the database for future verification
  global $mysqli;
  $stmt = $mysqli->prepare("UPDATE users SET auth_token = ? WHERE id = ?");
  $stmt->bind_param("si", $hashedToken, $userID);
  $stmt->execute();
}
?>