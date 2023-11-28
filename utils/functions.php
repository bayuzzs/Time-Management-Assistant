<?php
function generateRandomUserID()
{
  $uniqueID = uniqid();

  // limit the length to 11 characters
  $randomUserID = substr($uniqueID, 0, 11);

  return $randomUserID;
}

function renderSidebar($mysqli, $id_user, $name, $email, $active)
{
  // pathnya karena fungsi ini dipanggil contooh di /dashbord.php
  require_once 'templates/sidebar.php';
}

function renderActivity($id_activity, $title, $description, $date, $time, $priority, $repetition)
{
  require 'templates/activity_card.php';
}
?>