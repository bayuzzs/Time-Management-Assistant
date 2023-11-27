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

// check session to show an alert
if (isset($_SESSION['message'], $_SESSION['type'])) {
  $message = $_SESSION['message'];
  $type = $_SESSION['type'];
  unset($_SESSION['message']);
  unset($_SESSION['type']);
}

// destructuring from user data
['id_user' => $id_user, 'name' => $name, 'email' => $email] = $user;
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
  <?php if (isset($message, $type)): ?>
    <div class="alert alert-<?= $type ?>">
      <img src="assets/images/<?= $type ?>.svg">
      <p class="alert__message">
        <?= $message ?>
      </p>
    </div>
  <?php endif; ?>
  <?php
  renderSidebar($id_user, $name, $email, 'calendar');
  ?>
  <!-- Main start -->
  <main>
    <div id="calendar">
    </div>
  </main>
  <!-- Main end -->

  <div class="modal">
    <!-- modal add start -->
    <div class="modal__add" id="modalAdd">
      <form class="modal__add__form" action="utils/add_activity.php" method="POST">
        <p>Task Details</p>
        <input class="modal__add__form-title" type="text" name="title" placeholder="Title" tabindex="1" required>
        <textarea class="modal__add__form-description" name="description" rows="5" placeholder="Description"
          tabindex="2" required></textarea>
        <p>Task Date</p>
        <div class="modal__add__form__datetime">
          <input class="modal__add__form__datetime-date" type="date" name="date" tabindex="3" required>
          <input class="modal__add__form__datetime-time" type="time" name="time" tabindex="4" required>
        </div>
        <p>Task Priority</p>
        <div class="modal__add__form__priority">
          <label>
            <input type="radio" name="priority" value="none" checked>
            None
          </label>
          <label>
            <input type="radio" name="priority" value="important">
            Important
          </label>
        </div>
        <p>Task Repetition</p>
        <div class="modal__add__form__repetition">
          <label>
            <input type="radio" name="repetition" value="none" checked>
            None
          </label>
          <label>
            <input type="radio" name="repetition" value="daily">
            Daily
          </label>
          <label>
            <input type="radio" name="repetition" value="weekly">
            Weekly
          </label>
          <label>
            <input type="radio" name="repetition" value="monthly">
            Monthly
          </label>
        </div>
        <div class="modal__add__form__button">
          <button class="modal__add__form__button-cancel" type="reset" title="Cancel" tabindex="5"
            onclick="hideModalAdd()">Cancel</button>
          <button class="modal__add__form__button-add" type="submit" title="Add Activity" tabindex="6">Add</button>
        </div>
      </form>
    </div>
    <!-- modal add end -->
    <!-- modal edit start -->
    <div class="modal__edit" id="modalEdit">
      <form class="modal__edit__form" action="utils/edit_activity.php" method="POST">
        <input class="modal__edit__form-id" type="hidden" name="id_activity">
        <p>Task Details</p>
        <input class="modal__edit__form-title" type="text" name="title" tabindex="1" required>
        <textarea class="modal__edit__form-description" name="description" rows="5" tabindex="2" required></textarea>
        <p>Task Date</p>
        <div class="modal__edit__form__datetime">
          <input class="modal__edit__form__datetime-date" type="date" name="date" tabindex="3" required>
          <input class="modal__edit__form__datetime-time" type="time" name="time" tabindex="4" required>
        </div>
        <p>Task Priority</p>
        <div class="modal__edit__form__priority">
          <label>
            <input type="radio" name="priority" value="none">
            None
          </label>
          <label>
            <input type="radio" name="priority" value="important">
            Important
          </label>
        </div>
        <p>Task Repetition</p>
        <div class="modal__edit__form__repetition">
          <label>
            <input type="radio" name="repetition" value="none">
            None
          </label>
          <label>
            <input type="radio" name="repetition" value="daily">
            Daily
          </label>
          <label>
            <input type="radio" name="repetition" value="weekly">
            Weekly
          </label>
          <label>
            <input type="radio" name="repetition" value="monthly">
            Monthly
          </label>
        </div>
        <div class="modal__edit__form__button">
          <button class="modal__edit__form__button-cancel" type="reset" title="Cancel" tabindex="5"
            onclick="hideModalEdit()">Cancel</button>
          <button class="modal__edit__form__button-add" type="submit" title="Edit Activity" tabindex="6">Save</button>
        </div>
      </form>
    </div>
    <!-- modal edit end -->
  </div>
  <script type="javascript" src="./assets/js/dashboard.js"></script>
  <script src="./assets/js/calendar.js"></script>

</body>

</html>