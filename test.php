<?php
$uniqueID = uniqid();

// Remove the prefix and limit the length to 11 characters
$randomUserID = substr($uniqueID, 0, 11);
echo $randomUserID;
?>