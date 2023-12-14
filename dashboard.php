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

// Ambil activity
$stmt = $mysqli->prepare("SELECT * FROM activities WHERE id_user = ? ORDER BY date, time");
$stmt->bind_param("s", $id_user);
$stmt->execute();
$activities = $stmt->get_result();
$activities = $activities->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$totalActivities = 0;
$importantActivities = 0;
$overdueActivities = 0;
// if activity exist
if (count($activities)) {
  foreach ($activities as $activity) {
    $totalActivities++;
    if ($activity['priority'] == 'important') {
      $importantActivities++;
    }
    if (strtotime($activity['date'] . ' ' . $activity['time']) < time()) {
      $overdueActivities++;
    }
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
  <link rel="stylesheet" href="assets/css/dashboard.css">
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
  $active = 'dashboard';
  require_once 'templates/sidebar.php';
  ?>
  <!-- Sidebar end -->
  <!-- Main start -->
  <main>
    <!-- banner start -->
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
    <!-- banner end -->
    <div class="heading">
      <div class="heading__priority">
        <div class="heading__priority__img">
          <img src="assets/images/dashboard/timer-priority.svg">
        </div>
        <div class="heading__priority__detail">
          <p class="heading__priority__detail-count">
            <?= $importantActivities ?>
          </p>
          <p>Important Tasks</p>
        </div>
      </div>
      <div class="heading__overdue">
        <div class="heading__overdue__img">
          <img src="assets/images/dashboard/timer-overdue.svg">
        </div>
        <div class="heading__overdue__detail">
          <p class="heading__overdue__detail-count">
            <?= $overdueActivities ?>
          </p>
          <p>Overdue Tasks</p>
        </div>
      </div>
      <div class="heading__all">
        <div class="heading__all__img">
          <img src="assets/images/dashboard/timer-all.svg">
        </div>
        <div class="heading__all__detail">
          <p class="heading__all__detail-count">
            <?= $totalActivities ?>
          </p>
          <p>All Tasks</p>
        </div>
      </div>
    </div>
    <div class="activity">
      <!-- floatin action start-->
      <button class="activity__action" title="action" onclick="toggleAction()">
        <img class="activity__action-icon" src="./assets/images/dashboard/clock-plus.svg">
        <button class="activity__action-add" title="add" onclick="showModalAdd()">
          <img src="./assets/images/dashboard/add.svg">
        </button>
        <button class="activity__action-edit" title="edit" onclick="toggleEdit()">
          <img src="./assets/images/dashboard/edit.svg">
        </button>
      </button>
      <!-- floatin action end-->
      <div class="activity__heading">
        <p class="activity__heading-text">Current Activites</p>
        <div class="activity__heading-action">
          <input class="search" type="text" placeholder="Search..." onkeyup="search()">
          <select class="filter" onchange="search()">
            <option value="date" selected>Date</option>
            <option value="important">Important</option>
            <option value="overdue">overdue</option>
            <option value="daily">Daily</option>
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
          </select>
        </div>
      </div>
      <div class="activity__content">
        <?php if (!count($activities)): ?>
          <!-- empty activity -->
          <div class="activity__content__empty">
            <img src="./assets/images/dashboard/empty.png">
            <p>No activities yet</p>
          </div>
        <?php endif; ?>
        <?php foreach ($activities as $activitiy) {
          [
            'id_activity' => $id_activity,
            'title' => $title,
            'description' => $description,
            'date' => $date,
            'time' => $time,
            'priority' => $priority,
            'repetition' => $repetition
          ] = $activitiy;
          renderActivity($id_activity, $title, $description, $date, $time, $priority, $repetition);
        } ?>
      </div>
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
    <div class=" modal__edit" id="modalEdit">
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

    <!-- Modal delete start -->
    <div class="modal__delete" id="modalDelete">
      <p class="modal__delete-title"></p>
      <form class="modal__delete__form" action="utils/delete_activity.php" method="POST">
        <input class="modal__delete__form-id" name="id_activity" type="hidden">
        <button class="modal__delete__form-cancel" type="reset" onclick="hideModalDelete()">Cancel</button>
        <button class="modal__delete__form-delete" type="submit">Delete</button>
      </form>
    </div>
    <!-- Modal delete end -->

    <!-- Modal complete start -->
    <div class="modal__complete" id="modalComplete">
      <p class="modal__complete-title"></p>
      <form class="modal__complete__form" action="utils/complete_activity.php" method="POST">
        <input class="modal__complete__form-id" name="id_activity" type="hidden">
        <input class="modal__complete__form-title" name="title" type="hidden">
        <input class="modal__complete__form-description" name="description" type="hidden">
        <input class="modal__complete__form-date" name="date" type="hidden">
        <input class="modal__complete__form-repetition" name="repetition" type="hidden">
        <button class="modal__complete__form-cancel" type="reset" onclick="hideModalComplete()">No</button>
        <button class="modal__complete__form-complete" type="submit">Yes</button>
      </form>
    </div>
    <!-- Modal complete end -->
  </div>

  <script src="./assets/js/dashboard.js"></script>
</body>

</html>