<?php
require_once 'utils/auth.php';
if (!checkAuthCookie($_COOKIE["auth_user"], $_COOKIE["auth_token"])) {
  echo 'user gada cok';
} else {
  echo 'user ada cok';
}
?>