<?php
require_once 'utils/auth.php';
require_once 'utils/functions.php';
session_start();

// check user and token from cookie
if (!isset($_COOKIE["auth_user"]) || !isset($_COOKIE["auth_token"])) {
  // if user not login yet
  header("Location: /sign-in.php");
  exit();
}

// if user not login yet, kick them to the signin page
if (!checkAuthCookie($_COOKIE["auth_user"], $_COOKIE["auth_token"])) {
  header("Location: /sign-in.php");
  exit();
}

// get user data
$user = loginFromCookie($_COOKIE["auth_user"]);

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
  <link rel="stylesheet" href="assets/css/dashboard.css">
</head>

<body>
  <?php if (isset($message, $type)): ?>
    <div class="alert alert-<?= $type ?>">
      <p class="alert__message">
        <?= $message ?>
      </p>
    </div>
  <?php endif; ?>

  <!-- Sidebar start -->
  <?php
  // destructuring from user data
  ['id_user' => $id_user, 'name' => $name, 'email' => $email] = $user;
  renderSidebar($id_user, $name, $email, 'dashboard');
  ?>
  <!-- Sidebar end -->
  <!-- Main start -->
  <main>
    <div class="banner">
      <div class="banner__text">
        <p class="banner__text-greeting">Welcome,
          <?= $name ?>!
        </p>
        <p class="banner__text-description">Welcome to Chrono Dashboard Easily make your task all in one place.</p>
      </div>
      <div class="banner__image">
        <img src="assets/images/dashboard/hero.png">
      </div>
    </div>
    <div class="heading">
      <div class="heading__priority">
        <img src="assets/images/dashboard/timer-priority.svg">
        <div class="heading__priority__detail">
          <p class="heading__priority__detail-count">0</p>
          <p>Priority Tasks</p>
        </div>
      </div>
      <div class="heading__overdue">
        <img src="assets/images/dashboard/timer-overdue.svg">
        <div class="heading__overdue__detail">
          <p class="heading__overdue__detail-count">0</p>
          <p>Overdue Tasks</p>
        </div>
      </div>
      <div class="heading__all">
        <img src="assets/images/dashboard/timer-all.svg">
        <div class="heading__all__detail">
          <p class="heading__all__detail-count">0</p>
          <p>All Tasks</p>
        </div>
      </div>
    </div>
    <div class="activity">
      <button href="#" class="activity__add" title="add">
        <img src="./assets/images/dashboard/add.svg">
      </button>
      <div class="activity__heading">
        <p class="activity__heading-text">Current Activites</p>
        <div class="activity__heading-action">
          <button class="activity__heading-action-edit" onclick="toggleEdit()">
            <img src="./assets/images/dashboard/edit.svg">
          </button>
          <div class="activity__heading-action__find">
            <input class="search" type="text" placeholder="Search...">
            <select class="filter">
              <option value="all">All</option>
              <option value="important">Important</option>
              <option value="overdue">overdue</option>
            </select>
          </div>
        </div>
      </div>
      <div class="activity__content">
        <!-- <div class="activity__content__empty">
            <img src="./assets/images/dashboard/empty.svg">
            <p>No activities yet</p>
          </div> -->
        <div class="activity__content-item">
          <div class="activity__content-item__left">
            <p class="activity__content-item__left-title">Meeting With Client x</p>
            <p class="activity__content-item__left-priority">Important</p>
            <p class="activity__content-item__left-daily">Daily</p>
            <p class="activity__content-item__left-weekly">Weekly</p>
            <p class="activity__content-item__left-monthly">Monthly</p>
            <p class="activity__content-item__left-description">
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Culpa laboriosam sapiente dignissimos
              repellendus tempora neque, eveniet magnam eligendi ut modi.
            </p>
          </div>
          <div class="activity__content-item__right">
            <div class="activity__content-item__right-time">
              <p>22 November 2023</p>
              <p>20:15:00</p>
            </div>
            <div class="activity__content-item__right-action">
              <button class="activity__content-item__right-action-edit btn">
                <img src="./assets/images/dashboard/edit.svg">
              </button>
              <button class="activity__content-item__right-action-delete btn">
                <img src="./assets/images/dashboard/delete.svg">
              </button>
              <button class="activity__content-item__right-action-complete btn">
                <img src="./assets/images/dashboard/complete.svg">
              </button>
            </div>
          </div>
        </div>
        <div class="activity__content-item">
          <div class="activity__content-item__left">
            <p class="activity__content-item__left-title">Meeting With Client x</p>
            <p class="activity__content-item__left-priority">Important</p>
            <p class="activity__content-item__left-daily">Daily</p>
            <p class="activity__content-item__left-weekly">Weekly</p>
            <p class="activity__content-item__left-monthly">Monthly</p>
            <p class="activity__content-item__left-description">
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Culpa laboriosam sapiente dignissimos
              repellendus tempora neque, eveniet magnam eligendi ut modi.
            </p>
          </div>
          <div class="activity__content-item__right">
            <div class="activity__content-item__right-time">
              <p>22 November 2023</p>
              <p>20:15:00</p>
            </div>
            <div class="activity__content-item__right-action">
              <button class="activity__content-item__right-action-edit btn">
                <img src="./assets/images/dashboard/edit.svg">
              </button>
              <button class="activity__content-item__right-action-delete btn">
                <img src="./assets/images/dashboard/delete.svg">
              </button>
              <button class="activity__content-item__right-action-complete btn">
                <img src="./assets/images/dashboard/complete.svg">
              </button>
            </div>
          </div>
        </div>
        <div class="activity__content-item">
          <div class="activity__content-item__left">
            <p class="activity__content-item__left-title">Meeting With Client x</p>
            <p class="activity__content-item__left-priority">Important</p>
            <p class="activity__content-item__left-daily">Daily</p>
            <p class="activity__content-item__left-weekly">Weekly</p>
            <p class="activity__content-item__left-monthly">Monthly</p>
            <p class="activity__content-item__left-description">
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Culpa laboriosam sapiente dignissimos
              repellendus tempora neque, eveniet magnam eligendi ut modi.
            </p>
          </div>
          <div class="activity__content-item__right">
            <div class="activity__content-item__right-time">
              <p>22 November 2023</p>
              <p>20:15:00</p>
            </div>
            <div class="activity__content-item__right-action">
              <button class="activity__content-item__right-action-edit btn">
                <img src="./assets/images/dashboard/edit.svg">
              </button>
              <button class="activity__content-item__right-action-delete btn">
                <img src="./assets/images/dashboard/delete.svg">
              </button>
              <button class="activity__content-item__right-action-complete btn">
                <img src="./assets/images/dashboard/complete.svg">
              </button>
            </div>
          </div>
        </div>
        <div class="activity__content-item">
          <div class="activity__content-item__left">
            <p class="activity__content-item__left-title">Meeting With Client x</p>
            <p class="activity__content-item__left-priority">Important</p>
            <p class="activity__content-item__left-daily">Daily</p>
            <p class="activity__content-item__left-weekly">Weekly</p>
            <p class="activity__content-item__left-monthly">Monthly</p>
            <p class="activity__content-item__left-description">
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Culpa laboriosam sapiente dignissimos
              repellendus tempora neque, eveniet magnam eligendi ut modi.
            </p>
          </div>
          <div class="activity__content-item__right">
            <div class="activity__content-item__right-time">
              <p>22 November 2023</p>
              <p>20:15:00</p>
            </div>
            <div class="activity__content-item__right-action">
              <button class="activity__content-item__right-action-edit btn">
                <img src="./assets/images/dashboard/edit.svg">
              </button>
              <button class="activity__content-item__right-action-delete btn">
                <img src="./assets/images/dashboard/delete.svg">
              </button>
              <button class="activity__content-item__right-action-complete btn">
                <img src="./assets/images/dashboard/complete.svg">
              </button>
            </div>
          </div>
        </div>
        <div class="activity__content-item">
          <div class="activity__content-item__left">
            <p class="activity__content-item__left-title">Meeting With Client x</p>
            <p class="activity__content-item__left-priority">Important</p>
            <p class="activity__content-item__left-daily">Daily</p>
            <p class="activity__content-item__left-weekly">Weekly</p>
            <p class="activity__content-item__left-monthly">Monthly</p>
            <p class="activity__content-item__left-description">
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Culpa laboriosam sapiente dignissimos
              repellendus tempora neque, eveniet magnam eligendi ut modi.
            </p>
          </div>
          <div class="activity__content-item__right">
            <div class="activity__content-item__right-time">
              <p>22 November 2023</p>
              <p>20:15:00</p>
            </div>
            <div class="activity__content-item__right-action">
              <button class="activity__content-item__right-action-edit btn">
                <img src="./assets/images/dashboard/edit.svg">
              </button>
              <button class="activity__content-item__right-action-delete btn">
                <img src="./assets/images/dashboard/delete.svg">
              </button>
              <button class="activity__content-item__right-action-complete btn">
                <img src="./assets/images/dashboard/complete.svg">
              </button>
            </div>
          </div>
        </div>
        <div class="activity__content-item">
          <div class="activity__content-item__left">
            <p class="activity__content-item__left-title">Meeting With Client x</p>
            <p class="activity__content-item__left-priority">Important</p>
            <p class="activity__content-item__left-daily">Daily</p>
            <p class="activity__content-item__left-weekly">Weekly</p>
            <p class="activity__content-item__left-monthly">Monthly</p>
            <p class="activity__content-item__left-description">
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Culpa laboriosam sapiente dignissimos
              repellendus tempora neque, eveniet magnam eligendi ut modi.
            </p>
          </div>
          <div class="activity__content-item__right">
            <div class="activity__content-item__right-time">
              <p>22 November 2023</p>
              <p>20:15:00</p>
            </div>
            <div class="activity__content-item__right-action">
              <button class="activity__content-item__right-action-edit btn">
                <img src="./assets/images/dashboard/edit.svg">
              </button>
              <button class="activity__content-item__right-action-delete btn">
                <img src="./assets/images/dashboard/delete.svg">
              </button>
              <button class="activity__content-item__right-action-complete btn">
                <img src="./assets/images/dashboard/complete.svg">
              </button>
            </div>
          </div>
        </div>
        <div class="activity__content-item">
          <div class="activity__content-item__left">
            <p class="activity__content-item__left-title">Meeting With Client x</p>
            <p class="activity__content-item__left-priority">Important</p>
            <p class="activity__content-item__left-daily">Daily</p>
            <p class="activity__content-item__left-weekly">Weekly</p>
            <p class="activity__content-item__left-monthly">Monthly</p>
            <p class="activity__content-item__left-description">
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Culpa laboriosam sapiente dignissimos
              repellendus tempora neque, eveniet magnam eligendi ut modi.
            </p>
          </div>
          <div class="activity__content-item__right">
            <div class="activity__content-item__right-time">
              <p>22 November 2023</p>
              <p>20:15:00</p>
            </div>
            <div class="activity__content-item__right-action">
              <button class="activity__content-item__right-action-edit btn">
                <img src="./assets/images/dashboard/edit.svg">
              </button>
              <button class="activity__content-item__right-action-delete btn">
                <img src="./assets/images/dashboard/delete.svg">
              </button>
              <button class="activity__content-item__right-action-complete btn">
                <img src="./assets/images/dashboard/complete.svg">
              </button>
            </div>
          </div>
        </div>
        <div class="activity__content-item">
          <div class="activity__content-item__left">
            <p class="activity__content-item__left-title">Meeting With Client x</p>
            <p class="activity__content-item__left-priority">Important</p>
            <p class="activity__content-item__left-daily">Daily</p>
            <p class="activity__content-item__left-weekly">Weekly</p>
            <p class="activity__content-item__left-monthly">Monthly</p>
            <p class="activity__content-item__left-description">
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Culpa laboriosam sapiente dignissimos
              repellendus tempora neque, eveniet magnam eligendi ut modi.
            </p>
          </div>
          <div class="activity__content-item__right">
            <div class="activity__content-item__right-time">
              <p>22 November 2023</p>
              <p>20:15:00</p>
            </div>
            <div class="activity__content-item__right-action">
              <button class="activity__content-item__right-action-edit btn">
                <img src="./assets/images/dashboard/edit.svg">
              </button>
              <button class="activity__content-item__right-action-delete btn">
                <img src="./assets/images/dashboard/delete.svg">
              </button>
              <button class="activity__content-item__right-action-complete btn">
                <img src="./assets/images/dashboard/complete.svg">
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- Main end -->
  <script src="./assets/js/dashboard.js"></script>
</body>

</html>