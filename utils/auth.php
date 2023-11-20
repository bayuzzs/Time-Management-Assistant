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
    return ['user' => $user['id_user'], 'email' => $user['email']];
  } else {
    // Failed login
    return false;
  }
}

function setAuthCookie($userID, $email)
{
  $salt = "garam_laut";
  $token = hash('sha256', $email . $salt);

  setcookie("auth_user", $userID, time() + (3600 * 24 * 30), "/");
  setcookie("auth_token", $token, time() + (3600 * 24 * 30), "/");
}

function checkAuthCookie($authUser, $authToken)
{
  // get user
  global $mysqli;
  $sql = "SELECT email FROM `users` WHERE `id_user` = ?";
  if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("s", $authUser);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
  }

  // if user not found
  if (!$user) {
    return false;
  }

  // user found, check token
  $salt = "garam_laut";
  $token = hash('sha256', $user['email'] . $salt);

  // if token doesn't match
  if (!hash_equals($token, $authToken)) {
    return false;
  }

  return true;
}

function unsetAuthCookie()
{
  setcookie("auth_user", "", -1, "/");
  setcookie("auth_token", "", -1, "/");
}
?>