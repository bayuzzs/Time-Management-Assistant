<?php
echo password_hash('123', PASSWORD_BCRYPT, ["cost" => 12]);
?>