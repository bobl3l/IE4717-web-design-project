
<?php
session_start();

include 'database\config.php';


$sql = "SELECT * FROM items";
$result = $conn->query($sql);
$items = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
$categories = [];
if ($result->num_rows>0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

$message = "";
if (isset($_GET['message'])) {
    $message = $_GET['message'];
}
?>


<!DOCTYPE html>
<html>
<head>
    <link href='https://fonts.googleapis.com/css?family=Bigshot One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
<style>
    .success-message {
    padding: 10px;
    background-color: #dff0d8;
    border: 1px solid #d0e9c6;
    color: #3c763d;
    margin: 10px 0;
    border-radius: 5px;
}
</style>
</head>  
<body>
    <a href="home.php"><button class="admin-logout"></i><u>EXIT</u>   <i class="fa fa-arrow-right" style="font-size: 20px; color: #513F3A;"></i></button></a>
<center>
<?php if (!empty($message)): ?>
<div class="success-message">
    <?php echo $message; ?>
</div>
<?php endif; ?>
    <div id="admin">
        <h1>Admin price management</h1>
        <form action="update_price.php" method="post">
        <table>
            <tr>
                <th><h3>Select</h3></th>
              <th><h3>Item ID</h3></th>
              <th><h3>Item image</h3></th>
              <th><h3>Item Name</h3></th>
              <th><h3>Item Price</h3></th>
            </tr>
            <?php foreach($items as $item): ?>

            <tr>
                <td><input type="radio" name="selected_item" value="<?php echo $item['id']; ?>" /></td>
                <td><h3><?php echo $item['id']; ?></h3></td>
                <td><img src="<?php echo $item['image_url']; ?>" ></td>
                <td><h3><?php echo $item['name']; ?></h3></td>
                <td><input type="text" name="price_<?php echo $item['id']; ?>" value="$<?php 
                if ($item['promoprice']!=NULL) { echo $item['promoprice']; ;} else {echo $item['price'];}
                ?>"disabled></td>
            </tr>
            <?php endforeach; ?>
            </table>
            <input type="submit" value="Update Price" />
        </form>  
    </div>
</center>
<button type="button" id="new-item" onclick="openForm()">+</button>
<div class="form-popup" id="adminForm">
    <form action="upload_item.php" class="form-container" method='post'>
        <div style="height: 5%;width: 100%;"><h2  style="float: left; margin: 0% 2%;">Upload New Item</h2>
        <div style="float: right;"onclick="closeForm()"><i class="fa fa-window-close" style="font-size: 30px; margin-right: 30px;"></i>
        </div>
    </div>
        <br>
        <div style='position:relative'>
            <!-- <input type="text" placeholder="ID"><br> -->
            <!-- <input type="text" name='category_id' placeholder="Category ID"><br> -->
            <div style='position:absolute; margin-left:12%'><h1>Category:</h1></div>
            <select name="category_id">
                    <?php foreach($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>">
                            <?php echo $category['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            <div style="width: 40%;margin-left:50%;margin-top:10%;">                
            <input type="text" name="item_name" placeholder="Name"><br>
            <input type="text" name="item_price" placeholder="price"><br>
            <input type="text" name="item_image1" placeholder="Image 1"><br>
            <input type="text" name="item_image2" placeholder="Image 2"><br>
            </div>     
            <div style="width: 85%;margin-left:10%;">
            <textarea id="description" name="item_description" rows="4" wrap="soft" maxlength="400" placeholder="Item Description"></textarea>
            </div>
            <center>
                <input type="submit" class="actionbutton" id="loginButton"  value="Upload" onclick="closeForm()">
                    </center>
        </div>
    </form>
</div>
</body>
<script>
        
function openForm() {
    document.getElementById("adminForm").style.display = "block";
}
function closeForm() {
    document.getElementById("adminForm").style.display = "none";
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[name="selected_item"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            document.querySelectorAll('[name^="price_"]').forEach(function(input) {
                input.disabled = true;
            });
            document.querySelector('[name="price_' + radio.value + '"]').disabled = false;
        });
    });
});
</script>


</html>