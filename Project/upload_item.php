<?php
include 'database\config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $category_id = $_POST['category_id'];
    $name = $_POST['item_name'];
    $description = $_POST['item_description'];
    $price = $_POST['item_price'];
    $image_url = $_POST['item_image1'];
    $hover_image_url = $_POST['item_image2'];
    
    $sql = "INSERT INTO items (category_id, name, description, price, image_url, hover_image_url) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issdss", $category_id, $name, $description, $price, $image_url, $hover_image_url);
    if ($stmt->execute()) {
        header("Location: admin.php?message=New item uploaded successfully!");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

?>