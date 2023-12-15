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
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chrono - Time Management Assistant</title>

  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200;400;500;700;800&display=swap" rel="stylesheet">

  <!-- style -->
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/landing-page.css">
</head>

<body>
  <!-- Header start -->
  <header>
    <div class="container container-header">
      <div class="logo">
        <a href="index.php">
          <img src="assets/images/index/chrono-nav.png" alt="Chrono" title="Home">
        </a>
      </div>
      <nav>
        <div class="hamburger">
          <span class="hamburger-item top"></span>
          <span class="hamburger-item mid"></span>
          <span class="hamburger-item bottom"></span>
        </div>
        <ul>
          <li>
            <a href="#home">Home</a>
          </li>
          <li>
            <a href="#features">Features</a>
          </li>
          <li>
            <a href="#team">Team</a>
          </li>
          <li>
            <a href="#contact">Contact</a>
          </li>
          <li>
            <a href="sign-in.php" class="login">Login</a>
          </li>
        </ul>
      </nav>
    </div>
  </header>
  <!-- Header end -->

  <!-- Main start -->
  <main id="home">
    <img src="assets/images/index/main-left.svg" class="floating left">
    <img src="assets/images/index/main-right-1.svg" class="floating right-1">
    <img src="assets/images/index/main-right-2.svg" class="floating right-2">
    <div class="container container-main">
      <section class="main-content">
        <div class="description">
          <p class="title">TIME MANAGEMENT ASSISTANT</p>
          <h1>Stay Productive With <span>Chrono</span></h1>
          <p class="description-text">
            An innovative solution that helps you plan and manage your time smartly.
            Find
            the perfect balance between work, personal life and your dream, all in one easy-to-use app.
          </p>
          <div>
            <a href="sign-in.php">Get started Now!</a>
          </div>
        </div>
      </section>
      <aside class="illustration">
        <div class="img-container">
          <img src="assets/images/index/main-illustration.webp" alt="illustration">
          <div class="floating success">
            <img src="assets/images/index/success.svg">
          </div>
          <div class="floating productivity">
            <img src="assets/images/index/productivity.svg">
          </div>
          <div class="floating time">
            <img src="assets/images/index/time.svg">
          </div>
        </div>
      </aside>
    </div>
  </main>
  <!-- Main end -->

  <!-- Feature start -->
  <section id="features">
    <img src="assets/images/index/feature-left.svg" class="left">
    <div class="container container-features">
      <div class="description">
        <h2><span>Chrono</span> Features</h2>
        <p>
          We want to change the way people view and utilize time, bringing efficiently, focus and satisfaction
          to every second spend
        </p>
      </div>
      <div class="feature-container">
        <div class="feature-item item-1">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="50px" version="1.1"
              style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
              viewBox="0 0 99.23 85.46" xmlns:xlink="http://www.w3.org/1999/xlink"
              xmlns:xodm="http://www.corel.com/coreldraw/odm/2003">
              <g id="Layer_x0020_1">
                <metadata id="CorelCorpID_0Corel-Layer" />
                <g id="_1305869764144">
                  <path class="fil0 str0"
                    d="M60.36 80.57l-4.61 -1.15c-0.89,-0.24 -3.84,-1.14 -4.61,-1.15l0 -0.38c0.9,-0.02 9.32,-2.4 10.56,-2.69 -0.08,1.02 -1.03,4.03 -1.34,5.38zm38.41 -17.2l0 0.66c-0.1,0.75 -0.58,1.33 -1.8,1.67 -1.07,0.3 -1.79,0.49 -2.88,0.77 -8.41,2.11 -17.38,4.85 -25.73,6.92 -0.52,0.13 -1.08,0.21 -1.55,0.37 -1.02,0.35 -1.03,1.67 -1.56,3.81 -2.23,8.99 -1.56,8.01 -8.18,6.3l-11.65 -3.14c-2.76,-0.82 -2.11,-0.63 -5.25,0.17 -3.67,0.94 -4.11,1.42 -5.14,-3.03l-4.61 -1.15c-1.44,-0.38 -2.89,-0.81 -4.38,-1.2l-17.88 -4.78c-8.73,-2.59 -8.41,-0.89 -6.78,-7.51l3.11 -11.68c1.37,-5.17 2.86,-10.45 4.19,-15.6 1.35,-5.26 2.86,-10.29 4.19,-15.59l3.17 -11.81c0.35,-1.18 0.52,-2.71 2.09,-2.71 1.53,0 16.51,4.33 18.9,4.92 7.5,1.86 4.28,2.18 11.41,0.23 0.76,-0.21 1.77,-0.48 2.58,-0.69 1.25,-0.32 2.07,-0.33 2.07,-1 0,-1.05 -0.22,-0.68 -0.07,-1.78 0.99,-7.3 8.54,-8.76 12.69,-5.27 1.34,1.12 1.56,1.89 2.36,3.4l6.57 -1.69c6.28,-1.6 7.55,-3.04 8.64,1.26l5.22 19.55c2.87,11.48 6.56,23.65 9.41,35.15 0.33,1.31 0.79,2.48 0.88,3.43zm-79.13 -43.31c0,1.27 3.06,11.91 3.46,13.44l10.75 39.95 -29 -7.68 7.37 -27.78c0.67,-2.3 1.24,-4.61 1.81,-6.83 1.66,-6.46 4.15,-14.64 5.61,-20.89l15.56 4.03c-0.48,0.65 0.26,0.11 -1.8,0.7l-10.61 2.84c-1.38,0.39 -3.15,0.59 -3.15,2.22zm34 2.11c1.68,0 2.09,-1.54 2.89,-2.87 0.69,-1.14 1.47,-2.47 2.1,-3.66 2.39,0.2 4.57,0.72 7.25,-1.77 0.94,-0.87 2.22,-2.61 2.35,-4.18 1.48,-0.12 10.11,-2.78 11.33,-2.88l2.77 10.29c2.25,8.98 5,18.63 7.41,27.74l4.61 17.48c-2.26,0.53 -4.53,1.16 -6.83,1.81l-20.9 5.6c-6.91,1.73 -14.04,3.91 -20.74,5.57l-7.03 1.8c-0.54,-2.32 -1.22,-4.46 -1.8,-6.84l-9.3 -34.69c-0.38,-1.49 -3.6,-12.92 -3.69,-13.98l26.38 -7.04c5.54,-1.61 5.84,-2.47 2.15,3.69 -0.4,0.67 -0.98,1.35 -0.78,2.27 0.18,0.84 1,1.65 1.82,1.65zm3.27 -14.02c0,-3.1 3.56,-5.01 6.18,-2.92 2.78,2.21 0.9,6.76 -2.34,6.76 -2.04,0 -3.84,-1.69 -3.84,-3.84z" />
                  <path class="fil0 str0"
                    d="M40.77 54.64c0,3.66 5.01,1.43 6.87,0.92 6.34,-1.73 13.95,-3.6 20.14,-5.41 1.8,-0.53 3.36,-0.84 5.17,-1.36 1.74,-0.5 3.24,-0.85 4.99,-1.34 1.7,-0.48 3.92,-0.59 3.92,-2.61 0,-0.87 -0.91,-1.92 -1.73,-1.92 -1.01,0 -3.98,0.87 -5.15,1.19l-32.72 8.77c-0.7,0.25 -1.51,0.91 -1.51,1.76z" />
                  <path class="fil0 str0"
                    d="M36.35 37.93c0,0.57 0.13,1.05 0.46,1.46 1.14,1.4 4.24,0.1 6.71,-0.62 1.89,-0.55 3.56,-0.93 5.46,-1.45l27.1 -7.28c2.21,-1.01 1.17,-3.82 -0.36,-3.82 -1.57,0 -18.52,4.82 -20.28,5.26 -1.75,0.44 -3.25,0.91 -4.99,1.35l-10 2.68c-1.6,0.47 -4.1,0.55 -4.1,2.43z" />
                  <path class="fil0 str0"
                    d="M38.66 46.19c0,0.72 -0.05,1.2 0.55,1.76 0.28,0.26 0.85,0.47 1.21,0.5l34.85 -9.24c2.05,-0.6 4.29,-0.49 4.29,-2.81 0,-0.85 -0.71,-1.63 -1.45,-1.82 -0.96,-0.24 -17.57,4.52 -18.95,4.85l-18.79 5.03c-0.9,0.25 -1.72,0.6 -1.72,1.73z" />
                  <path class="fil0 str0"
                    d="M43.08 63.09c0,3.34 3.87,1.57 5.11,1.27 2.14,-0.53 4.13,-1.1 6.22,-1.65l9.25 -2.47c3.26,-0.97 1.73,-4.06 -0.03,-4.06l-18.98 5.03c-0.79,0.25 -1.57,0.79 -1.57,1.89z" />
                </g>
              </g>
            </svg>
          </div>
          <h4>Activity Listing</h4>
          <p>Record each task and activity with details such as title, description, date and priority</p>
        </div>
        <div class="feature-item item-2">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="40px" version="1.1"
              style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
              viewBox="0 0 79.98 78.84" xmlns:xlink="http://www.w3.org/1999/xlink"
              xmlns:xodm="http://www.corel.com/coreldraw/odm/2003">
              <g id="Layer_x0020_1">
                <metadata id="CorelCorpID_0Corel-Layer" />
                <g id="_1307323466288">
                  <path class="fil0"
                    d="M15.56 5.27c-18.57,1.05 -15.35,-1.22 -15.35,42.82 -0,22.55 -2.98,19.87 39.32,19.59l-1.45 -5.19c-5.69,-0.15 -11.43,0.01 -16.94,0.01 -3.66,0 -13.14,1.11 -15.32,-1.35 -1.13,-2.92 -0.47,-32.76 -0.46,-38.55l57.23 0.01 -0 14.81 5.19 1.06c-0,-7.4 -0.02,-14.82 0.01,-22.24 0.03,-8.94 -2.96,-10.88 -11.67,-10.89l-0.01 4.98 5.7 0.29c1.06,2.65 0.82,4.29 0.73,7.66l-57.14 0.09c-0.07,-2.26 -0.41,-5.14 0.57,-6.98 2.07,-1.74 5.83,-1.06 8.68,-1.06 2.23,0.46 0.47,3.77 5.6,2.3 0.99,-3.02 1.81,-15.49 -3.38,-12.04 -1.56,1.04 -1.21,2.85 -1.33,4.67z" />
                  <path class="fil0"
                    d="M77.81 53.17c-4.71,3.17 -1.17,5.26 -3.17,11.17 -4.52,13.36 -20.82,12.36 -26.34,5.72 -7.52,-9.05 -3.5,-23.43 8.5,-25.77 6.05,-1.18 7.53,0.75 11.78,2.01l2.69 -1.88c-4.54,-5.58 -17.83,-5.98 -25.15,1.66 -14.45,15.1 2.44,40.67 22.83,30.39 9.35,-4.71 12.63,-17.91 8.88,-23.29z" />
                  <path class="fil0"
                    d="M59.43 57.16c-1.23,-1.09 -9.12,-8.62 -8.5,-2.74 0.05,0.49 0.66,1.96 0.87,2.42 7.59,16.31 10.74,6.88 15.72,2.55 3.14,-2.73 3.5,-3.98 5.95,-6.47 12.75,-12.95 4.8,-10.4 -6.99,-1.04 -1.48,1.17 -5.59,4.65 -7.05,5.29z" />
                  <path class="fil0"
                    d="M47.03 5.35l-21.97 0.07 -0.02 4.79 22.15 1.07c0.76,0.99 -0.08,0.42 1.01,1.18 5.01,3.49 5.2,-7.98 3.25,-11.9 -4.5,-1.06 -4.08,0.63 -4.42,4.78z" />
                  <path class="fil0"
                    d="M28.47 32.17c-0.55,4.15 -0.52,4.36 0.04,8.46 3.06,0.23 8.31,0.69 10.85,-0.23 0.5,-1.42 0.65,-3.86 0.5,-5.79 -0.23,-3.15 -1.4,-2.85 -8.47,-2.62l-2.93 0.19z" />
                  <path class="fil0"
                    d="M11.21 55.91c4.38,0.61 6.83,0.5 11.22,0.06 0.55,-9.68 1.13,-8.63 -8.3,-8.62 -3.93,0 -3.72,3.27 -2.92,8.56z" />
                  <path class="fil0"
                    d="M11.28 32.24l0.06 8.31c4.48,0.65 6.37,0.38 10.88,0.08 0.64,-2.2 0.57,-6.09 0.13,-8.33 -4.28,-0.58 -6.78,-0.45 -11.07,-0.06z" />
                  <path class="fil0"
                    d="M31.4 56.26c8.14,0.01 6.43,0.85 7.86,-4.12 0.52,-1.8 0.65,-2.94 -0.02,-4.34 -1.88,-0.66 -9.39,-1.02 -10.55,0.24 -0.93,1 -0.73,4.01 -0.59,5.49 0.22,2.33 0.91,2.73 3.3,2.73z" />
                  <path class="fil0"
                    d="M45.3 35.14c0,5.06 -0.34,7.29 4.75,4.63 1.2,-0.63 2.12,-1.1 3.41,-1.47 2.32,-0.68 3.56,-0.15 3.55,-2.62 -0.02,-4.46 -0.48,-3.7 -8.88,-3.7 -2.33,0 -2.83,0.8 -2.83,3.16z" />
                </g>
              </g>
            </svg>
          </div>
          <h4>Schedule Management</h4>
          <p>Record each task and activity with details such as title, description, date and priority</p>
        </div>
        <div class="feature-item item-3">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="40px" viewBox="0 0 512 512">
              <path fill="currentColor"
                d="M256 416h240v32H256zm0-106.667h240v32H256zm0-106.666h240v32H256zM328 96h168v32H328z" />
              <path fill="currentColor"
                d="M302 111L167.2 27.216V96h-5.965C121.783 96 84.91 114.755 57.4 148.81C30.7 181.866 16 225.616 16 272s14.7 90.134 41.4 123.19C84.91 429.245 121.783 448 161.231 448H216v-32h-54.769C98.8 416 48 351.4 48 272s50.8-144 113.231-144h5.969v69.228ZM199.2 84.784l42.8 26.607l-42.8 27.381Z" />
            </svg>
          </div>
          <h4>Prioritizing Activities</h4>
          <p>Record each task and activity with details such as title, description, date and priority</p>
        </div>
        <div class="feature-item item-4">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="40px" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M10 21h4c0 1.1-.9 2-2 2s-2-.9-2-2m11-2v1H3v-1l2-2v-6c0-3.1 2-5.8 5-6.7V4c0-1.1.9-2 2-2s2 .9 2 2v.3c3 .9 5 3.6 5 6.7v6zm-4-8c0-2.8-2.2-5-5-5s-5 2.2-5 5v7h10z" />
            </svg>
          </div>
          <h4>Reminders & Notification</h4>
          <p>Record each task and activity with details such as title, description, date and priority</p>
        </div>
        <div class="feature-item item-5">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="40px" version="1.1"
              style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
              viewBox="0 0 227.23 172.75" xmlns:xlink="http://www.w3.org/1999/xlink"
              xmlns:xodm="http://www.corel.com/coreldraw/odm/2003">
              <g id="Layer_x0020_1">
                <metadata id="CorelCorpID_0Corel-Layer" />
                <g id="_1305869778016">
                  <path class="fil0"
                    d="M190.71 16.93c-0.63,0.28 -2.06,1.23 -2.69,1.64l-1.9 1.17c-1.7,1.11 -3.47,2.07 -5.17,3.18l-1.62 1c-0.19,0.11 -0.38,0.22 -0.56,0.34 -0.36,0.24 -0.71,0.44 -1.09,0.67l-5.94 3.66c-0.19,0.12 -0.37,0.24 -0.56,0.35l-3.8 2.34c-0.2,0.12 -0.35,0.22 -0.56,0.35l-2.18 1.34c-0.36,0.23 -0.73,0.45 -1.1,0.67l-2.18 1.34c-0.21,0.13 -0.34,0.22 -0.53,0.33 -0.19,0.11 -0.39,0.24 -0.56,0.35l-22.26 13.7c-0.2,0.12 -0.35,0.2 -0.53,0.32l-2.42 1.5c-1.93,1.16 -3.8,2.38 -5.73,3.53l-4.36 2.69c-0.5,0.3 -3.5,2.24 -3.85,2.33 -0.45,-0.67 -1.4,-1.39 -1.95,-2.03 -0.61,-0.72 -1.36,-1.34 -1.97,-2.07l-3.97 -4.09c-0.44,-0.44 -0.93,-0.86 -1.33,-1.34 -0.54,-0.64 -1.19,-1.2 -1.76,-1.81l-5.54 -5.72c-0.08,-0.1 -0.11,-0.16 -0.2,-0.25l-2.67 -2.72c-2.39,-2.38 -4.66,-4.89 -7.04,-7.27 -0.29,-0.29 -0.65,-0.61 -0.91,-0.91 -0.25,-0.3 -0.58,-0.77 -0.95,-0.92 -0.32,0.29 -16.18,9.8 -18.82,11.36l-34.06 20.53c-0.25,0.15 -0.49,0.29 -0.74,0.45l-2.91 1.75c-0.13,0.08 -0.21,0.13 -0.35,0.22l-1.1 0.66c-3.89,2.35 -7.72,4.66 -11.63,7l-10.88 6.56c-3.82,2.37 -7.77,4.67 -11.63,7 -0.23,0.14 -0.54,0.26 -0.69,0.49l4.17 6.89c0.19,0.31 0.32,0.54 0.51,0.85l3.14 5.21c0.18,0.3 0.38,0.57 0.53,0.91 0.42,-0.12 2.07,-1.2 2.57,-1.5l30.35 -18.28c0.13,-0.08 0.19,-0.13 0.31,-0.2l17.91 -10.78c1.73,-1.04 3.39,-2.04 5.11,-3.07l15.35 -9.25c0.88,-0.53 1.67,-1 2.56,-1.53 1.08,-0.65 7.32,-4.33 7.65,-4.63 0.25,0.1 0.7,0.67 0.92,0.89 0.44,0.45 0.92,0.87 1.31,1.36l7.33 7.56c0.49,0.55 1.04,1.05 1.56,1.56 0.18,0.18 0.24,0.3 0.42,0.48l1.36 1.36c0.17,0.16 0.26,0.32 0.42,0.49 3.27,3.29 6.48,6.76 9.74,10.02 0.61,0.61 4.27,4.33 4.66,4.82 0.08,0.1 0.14,0.15 0.22,0.23 0.16,0.16 0.32,0.29 0.44,0.47l2.17 -1.34c1.21,-0.79 2.54,-1.51 3.76,-2.32l2.22 -1.36c1.41,-0.94 3.55,-2.18 5.03,-3.09 2.62,-1.62 5.27,-3.2 7.88,-4.85 2.18,-1.39 4.42,-2.71 6.61,-4.07l2.21 -1.36c0.12,-0.07 0.18,-0.12 0.31,-0.2 0.44,-0.27 0.82,-0.48 1.24,-0.75l7.91 -4.87c0.15,-0.09 0.2,-0.12 0.32,-0.2l28.31 -17.42c0.24,-0.14 0.39,-0.25 0.63,-0.39l8.2 -5.04c0.93,-0.55 3.02,-1.96 3.82,-2.33l0.52 0.83c0.07,0.12 0.13,0.21 0.19,0.32 0.11,0.18 0.22,0.38 0.34,0.57 0.12,0.18 0.25,0.39 0.37,0.6 0.23,0.39 0.47,0.76 0.71,1.16 0.11,0.18 0.22,0.37 0.34,0.57l2.13 3.49c0.12,0.2 0.24,0.38 0.37,0.6l4.27 7.03c0.23,0.38 2.08,3.27 2.11,3.52 0.1,-0.08 0.06,-0.04 0.14,-0.16 0.12,-0.19 0.18,-0.46 0.25,-0.66 0.01,-0.02 0.02,-0.07 0.03,-0.09 0.41,-1.23 0.96,-2.44 1.39,-3.66l2.88 -7.63c0.02,-0.07 0.02,-0.08 0.04,-0.13l4.22 -11.12c0.04,-0.12 0.02,-0.06 0.06,-0.17l0.74 -1.94c0,-0.01 0.01,-0.03 0.01,-0.04 0,-0.01 0.01,-0.03 0.01,-0.04l3.2 -8.39c0.03,-0.1 0.03,-0.12 0.07,-0.22l1.16 -3.04c0.04,-0.11 0.09,-0.23 0.14,-0.36 0.49,-1.16 0.87,-2.27 1.3,-3.47l0.52 -1.35c0.13,-0.34 0.48,-1.14 0.53,-1.44 -0.93,-0 -2,-0.22 -2.9,-0.33 -1,-0.12 -2,-0.21 -2.95,-0.35 -0.49,-0.07 -1,-0.1 -1.46,-0.18 -0.47,-0.08 -0.99,-0.1 -1.47,-0.18 -1.42,-0.24 -2.9,-0.32 -4.37,-0.52l-2.92 -0.38c-1.99,-0.29 -3.9,-0.39 -5.88,-0.71 -0.91,-0.15 -1.98,-0.21 -2.91,-0.33l-8.81 -1.07c-0.22,-0.03 -0.44,-0.08 -0.7,-0.1l-3.65 -0.43c-0.27,-0.05 -0.42,-0.06 -0.7,-0.1l-5.19 -0.61c-0.22,-0.02 -0.46,-0.08 -0.69,-0.1 -0.63,-0.07 -1.63,-0.23 -2.22,-0.23 0.08,0.28 0.44,0.76 0.6,1.03l8.39 13.77c0.44,0.73 0.84,1.43 1.3,2.13z" />
                  <path class="fil0"
                    d="M179.86 52.21l0 120.55 16.3 0 0 -130.55c-0.09,0.03 -0.15,0.07 -0.23,0.12l-11.47 7.05c-0.1,0.06 -0.15,0.09 -0.24,0.15 -0.11,0.07 -0.18,0.11 -0.29,0.17l-1.01 0.63c-0.34,0.21 -0.67,0.41 -1.02,0.62l-2.04 1.24z" />
                  <path class="fil0"
                    d="M152.02 69.36l0 103.39 16.25 0 0 -113.39c-0.07,0.03 -0.15,0.09 -0.22,0.13l-2.29 1.41c-2.18,1.3 -4.46,2.79 -6.65,4.09 -0.16,0.09 -0.35,0.21 -0.49,0.3l-1.02 0.63c-0.19,0.11 -0.34,0.21 -0.52,0.33 -0.34,0.21 -0.67,0.41 -1.02,0.62 -0.17,0.1 -0.3,0.19 -0.49,0.31l-2.04 1.25c-0.2,0.13 -0.35,0.22 -0.53,0.32l-0.97 0.61z" />
                  <path class="fil0"
                    d="M68.34 73.79l0 98.96 16.3 0 0 -108.73 -5.34 3.19c-0.07,0.05 -0.15,0.09 -0.25,0.15 -0.19,0.11 -0.37,0.22 -0.53,0.32l-10.18 6.11z" />
                  <path class="fil0"
                    d="M96.23 69.08l0 103.68 16.3 0 0.01 -86.75c-0.01,-0.26 0.01,-0.15 -0.13,-0.28l-3.7 -3.79c-0.18,-0.19 -0.25,-0.31 -0.45,-0.51 -0.33,-0.33 -0.61,-0.61 -0.94,-0.94 -0.16,-0.16 -0.31,-0.29 -0.46,-0.46 -0.18,-0.2 -0.25,-0.31 -0.45,-0.51l-1.39 -1.4c-0.18,-0.22 -0.25,-0.3 -0.46,-0.51 -0.33,-0.33 -0.61,-0.61 -0.94,-0.94 -0.33,-0.33 -0.58,-0.63 -0.91,-0.97l-1.85 -1.9c-0.66,-0.66 -4.45,-4.63 -4.64,-4.73z" />
                  <path class="fil0"
                    d="M124.13 86.52l0 86.23 16.3 0 0 -96.23 -3.58 2.17c-0.17,0.11 -0.35,0.22 -0.53,0.33 -0.18,0.11 -0.32,0.2 -0.49,0.31l-1.55 0.95c-0.16,0.09 -0.35,0.21 -0.49,0.3 -1.79,1.16 -4.43,2.76 -6.12,3.77l-3.55 2.18z" />
                  <path class="fil0"
                    d="M40.5 90.55l0 82.2 16.25 0 0 -91.92c-0.2,0.02 -0.83,0.45 -1,0.55l-14.25 8.59c-0.2,0.12 -0.83,0.54 -1,0.58z" />
                  <path class="fil0"
                    d="M12.63 107.31l-0.02 65.33 16.19 -0.06c0,-12.5 0,-25 0,-37.49l0.01 -37.22c-0.03,-0.33 0.06,-0.18 -0.12,-0.22 0,0.11 0.11,-0.08 -0.03,0.06l-15.87 9.56c-0.14,0.06 0.02,0.03 -0.17,0.04z" />
                  <path class="fil0"
                    d="M12.63 107.31c-0.09,0.03 -0.15,-0.1 -0.13,0.45 0.05,2.39 0.01,5.27 0.01,7.67l0 57.32 16.39 0 0.03 -75.27c-0.46,0 -0.05,-0.03 -0.23,0.17 0.18,0.04 0.09,-0.11 0.12,0.22l-0.01 37.22c0,12.5 0,25 0,37.49l-16.19 0.06 0.02 -65.33z" />
                </g>
              </g>
            </svg>
          </div>
          <h4>Time Visualization</h4>
          <p>Record each task and activity with details such as title, description, date and priority</p>
        </div>
      </div>
    </div>
  </section>
  <!-- Feature end -->

  <!-- Team start -->
  <section id="team">
    <div class="container container-team">
      <div class="description">
        <h2><span>Chrono</span> Team</h2>
        <p>
          Welcome to Team Chrono! Here you can get to know those of us dedicated to bringing Chrono into your
          life.
        </p>
      </div>
      <div class="team-wrapper">
        <div class="team-container">
          <?php
          $teams = json_decode(file_get_contents('data/teams.json'), true);
          foreach ($teams as $key => $team) {
            require 'templates/team_card.php';
          }
          ?>
        </div>
      </div>
    </div>
  </section>
  <!-- Team end -->

  <!-- Contact Start -->
  <section id="contact">
    <div class="container container-contact">
      <div class="description">
        <h2><span>Chrono</span> Contact</h2>
        <p>Are you looking for help or have any questions? Drop us a message in this form!</p>
      </div>
      <div class="contact-form-container">
        <div class="form-wrap">
          <div class="alert-loader"></div>
          <div class="alert alert-success">
            <img src="assets/images/success.svg">
            <p class="alert__message">Your Message has been Submitted!</p>
          </div>
          <form class="form" action="" method="POST" onsubmit="userSubmit(event)">
            <input type="email" placeholder="Email" name="Email" required>
            <textarea placeholder="Message" name="Message" required></textarea>
            <button type="submit">Send Message</button>
          </form>
        </div>
        <div class="illustration">
          <img src="assets/images/index/contact-illustration.webp" loading="lazy">
        </div>
      </div>
    </div>
  </section>
  <!-- Contact end -->

  <!-- Footer Start -->
  <footer>
    <div class="container container-footer">
      <div class="company">
        <a href="https://polibatam.ac.id" target="_blank">
          <img src="assets/images/index/polibatam-white.png">
        </a>
        <a href="https://if.polibatam.ac.id/teknologi-rekayasa-perangkat-lunak/" target="_blank">
          <img src="assets/images/index/trpl-white.png">
        </a>
        <a href="/">
          <img src="assets/images/index/footer.png">
        </a>
      </div>
      <p class="desc">Chrono is a web-based Time Management Asisstant for productivity optimization</p>
      <div class="logo-container">
        <a href="#" class="svg-wrap">
          <svg width="20px" viewBox="0 0 24 24" fill="#000000" xmlns="http://www.w3.org/2000/svg">
            <title>Instagram</title>
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
            </g>
            <g id="SVGRepo_iconCarrier">
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M12 18C15.3137 18 18 15.3137 18 12C18 8.68629 15.3137 6 12 6C8.68629 6 6 8.68629 6 12C6 15.3137 8.68629 18 12 18ZM12 16C14.2091 16 16 14.2091 16 12C16 9.79086 14.2091 8 12 8C9.79086 8 8 9.79086 8 12C8 14.2091 9.79086 16 12 16Z"
                fill="#000000"></path>
              <path
                d="M18 5C17.4477 5 17 5.44772 17 6C17 6.55228 17.4477 7 18 7C18.5523 7 19 6.55228 19 6C19 5.44772 18.5523 5 18 5Z"
                fill="#000000"></path>
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M1.65396 4.27606C1 5.55953 1 7.23969 1 10.6V13.4C1 16.7603 1 18.4405 1.65396 19.7239C2.2292 20.8529 3.14708 21.7708 4.27606 22.346C5.55953 23 7.23969 23 10.6 23H13.4C16.7603 23 18.4405 23 19.7239 22.346C20.8529 21.7708 21.7708 20.8529 22.346 19.7239C23 18.4405 23 16.7603 23 13.4V10.6C23 7.23969 23 5.55953 22.346 4.27606C21.7708 3.14708 20.8529 2.2292 19.7239 1.65396C18.4405 1 16.7603 1 13.4 1H10.6C7.23969 1 5.55953 1 4.27606 1.65396C3.14708 2.2292 2.2292 3.14708 1.65396 4.27606ZM13.4 3H10.6C8.88684 3 7.72225 3.00156 6.82208 3.0751C5.94524 3.14674 5.49684 3.27659 5.18404 3.43597C4.43139 3.81947 3.81947 4.43139 3.43597 5.18404C3.27659 5.49684 3.14674 5.94524 3.0751 6.82208C3.00156 7.72225 3 8.88684 3 10.6V13.4C3 15.1132 3.00156 16.2777 3.0751 17.1779C3.14674 18.0548 3.27659 18.5032 3.43597 18.816C3.81947 19.5686 4.43139 20.1805 5.18404 20.564C5.49684 20.7234 5.94524 20.8533 6.82208 20.9249C7.72225 20.9984 8.88684 21 10.6 21H13.4C15.1132 21 16.2777 20.9984 17.1779 20.9249C18.0548 20.8533 18.5032 20.7234 18.816 20.564C19.5686 20.1805 20.1805 19.5686 20.564 18.816C20.7234 18.5032 20.8533 18.0548 20.9249 17.1779C20.9984 16.2777 21 15.1132 21 13.4V10.6C21 8.88684 20.9984 7.72225 20.9249 6.82208C20.8533 5.94524 20.7234 5.49684 20.564 5.18404C20.1805 4.43139 19.5686 3.81947 18.816 3.43597C18.5032 3.27659 18.0548 3.14674 17.1779 3.0751C16.2777 3.00156 15.1132 3 13.4 3Z"
                fill="#000000"></path>
            </g>
          </svg>
        </a>
        <a href="#" class="svg-wrap">
          <svg width="20px" viewBox="-5 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
            </g>
            <g id="SVGRepo_iconCarrier">
              <title>facebook</title>
              <desc>Created with Sketch.</desc>
              <defs> </defs>
              <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g id="Dribbble-Light-Preview" transform="translate(-385.000000, -7399.000000)" fill="#000000">
                  <g id="icons" transform="translate(56.000000, 160.000000)">
                    <path
                      d="M335.821282,7259 L335.821282,7250 L338.553693,7250 L339,7246 L335.821282,7246 L335.821282,7244.052 C335.821282,7243.022 335.847593,7242 337.286884,7242 L338.744689,7242 L338.744689,7239.14 C338.744689,7239.097 337.492497,7239 336.225687,7239 C333.580004,7239 331.923407,7240.657 331.923407,7243.7 L331.923407,7246 L329,7246 L329,7250 L331.923407,7250 L331.923407,7259 L335.821282,7259 Z"
                      id="facebook-[#176]"> </path>
                  </g>
                </g>
              </g>
            </g>
          </svg>
        </a>
        <a href="#" class="svg-wrap">
          <svg width="20px" viewBox="0 0 24 24" fill="#000000" xmlns="http://www.w3.org/2000/svg">
            <title>Whatsapp</title>
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
            </g>
            <g id="SVGRepo_iconCarrier">
              <path
                d="M14.3308 15.9402L15.6608 14.6101C15.8655 14.403 16.1092 14.2384 16.3778 14.1262C16.6465 14.014 16.9347 13.9563 17.2258 13.9563C17.517 13.9563 17.8052 14.014 18.0739 14.1262C18.3425 14.2384 18.5862 14.403 18.7908 14.6101L20.3508 16.1702C20.5579 16.3748 20.7224 16.6183 20.8346 16.887C20.9468 17.1556 21.0046 17.444 21.0046 17.7351C21.0046 18.0263 20.9468 18.3146 20.8346 18.5833C20.7224 18.8519 20.5579 19.0954 20.3508 19.3L19.6408 20.02C19.1516 20.514 18.5189 20.841 17.8329 20.9541C17.1469 21.0672 16.4427 20.9609 15.8208 20.6501C10.4691 17.8952 6.11008 13.5396 3.35083 8.19019C3.03976 7.56761 2.93414 6.86242 3.04914 6.17603C3.16414 5.48963 3.49384 4.85731 3.99085 4.37012L4.70081 3.65015C5.11674 3.23673 5.67937 3.00464 6.26581 3.00464C6.85225 3.00464 7.41488 3.23673 7.83081 3.65015L9.40082 5.22021C9.81424 5.63615 10.0463 6.19871 10.0463 6.78516C10.0463 7.3716 9.81424 7.93416 9.40082 8.3501L8.0708 9.68018C8.95021 10.8697 9.91617 11.9926 10.9608 13.04C11.9994 14.0804 13.116 15.04 14.3008 15.9102L14.3308 15.9402Z"
                stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="fillCurrent">
              </path>
            </g>
          </svg>
        </a>
      </div>
      <p class="copyright"><small>&copy; Copryright Chrono. All Rights Reserved Designed by <u>Team 3 Mini-PBL
            TRPL 1A</u></small></p>
    </div>
  </footer>
  <!-- Footer End -->
  <!-- script -->
  <script src="assets/js/landing-page.js"></script>
</body>

</html>