<?php
function generateRandomUserID()
{
  $uniqueID = uniqid();

  // limit the length to 11 characters
  $randomUserID = substr($uniqueID, 0, 11);

  return $randomUserID;
}
?>