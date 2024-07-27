<?php
$admin_password = "12345";
$hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);
echo $hashed_password;
?>