<?php
file_put_contents('debug.txt', print_r($_POST, true));

include 'database/config.php';

session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_POST['product_id']) && isset($_POST['quantity'])&& isset($_POST['size'])) {
    $item_id = $_POST['product_id'];
    $quantity = (int) $_POST['quantity'];
    $size = $_POST['size'];


    if (array_key_exists($item_id, $_SESSION['cart'])) {
        if (array_key_exists($size, $_SESSION['cart'][$item_id])) {
            $_SESSION['cart'][$item_id][$size] += $quantity;
        } else {
            $_SESSION['cart'][$item_id][$size] = $quantity;
        }
    } else {
        $_SESSION['cart'][$item_id] = array($size => $quantity);
    }

    if ($item_id > 12){
        header("Location: ./shoe_listing.php");
    } else {
        header("Location: ./top_listing.php");
    }
}

?>
