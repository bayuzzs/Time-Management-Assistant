<?php
try {
  $currentDate = date('Y-m-d H:i:s', strtotime('-1 days'));

  // Calculate the date 2 days from now
  $twoDaysFromNow = date('Y-m-d H:i:s', strtotime('+3 days'));

  // Prepare the SQL query
  $query = "SELECT * FROM activities WHERE id_user = ? AND date BETWEEN ? AND ? ";
  $statement = $mysqli->prepare($query);

  // Bind the parameters
  $statement->bind_param('sss', $id_user, $currentDate, $twoDaysFromNow);

  // Execute the query
  $statement->execute();
  // Get the result
  $result = $statement->get_result();

  // Check if any rows were returned
  if ($result->num_rows > 0) {
    // Fetch the data
    $notificationsData = $result->fetch_all(MYSQLI_ASSOC);
  } else {
    // Handle the case where no data is found
    $notificationsData = [];
  }

  // Close te statement and the connection
  $statement->close();
  $mysqli->close();
} catch (Exception $e) {
  // Handle any exceptions or errors
  echo "An error occurred: " . $e->getMessage();
  die();
}
?>
<section class="sidebar">
  <!-- Hamburger Menur -->
  <div class="sidebar__hamburger" onclick="toggleSidebar()">
    <div></div>
    <div></div>
    <div></div>
  </div>
  <!-- Sidebar Profile -->
  <div class="sidebar__profile">
    <div class="sidebar__profile__account">
      <div class="sidebar__profile__account__avatar">
        <img src="assets/images/dashboard/avatar.svg">
      </div>
      <div class="sidebar__profile__account__detail">
        <p class="sidebar__profile__account__detail-name">
          <?= $name ?>
        </p>
        <p class="sidebar__profile__account__detail-email">
          <?= $email ?>
        </p>
      </div>
    </div>
    <div class="sidebar__profile__menu">
      <a href="/settings.php" class="settings <?= $active == 'settings' ? 'active' : '' ?>" title="Settings">
        <svg width="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
          <g id="SVGRepo_iconCarrier">
            <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.5"></circle>
            <path
              d="M3.66122 10.6392C4.13377 10.9361 4.43782 11.4419 4.43782 11.9999C4.43781 12.558 4.13376 13.0638 3.66122 13.3607C3.33966 13.5627 3.13248 13.7242 2.98508 13.9163C2.66217 14.3372 2.51966 14.869 2.5889 15.3949C2.64082 15.7893 2.87379 16.1928 3.33973 16.9999C3.80568 17.8069 4.03865 18.2104 4.35426 18.4526C4.77508 18.7755 5.30694 18.918 5.83284 18.8488C6.07287 18.8172 6.31628 18.7185 6.65196 18.5411C7.14544 18.2803 7.73558 18.2699 8.21895 18.549C8.70227 18.8281 8.98827 19.3443 9.00912 19.902C9.02332 20.2815 9.05958 20.5417 9.15224 20.7654C9.35523 21.2554 9.74458 21.6448 10.2346 21.8478C10.6022 22 11.0681 22 12 22C12.9319 22 13.3978 22 13.7654 21.8478C14.2554 21.6448 14.6448 21.2554 14.8478 20.7654C14.9404 20.5417 14.9767 20.2815 14.9909 19.9021C15.0117 19.3443 15.2977 18.8281 15.7811 18.549C16.2644 18.27 16.8545 18.2804 17.3479 18.5412C17.6837 18.7186 17.9271 18.8173 18.1671 18.8489C18.693 18.9182 19.2249 18.7756 19.6457 18.4527C19.9613 18.2106 20.1943 17.807 20.6603 17C20.8677 16.6407 21.029 16.3614 21.1486 16.1272M20.3387 13.3608C19.8662 13.0639 19.5622 12.5581 19.5621 12.0001C19.5621 11.442 19.8662 10.9361 20.3387 10.6392C20.6603 10.4372 20.8674 10.2757 21.0148 10.0836C21.3377 9.66278 21.4802 9.13092 21.411 8.60502C21.3591 8.2106 21.1261 7.80708 20.6601 7.00005C20.1942 6.19301 19.9612 5.7895 19.6456 5.54732C19.2248 5.22441 18.6929 5.0819 18.167 5.15113C17.927 5.18274 17.6836 5.2814 17.3479 5.45883C16.8544 5.71964 16.2643 5.73004 15.781 5.45096C15.2977 5.1719 15.0117 4.6557 14.9909 4.09803C14.9767 3.71852 14.9404 3.45835 14.8478 3.23463C14.6448 2.74458 14.2554 2.35523 13.7654 2.15224C13.3978 2 12.9319 2 12 2C11.0681 2 10.6022 2 10.2346 2.15224C9.74458 2.35523 9.35523 2.74458 9.15224 3.23463C9.05958 3.45833 9.02332 3.71848 9.00912 4.09794C8.98826 4.65566 8.70225 5.17191 8.21891 5.45096C7.73557 5.73002 7.14548 5.71959 6.65205 5.4588C6.31633 5.28136 6.0729 5.18269 5.83285 5.15108C5.30695 5.08185 4.77509 5.22436 4.35427 5.54727C4.03866 5.78945 3.80569 6.19297 3.33974 7C3.13231 7.35929 2.97105 7.63859 2.85138 7.87273"
              stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
          </g>
        </svg>
      </a>
      <button class="notifications <?= count($notificationsData) ? 'active' : '' ?>" title="Notifications"
        onclick="toggleNotifications()">
        <?php if (count($notificationsData)): ?>
          <p class="notifications__count">
            <?= count($notificationsData) ?>
          </p>
        <?php endif; ?>
        <svg width="25" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M13.75 28.875H19.25C19.25 30.3875 18.0125 31.625 16.5 31.625C14.9875 31.625 13.75 30.3875 13.75 28.875ZM28.875 26.125V27.5H4.125V26.125L6.875 23.375V15.125C6.875 10.8625 9.625 7.15 13.75 5.9125V5.5C13.75 3.9875 14.9875 2.75 16.5 2.75C18.0125 2.75 19.25 3.9875 19.25 5.5V5.9125C23.375 7.15 26.125 10.8625 26.125 15.125V23.375L28.875 26.125ZM23.375 15.125C23.375 11.275 20.35 8.25 16.5 8.25C12.65 8.25 9.625 11.275 9.625 15.125V24.75H23.375V15.125Z"
            fill="currentColor" />
        </svg>
      </button>
      <div class="notifications__content">
        <?php if (!count($notificationsData)): ?>
          <p class="notifications__content__empty">No new notifications</p>
        <?php endif ?>
        <?php if (count($notificationsData)): ?>
          <p><small>
              <?= count($notificationsData) ?> new notifications in next 3 days
            </small>
          </p>
          <?php foreach ($notificationsData as $notification): ?>
            <div class="notifications__content__item">
              <p class="notifications__content__item-title">
                <?= htmlspecialchars($notification['title']) ?>
              </p>
              <div class="notifications__content__item-datetime">
                <p>
                  <?php
                  $notificationDate = date_create($notification['date']);
                  $currentDate = date_create();
                  if ($notificationDate->format('Y-m-d') == $currentDate->format('Y-m-d')) {
                    echo 'Today';
                  } else {
                    echo date_format($notificationDate, 'l, d M Y');
                  }
                  ?>
                </p>
                |
                <p>
                  <?= $notification['time'] ?>
                </p>
              </div>
            </div>
          <?php endforeach ?>
        <?php endif ?>
      </div>
    </div>
  </div>
  <div class="sidebar__menu">
    <nav class="sidebar__menu__list">
      <ul>
        <li>
          <a href="/dashboard.php" class="<?= $active == 'dashboard' ? 'active' : '' ?>" title="Dashboard">
            <svg width="23px" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <path d="M11 19.5H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round"></path>
                <path d="M11 12.5H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round"></path>
                <path d="M11 5.5H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round"></path>
                <path d="M3 5.5L4 6.5L7 3.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round">
                </path>
                <path d="M3 12.5L4 13.5L7 10.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round">
                </path>
                <path d="M3 19.5L4 20.5L7 17.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round">
                </path>
              </g>
            </svg>
            All Activities
          </a>
        </li>
        <li>
          <a href="/calendar.php" class="<?= $active == 'calendar' ? 'active' : '' ?>" title="Calendar">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M19 19H5V8h14m-3-7v2H8V1H6v2H5c-1.11 0-2 .89-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-1V1m-1 11h-5v5h5v-5Z" />
            </svg>
            Calendar
          </a>
        </li>
        <li>
          <a href="/history.php" class="<?= $active == 'history' ? 'active' : '' ?>" title="History">
            <svg width="23px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <path d="M12 8V12L14.5 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                  stroke-linejoin="round">
                </path>
                <path
                  d="M5.60423 5.60423L5.0739 5.0739V5.0739L5.60423 5.60423ZM4.33785 6.87061L3.58786 6.87438C3.58992 7.28564 3.92281 7.61853 4.33408 7.6206L4.33785 6.87061ZM6.87963 7.63339C7.29384 7.63547 7.63131 7.30138 7.63339 6.88717C7.63547 6.47296 7.30138 6.13549 6.88717 6.13341L6.87963 7.63339ZM5.07505 4.32129C5.07296 3.90708 4.7355 3.57298 4.32129 3.57506C3.90708 3.57715 3.57298 3.91462 3.57507 4.32882L5.07505 4.32129ZM3.75 12C3.75 11.5858 3.41421 11.25 3 11.25C2.58579 11.25 2.25 11.5858 2.25 12H3.75ZM16.8755 20.4452C17.2341 20.2378 17.3566 19.779 17.1492 19.4204C16.9418 19.0619 16.483 18.9393 16.1245 19.1468L16.8755 20.4452ZM19.1468 16.1245C18.9393 16.483 19.0619 16.9418 19.4204 17.1492C19.779 17.3566 20.2378 17.2341 20.4452 16.8755L19.1468 16.1245ZM5.14033 5.07126C4.84598 5.36269 4.84361 5.83756 5.13505 6.13191C5.42648 6.42626 5.90134 6.42862 6.19569 6.13719L5.14033 5.07126ZM18.8623 5.13786C15.0421 1.31766 8.86882 1.27898 5.0739 5.0739L6.13456 6.13456C9.33366 2.93545 14.5572 2.95404 17.8017 6.19852L18.8623 5.13786ZM5.0739 5.0739L3.80752 6.34028L4.86818 7.40094L6.13456 6.13456L5.0739 5.0739ZM4.33408 7.6206L6.87963 7.63339L6.88717 6.13341L4.34162 6.12062L4.33408 7.6206ZM5.08784 6.86684L5.07505 4.32129L3.57507 4.32882L3.58786 6.87438L5.08784 6.86684ZM12 3.75C16.5563 3.75 20.25 7.44365 20.25 12H21.75C21.75 6.61522 17.3848 2.25 12 2.25V3.75ZM12 20.25C7.44365 20.25 3.75 16.5563 3.75 12H2.25C2.25 17.3848 6.61522 21.75 12 21.75V20.25ZM16.1245 19.1468C14.9118 19.8483 13.5039 20.25 12 20.25V21.75C13.7747 21.75 15.4407 21.2752 16.8755 20.4452L16.1245 19.1468ZM20.25 12C20.25 13.5039 19.8483 14.9118 19.1468 16.1245L20.4452 16.8755C21.2752 15.4407 21.75 13.7747 21.75 12H20.25ZM6.19569 6.13719C7.68707 4.66059 9.73646 3.75 12 3.75V2.25C9.32542 2.25 6.90113 3.32791 5.14033 5.07126L6.19569 6.13719Z"
                  fill="currentColor"></path>
              </g>
            </svg>
            History
          </a>
        </li>
      </ul>
    </nav>
    <div class="sidebar__menu__logout">
      <a href="/utils/logout.php" title="Logout"><span><img src="./assets/images/dashboard/logout.svg"></span>Logout</a>
    </div>
  </div>
</section>
<script>
  function toggleSidebar() {
    let sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('active');
  }
  function toggleNotifications() {
    document.querySelector('.notifications').classList.toggle('clicked');
    document.querySelector('.notifications__content').classList.toggle('show');
  }
</script>