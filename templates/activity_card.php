<?php
$overdue = strtotime($date . ' ' . $time) < time() ? 'overdue' : 'none';
?>
<div class="activity__content-item">
  <div class="activity__content-item__left">
    <?= '<p class="activity__content-item__left-title">' . htmlspecialchars($title) . '</p>' ?>
    <div class="activity__content-item__left-badge">
      <?= $priority == 'none'
        ? '<p class="activity__content-item__left-priority"></p>'
        : '<p class="activity__content-item__left-priority">' . htmlspecialchars($priority) . '</p>' ?>
      <?= $repetition == 'none'
        ? '<p class="activity__content-item__left-repetition"></p>'
        : '<p class="activity__content-item__left-repetition">' . $repetition . '</p>' ?>
      <?= $overdue == 'none'
        ? '<p class="activity__content-item__left-overdue"></p>'
        : '<p class="activity__content-item__left-overdue">' . $overdue . '</p>' ?>
    </div>
    <p class="activity__content-item__left-description">
      <?= htmlspecialchars($description) ?>
    </p>
  </div>
  <div class="activity__content-item__right">
    <div class="activity__content-item__right-time">
      <p>
        <?= date("d M Y", strtotime($date)) ?>
      </p>
      <p>
        <?= $time ?>
      </p>
    </div>
    <div class="activity__content-item__right-action">
      <button class="activity__content-item__right-action-edit btn" data-id="<?= $id_activity ?>"
        onclick="showModalEdit(event)">
        <img src=" ./assets/images/dashboard/edit.svg">
      </button>
      <button class="activity__content-item__right-action-delete btn" data-id="<?= $id_activity ?>"
        data-title="<?= $title ?>" onclick="showModalDelete(event)">
        <img src="./assets/images/dashboard/delete.svg">
      </button>
      <button class="activity__content-item__right-action-complete btn" data-id="<?= $id_activity ?>"
        data-title="<?= $title ?>" data-description="<?= $description ?>" data-date="<?= $date ?>"
        data-repetition="<?= $repetition ?>" onclick="showModalComplete(event)">
        <img src="./assets/images/dashboard/complete.svg">
      </button>
    </div>
  </div>
</div>