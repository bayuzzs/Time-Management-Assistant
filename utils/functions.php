<?php
function generateRandomUserID()
{
  $uniqueID = uniqid();

  // limit the length to 11 characters
  $randomUserID = substr($uniqueID, 0, 11);

  return $randomUserID;
}

function renderSidebar($id, $name, $email, $active)
{
  // pathnya karena fungsi ini dipanggil contooh di /dashbord.php
  require_once 'templates/sidebar.php';
}
?>