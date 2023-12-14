<?php
require_once 'utils/mysqli.php';
require_once 'utils/auth.php';
require_once 'utils/functions.php';
session_start();

// check user and token from cookie
if (!isset($_COOKIE["auth_user"]) || !isset($_COOKIE["auth_token"])) {
  // if doesn't have cookie
  $_SESSION['message'] = "You need to login first!";
  $_SESSION['type'] = "error";
  header("Location: /sign-in.php");
  exit();
}

// if user cookie isn't valid
if (!checkAuthCookie($_COOKIE["auth_user"], $_COOKIE["auth_token"])) {
  $_SESSION['message'] = "You need to login first!";
  $_SESSION['type'] = "error";
  header("Location: /sign-in.php");
  exit();
}

// get user data
$user = loginFromCookie($_COOKIE["auth_user"]);
// destructuring from user data
['id_user' => $id_user, 'name' => $name, 'email' => $email] = $user;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $oldPassword = $_POST['old_password'];
  $newPassword = $_POST['new_password'];
  $confirmPassword = $_POST['confirm_password'];

  // Validate old password
  if (!validatePassword($oldPassword, $id_user)) {
    $_SESSION['message'] = "Invalid old password!";
    $_SESSION['type'] = "error";
    header("Location: /settings.php");
    exit();
  }

  // Validate new password
  if ($newPassword !== $confirmPassword) {
    $_SESSION['message'] = "New passwords doesn't match!";
    $_SESSION['type'] = "error";
    header("Location: /settings.php");
    exit();
  }

  // Update password
  if (updatePassword($newPassword, $id_user)) {
    $_SESSION['message'] = "Password updated successfully!";
    $_SESSION['type'] = "success";
    header("Location: /dashboard.php");
    exit();
  } else {
    $_SESSION['message'] = "Failed to update password!";
    $_SESSION['type'] = "error";
    header("Location: /settings.php");
    exit();
  }
}

// check session to show an alert
if (isset($_SESSION['message'], $_SESSION['type'])) {
  $message = $_SESSION['message'];
  $type = $_SESSION['type'];
  unset($_SESSION['message']);
  unset($_SESSION['type']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200;300;400;500;600;700&display=swap"
    rel="stylesheet">

  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/sidebar.css">
  <link rel="stylesheet" href="assets/css/settings.css">
</head>

<body>
  <?php if (isset($message, $type)): ?>
    <div class="alert alert-<?= $type ?>">
      <img src="assets/images/<?= $type ?>.svg">
      <p class="alert__message">
        <?= $message ?>
      </p>
    </div>
  <?php endif; ?>

  <!-- Sidebar start -->
  <?php
  $active = 'settings';
  require_once 'templates/sidebar.php';
  ?>
  <!-- Sidebar end -->
  <!-- Main start -->
  <main>
    <h1 class="title">Settings</h1>
    <div class="settings">
      <h2 class="settings__title">Change Password</h2>
      <form class="settings__form" action="settings.php" method="POST">
        <label>
          Old Password
          <input type="password" name="old_password" required>
        </label>
        <label>
          New Password
          <input type="password" name="new_password" required>
        </label>
        <label>
          Confirm Password
          <input type="password" name="confirm_password" required>
        </label>
        <input class="settings__form-submit" type="submit" value="Change Password">
      </form>
    </div>
  </main>
  <!-- Main end -->

  <script src="./assets/js/settings.js"></script>
</body>

</html>