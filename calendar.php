<?php
require_once 'utils/mysqli.php';
require_once 'utils/auth.php';
require_once 'utils/functions.php';
session_start();

// check user and token from cookie
if (!isset($_COOKIE["auth_user"]) || !isset($_COOKIE["auth_token"])) {
  // if user not login yet
  header("Location: /sign-in.php");
  exit();
}

// if user not login yet
if (!checkAuthCookie($_COOKIE["auth_user"], $_COOKIE["auth_token"])) {
  header("Location: /sign-in.php");
  exit();
}

// get user data
$user = loginFromCookie($_COOKIE["auth_user"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendar</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200;400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/sidebar.css">
  <link rel="stylesheet" href="assets/css/calendar.css">

  <script src="assets/js/calender.global.min.js"></script>
</head>

<body>
  <?php
  // destructuring from user data
  ['id_user' => $id_user, 'name' => $name, 'email' => $email] = $user;
  renderSidebar($id_user, $name, $email, 'calendar');
  ?>
  <!-- Main start -->
  <main>
    <div id="calendar">
    </div>
  </main>
  <!-- Main end -->
  <style>
    #calendar {
      max-height: 95vh;
    }
  </style>
  <script type="javascript" src="./assets/js/dashboard.js"></script>
  <script src="./assets/js/calendar.js"></script>

</body>

</html>