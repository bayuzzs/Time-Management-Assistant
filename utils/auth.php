<?php
function loginUser($email, $password)
{
  global $mysqli;

  $stmt = $mysqli->prepare("SELECT id_user, name, email, password FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();
  $stmt->close();

  if ($user && password_verify($password, $user['password'])) {
    // Successful login
    $user = [
      'id_user' => $user['id_user'],
      'name' => $user['name'],
      'email' => $user['email'],
    ];
    return $user;
  } else {
    // Failed login
    return false;
  }
}

function loginFromCookie($userID)
{
  // Fetch user details from the database
  global $mysqli;
  $stmt = $mysqli->prepare("SELECT id_user, name, email FROM users WHERE id_user = ?");
  $stmt->bind_param("s", $userID);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();
  $stmt->close();

  // Invalid or missing cookies
  if (!$user) {
    return false;
  }

  // Return the user details
  return [
    'id_user' => $user['id_user'],
    'name' => $user['name'],
    'email' => $user['email'],
  ];
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
  $stmt = $mysqli->prepare($sql);
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

function validatePassword($oldPassword, $id_user)
{
  global $mysqli;
  $stmt = $mysqli->prepare("SELECT password FROM users WHERE id_user = ?");
  $stmt->bind_param("s", $id_user);
  $stmt->execute();
  $result = $stmt->get_result();
  $userPassword = $result->fetch_assoc();
  $stmt->close();

  return password_verify($oldPassword, $userPassword['password']);
}

function updatePassword($newPassword, $id_user)
{
  global $mysqli;
  $password = password_hash($newPassword, PASSWORD_BCRYPT, ["cost" => 12]);
  $stmt = $mysqli->prepare("UPDATE users SET password = ? WHERE id_user = ?");
  $stmt->bind_param("ss", $password, $id_user);
  $stmt->execute();
  $stmt->close();

  return true;
}
?>