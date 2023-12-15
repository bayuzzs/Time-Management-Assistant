<?php
require_once 'utils/mysqli.php';
require_once 'utils/auth.php';
session_start();

// check user and token from cookie
if (isset($_COOKIE["auth_user"]) && isset($_COOKIE["auth_token"])) {
  // if user already login
  if (checkAuthCookie($_COOKIE["auth_user"], $_COOKIE["auth_token"])) {
    $_SESSION['message'] = "You are already logged in.";
    $_SESSION['type'] = "error";
    exit(header("Location: /dashboard.php"));
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
  <title>Sign-in</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200;400;500;700&display=swap" rel="stylesheet">

  <!-- style -->
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/sign-in.css">
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
  <main>
    <div class="container">
      <!-- illustration start -->
      <aside id="illustration">
        <img src="assets/images/index/login-left.svg" class="float left" loading="lazy">
        <img src="assets/images/index/login-right.svg" class="float right" loading="lazy">
        <div class="description">
          <a href="/">
            <img src="assets/images/sign-in/logo.png" alt="Chrono">
          </a>
          <p>TIME MANAGEMENT ASSISTANT</p>
        </div>
        <img src="assets/images/sign-in/illustration.png" class="signin-illustration">
      </aside>
      <!-- illustration end -->

      <!-- Register section start -->
      <section id="register" class="scale-down hide">
        <div class="register-wrapper">
          <p class="register">REGISTER NOW</p>
          <h2>Sign up for <span>free</span></h2>
          <p class="desc">Already have an account? <span class="login">Log In</span></p>
          <form action="utils/signup.php" method="POST">
            <label class="name">
              Name
              <div>
                <input type="text" name="name" required>
                <span class="user"><img src="assets/images/sign-in/user.svg"></span>
              </div>
            </label>
            <label>
              Email
              <div>
                <input type="email" name="email" required>
                <span class="mail"><img src="assets/images/sign-in/mail.svg"></span>
              </div>
            </label>
            <label>
              Password
              <div>
                <input type="password" name="password" id="register-password" required
                  oninput="toggleRegisterPassword()">
                <span class="lock"><img src="assets/images/sign-in/lock.svg"></span>
                <button type="button" class="toggle-password-register" onclick="togglePasswordRegister()">
                  <img src="/assets/images/sign-in/eye.svg">
                </button>
              </div>
            </label>
            <button type="submit">SIGN UP</button>
          </form>
          <p class="policy"><small>By clicking Sign Up, you agree to our Terms and that you have read our <a
                href="#">Privacy
                Policy</a></small></p>
        </div>
      </section>
      <!-- Register section end -->
      <!-- Login section start -->
      <section id="login">
        <div class="login-wrapper">
          <p class="login">START YOU JOURNEY</p>
          <h2>Log in To <span>Chrono</span></h2>
          <p class="desc">Don't have an account? <span class="signup">Sign Up</span></p>
          <form action="utils/signin.php" method="POST">
            <label>
              Email
              <div>
                <input type="email" name="email" required>
                <span class="mail"><img src="assets/images/sign-in/mail.svg"></span>
              </div>
            </label>
            <label>
              Password
              <div>
                <input type="password" name="password" id="login-password" required oninput="toggleLoginPassword()">
                <span class="lock"><img src="assets/images/sign-in/lock.svg"></span>
                <button type="button" class="toggle-password-login" onclick="togglePasswordLogin()">
                  <img src="/assets/images/sign-in/eye.svg">
                </button>
              </div>
            </label>
            <button type="submit">LOG IN</button>
          </form>
          <p class="policy"><small>By clicking Log In, you agree to our Terms and that you have read our <a
                href="#">Privacy
                Policy</a></small></p>
        </div>
      </section>
      <!-- Login section end -->
    </div>
  </main>
  <script src="assets/js/sign-in.js"></script>
</body>

</html>