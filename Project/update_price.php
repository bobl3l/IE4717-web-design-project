<?php
include 'database\config.php';

if (isset($_POST['selected_item'])) {
    $selected_item = $_POST['selected_item'];
    if (isset($_POST['price_' . $selected_item])){
        $new_price = str_replace('$', '', $_POST['price_' . $selected_item]);
        $sql = "UPDATE items SET promoprice=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("di", $new_price, $selected_item);
        if ($stmt->execute()) {
            header("Location: admin.php?message=Price updated successfully!");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
$conn->close();
?>