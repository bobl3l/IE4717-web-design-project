<?php
session_start();

$user_id = $_SESSION['user_id'];
$sql = "SELECT items.name, items.price, items.image_url, cart_items.quantity FROM cart_items INNER JOIN items ON cart_items.product_id = items.id WHERE cart_items.cart_id = (SELECT cart_id FROM cart WHERE user_id = ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$cart_items = [];
while ($row = $result->fetch_assoc()) {
    $cart_items[] = $row;
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href='https://fonts.googleapis.com/css?family=Unica One' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Bigshot One' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Quantico' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Alata' rel='stylesheet'>
<link rel="stylesheet" href="style.css">

</head>
<body>
<div id="navbar">
    <nav>
      <img src="graphics/logo.png"/>
        <ul>
            <li><a href="avascript:void(0)" >Sales</a></li>
            <li><a href="avascript:void(0)">Tops</a></li>
            <li><a href="avascript:void(0)">Pants</a></li>
            <li><a href="avascript:void(0)">Shoes</a></li>
            <li><a href="avascript:void(0)">Accessories</a></li>            
        </ul>
        
        
    </nav>
  <div class="nav-right">
      <?php 
        if (isset($_SESSION['username'])) {
            echo '<a href="profile.php"><i class="fa fa-id-card-o" style="font-size: 30px; padding-right: 10px; color: #000;"></i></a>';
        } else {
            echo '<a href="login.html"><i class="fa fa-id-card-o" style="font-size: 30px; padding-right: 10px; color: #000;"></i></a>';
        }
        ?>
        <?php
        if (isset($_SESSION['username'])) {
          echo '<a href="cart.php"><i class="fa fa-shopping-cart" style="font-size: 30px;"></i></a>';
        } else {
          echo '<a href="login.html"><i class="fa fa-shopping-cart" style="font-size: 30px;"></i></a>';
        }
      ?>
    </div>
</div>
<br/>
<div id="cart">
    <h2 >Your Cart</h2>
    <div style="display: flex;" id="cartitem">
      <img src="https://limitededt.com/cdn/shop/files/166914036M-WHT-1_600x.jpg?v=1694591442">
      <h4>FINE CITY WHITE TEE </h4>
      <h4 style="margin-right: 3px;">Size:</h4>
      <select name="size" id="size">
        <option value="XS">XS</option>
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
      </select>
      <div style="margin-left: 5%;margin-top: 4.5%; background-color: #f2f2f2;height: 30px;border-radius: 5px;">
        <button class="button" id='minus'onclick="changeQuantity(this.id)">-</button>
        <input type="number" id="quantity" value="1" min="1"/>
        <button class="button" id='plus'onclick="changeQuantity(this.id)">+</button>
      </div>
      <h4>$39</h4>
      <i class="fa fa-trash" style="font-size: 30px;margin: 4.5% 0;"></i>
    </div>
</div>
<div id="details">
  <h2>Order Details  </h2>
  <h4>Delivery Method:</h4>
  <div style=" display: flex;"><input type="checkbox" id="express"  onchange="delivery(this.id)"/>Express Delivery
    <h5 style="color: gray; margin:1% 13% ;">* Deliver within 2-3 days</h5>
    </div>
    <div style=" display: flex;">
    <input type="checkbox" id="standard" onchange="delivery(this.id)"/>Standard Delivery
    <h5 style="color: gray; margin:1% 10% ;">* Deliver within 5-7 days</h5></div>
    <hr style="  border-top: 3px solid #888; border-radius: 5px; margin: 5% 5% 5% 0%;">
    <h4>Subtotal:</h4>
    <div style="display: flex;">
    <div>
      Item total:<br>Delivery fee:<br>GST (8%):<br>Total:
    </div>
    <div style="position: fixed;float: right;right: 12%;">
      $<span id="itemtotal"/><br>$<span id="deliveryfee"/><br>$<span id="gst"/><br>$<span id="totalprice"/>
    </div>
  </div>
  <hr style="  border-top: 3px solid #888; border-radius: 5px; margin: 5% 5% 1% 0%;">
  <center><input type="submit" id="loginButton" name="loginButton" value="Continue to checkout"></center>

</div>
</body>

<script>
function changeQuantity(x) {
  var quantity = document.getElementById("quantity");
  if (x=='minus' && quantity.value>1) {
    quantity.value--;
  } else if (x=='plus') {
    quantity.value++;
  }
}


function delivery(x) {
switch (x) {
    case 'express':
    document.getElementById("standard").checked = false;
    break;
    case 'standard':
    document.getElementById("express").checked = false;
    break;
    
}
}
</script>

</html>