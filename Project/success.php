<?php

include 'database/config.php';

session_start();

$recipient = "user@localhost";
$subject = "Order Confirmation";
$message = "Thank you for your purchase!";
$sender = "From: admin@westcoast.com";
(mail($recipient, $subject, $message, $sender));

header("Location: success.html");


?> 