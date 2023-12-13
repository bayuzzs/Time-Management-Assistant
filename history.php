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
$stmt = $mysqli->prepare("SELECT * FROM history_activities WHERE id_user = ? ORDER BY date");
$stmt->bind_param("s", $id_user);
$stmt->execute();
$history_activities = $stmt->get_result();
$stmt->close();

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
  <title>History</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200;300;400;500;600;700&display=swap"
    rel="stylesheet">

  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/sidebar.css">
  <link rel="stylesheet" href="assets/css/history.css">
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
  $active = 'history';
  require_once 'templates/sidebar.php';
  ?>
  <!-- Sidebar end -->

  <main>
    <?php if ($history_activities->num_rows == 0): ?>
      <div class="history__none">
        <img src="assets/images/dashboard/history.png">
        <p>No History yet</p>
      </div>
    <?php endif; ?>
    <?php if ($history_activities->num_rows > 0): ?>
      <div class="summary">
        <div class="summary__info">
          <h1 class="summary__info-title">History</h1>
          <p class="summary__count">Total History :
            <?= $history_activities->num_rows ?>
          </p>
        </div>
        <div class="chart">
          <div class="chart__filter">
            <p>Filter chart By:</p>
            <select class="chart__select" onchange="updateChart(event)" class="chart__select">
              <option value="week" selected>Day</option>
              <option value="month">Week</option>
              <option value="year">Month</option>
            </select>
          </div>
          <div class="chart__container">
            <canvas id="historyChart">
            </canvas>
          </div>
        </div>
      </div>
      <div class="table__wrapper">
        <table class="table" cellspacing="0">
          <h1>All History </h1>
          <!-- colgroup for template column in table -->
          <colgroup>
            <col class="table__col-1">
            <col class="table__col-2">
            <col class="table__col-3">
            <col class="table__col-4">
          </colgroup>
          <thead class="table__head">
            <tr>
              <th class="table__head-title">Title</th>
              <th class="table__head-description">Description</th>
              <th class="table__head-date">Date</th>
              <th class="table__head-action">Action</th>
            </tr>
          </thead>
          <tbody class="table__body">
            <?php while ($history_activity = $history_activities->fetch_assoc()): ?>
              <tr>
                <td>
                  <?= htmlspecialchars($history_activity['title']) ?>
                </td>
                <td>
                  <?= htmlspecialchars($history_activity['description']) ?>
                </td>
                <td>
                  <?= $history_activity['date'] ?>
                </td>
                <td class="table__body-delete">
                  <button data-id="<?= $history_activity['id_history'] ?>" data-title="<?= $history_activity['title'] ?>"
                    onclick="showModalDelete(event)" title="Delete">Delete</button>
                </td>
              </tr>
            <?php endwhile; ?>

          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </main>
  <!-- modal start -->
  <div class="modal">
    <!-- Modal delete start -->
    <div class="modal__delete" id="modalDelete">
      <p class="modal__delete-title"></p>
      <form class="modal__delete__form" action="utils/delete_history.php" method="POST">
        <input class="modal__delete__form-id" name="id_history" type="hidden">
        <button class="modal__delete__form-cancel" type="reset" onclick="hideModalDelete()">Cancel</button>
        <button class="modal__delete__form-delete" type="submit">Delete</button>
      </form>
    </div>
    <!-- Modal delete end -->
  </div>
  <!-- modal end -->
  <script src="./assets/js/chart.umd.min.js"></script>
  <script src="./assets/js/history.js"></script>
</body>

</html>