<?php

session_start();
include 'database/config.php';
// file_put_contents('cart_debug.txt', print_r($_SESSION['cart']));
// echo "<pre>";
// print_r($_SESSION['cart']);
// echo "</pre>";


$cart_items = array();
if (isset($_SESSION['cart'])) {
  foreach ($_SESSION['cart'] as $item_id => $sizes) {
    foreach ($sizes as $size => $quantity) {
      $stmt = $conn->prepare("SELECT * FROM items WHERE id = ?");
      $stmt->bind_param("i", $item_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $item = $result->fetch_assoc();
      if ($item) {
        $item['size'] = $size;
        $item['quantity'] = $quantity;
        $cart_items[] = $item;
      }
    }
  }
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
            <li><a href="home.php" >Home</a></li>
            <li><a href="top_listing.php">Tops</a></li>
            <li><a href="">Pants</a></li>
            <li><a href="shoe_listing.php">Shoes</a></li>
            <li><a href="">Accessories</a></li>            
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
    <table>
        <tr>
            <th><h3>Item</h3></th>
          <th><h3>Name</h3></th>
          <th><h3>Size</h3></th>
          <th><h3>Quantity</h3></th>
          <th><h3>Price</h3></th>
          <th><h3>Delete</h3></th>
        </tr>
    <?php foreach($cart_items as $item): ?>
      <tr id="cartitem<?php echo $item['id']; ?>">
            <td><img src="<?php echo $item['image_url']; ?>"></td>
            <td><h5><?php echo $item['name']; ?></h5></td>
            <td>
            <select name="size" id="size<?php echo $item['id']; ?>">
                <option value="XS" <?php echo ($item['size'] == "XS" ? "selected" : ""); ?>>XS</option>
                <option value="S" <?php echo ($item['size'] == "S" ? "selected" : ""); ?>>S</option>
                <option value="M" <?php echo ($item['size'] == "M" ? "selected" : ""); ?>>M</option>
                <option value="L" <?php echo ($item['size'] == "L" ? "selected" : ""); ?>>L</option>
                <option value="XL" <?php echo ($item['size'] == "XL" ? "selected" : ""); ?>>XL</option>
            </select>
            </td>
            <td>      <div style="padding: 5px;background-color: #f2f2f2;height: 30px;border-radius: 5px;">
            <button class="button" id='minus<?php echo $item['id']; ?>' onclick="changeQuantity(this.id, <?php echo $item['id']; ?>)">-</button>
        <input type="number" 
           id="quantity<?php echo $item['id']; ?>" 
           value="<?php echo $item['quantity']; ?>" 
           min="1" 
           data-price="<?php echo $item['price']; ?>"/>
        <button class="button" id='plus<?php echo $item['id']; ?>' onclick="changeQuantity(this.id, <?php echo $item['id']; ?>)">+</button>
            <td><h5><span id="subtotal<?php echo $item['id']; ?>">$<?php echo number_format($item['price'] * $_SESSION['cart'][$item['id']][$item['size']], 2); ?></span></h5></td>
            <td><form action="remove_from_cart.php" method="post" style="display: inline;">
        <input type="hidden" name="remove_id" value="<?php echo $item['id']; ?>">
        <button type="submit" class="trash-btn" style="background: none; border: none; font-size: 30px;margin: 4.5% 0;"> 
        <i class="fa fa-trash" style="font-size: 30px;"></i>
    </button>
</form></td>
        </tr>
      <?php endforeach; ?>
    </table>
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
    <div style="position: relative;left: 50%">
      $<span id="itemtotal"></span><br>$<span id="deliveryfee"></span><br>$<span id="gst"></span><br>$<span id="totalprice"></span>
    </div>
  </div>
  <hr style="  border-top: 3px solid #888; border-radius: 5px; margin: 5% 5% 1% 0%;">
  <form id="checkoutForm" action="checkout.php" method="post">
  <input type='hidden' name='itemtotal'><input type='hidden' name='deliveryfee'><input type='hidden' name='gst'><input type='hidden' name='totalprice'>
    <center><input type="submit" id="loginButton" name="loginButton" value="Continue to checkout"></center>
  </form>
</div>
</body>

<script>
updateTotal();
function changeQuantity(buttonId, itemId) {
    var quantity = document.getElementById("quantity" + itemId);
    var price = parseFloat(quantity.getAttribute('data-price'));
    if (buttonId=='minus' + itemId && quantity.value>1) {
        quantity.value--;
    } else if (buttonId=='plus' + itemId) {
        quantity.value++;
    }

    var newSubtotal = price * parseInt(quantity.value);
    document.getElementById("subtotal" + itemId).innerText = newSubtotal.toFixed(2);

    updateTotal();
}


function delivery(deliveryType) {
    switch (deliveryType) {
        case 'express':
            document.getElementById("standard").checked = false;
            break;
        case 'standard':
            document.getElementById("express").checked = false;
            break;
    }
    updateTotal();
}

function updateTotal() {
    var itemInputs = document.querySelectorAll('[id^="quantity"]');
    var itemTotal = 0;
    
    itemInputs.forEach(function(input) {
        var price = parseFloat(input.getAttribute('data-price'));
        var quantity = parseInt(input.value);
        itemTotal += price * quantity;
    });

    var deliveryFee = 0;
    if (document.getElementById("express").checked) {
        deliveryFee = 5;
    } else if (document.getElementById("standard").checked) {
        deliveryFee = 2;
    }

    var gst = 0.08 * (itemTotal + deliveryFee);
    var total = itemTotal + deliveryFee + gst;

    document.getElementById("itemtotal").innerText = itemTotal.toFixed(2);
    document.getElementById("deliveryfee").innerText = deliveryFee.toFixed(2);
    document.getElementById("gst").innerText = gst.toFixed(2);
    document.getElementById("totalprice").innerText = total.toFixed(2);
    document.querySelector("[name='itemtotal']").value= itemTotal.toFixed(2);
    document.querySelector("[name='deliveryfee']").value= deliveryFee.toFixed(2);
    document.querySelector("[name='gst']").value= gst.toFixed(2);
    document.querySelector("[name='totalprice']").value= total.toFixed(2);

}


document.getElementById('checkoutForm').addEventListener('submit', function(e){
  var cartItems = document.querySelectorAll('[id^="cartitem"]');
  if (cartItems.length == 0) {
    alert('Your cart is empty! Please add items before checking out.');
    e.preventDefault();
    return;
  }
  var expressChecked = document.getElementById("express").checked;
  var standardChecked = document.getElementById("standard").checked;
  if (!expressChecked && !standardChecked) {
    alert('Please select a delivery method.');
    e.preventDefault();
    return;
  }
});

</script>

</html>