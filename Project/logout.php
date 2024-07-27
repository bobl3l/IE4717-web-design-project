<?php
session_start();
setcookie("logout_message", "You have logged out successfully!", time() + 20, "/");

session_unset();
session_destroy();

header("Location: home.php");
exit;

?>