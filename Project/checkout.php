<?php

session_start();
include 'database\config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows>0){
  $user = $result->fetch_assoc();
} else {
  echo "Hey you sholdn't be here!";
}

if (!empty($_POST)) {
  $itemtotal = $_POST['itemtotal'];
  $deliveryfee = $_POST['deliveryfee'];
  $gst = $_POST['gst'];
  $totalprice = $_POST['totalprice'];
}


?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href='https://fonts.googleapis.com/css?family=Unica One' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Bigshot One' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Quantico' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Alata' rel='stylesheet'>
<link rel="stylesheet" href="style.css">

</head>
<body>

<div id="navbar">
    <nav>
      <img src="graphics/logo.png"/>
        <ul>
            <li><a href="avascript:void(0)" >Home</a></li>
            <li><a href="top_listing.php">Tops</a></li>
            <li><a href="avascript:void(0)">Pants</a></li>
            <li><a href="avascript:void(0)">Shoes</a></li>
            <li><a href="avascript:void(0)">Accessories</a></li>            
        </ul>
        
        
    </nav>
  <div class="nav-right">
    <a href="login.html"><i class="fa fa-id-card-o" style="font-size: 175%; padding-right: 10px;" ></i></a>
    <a href="cart.php"><i class="fa fa-shopping-cart" style="font-size:175%;"></i></a>
    </div>
</div>
<br/>

<div id="cart">
    <h2 >Your Details</h2>
    <div style="display: inline-block;">
        <div style="float: left;">
            <h4 style="margin-bottom: 35%;">Name:</h4><h4 style="margin-bottom: 35%;">Email:</h4><h4 style="margin-bottom: 35%;">Contact:</h4><h4 style="margin-bottom: 100%;">Full Address:</h4><h4>Remark:</h4>
        </div>
       
        <div style="margin-left: 20%;">
            <input type="text" id="name" value="<?php echo $user['fullname']; ?>">
            <input type="text" id="email"value="<?php echo $user['email']; ?>">
            <input type="text" id="contactno" value="<?php echo $user['contact'];?>">
            <textarea id="address" rows="4" wrap="soft" maxlength="400"value="<?php echo $user['fulladdress']; ?>"></textarea>
            <textarea id="remark" rows="4" wrap="soft" maxlength="400"></textarea>
        </div>
        
    </div>
</div>
<div id="details">
  <h2>Order Details  </h2>
  <h4>Payment Method:</h4>
  <div style=" display: flex;">
    <input type="checkbox" id="credit"  onchange="payment(this.id)"/>Credit Card
    </div>
    <div style=" display: flex;">
    <input type="checkbox" id="paypal" onchange="payment(this.id)"/>Paypal
</div>
<div style=" display: flex;">
    <input type="checkbox" id="googlepay" onchange="payment(this.id)"/>Google Pay
</div>
<div style=" display: flex;">
    <input type="checkbox" id="paynow" onchange="payment(this.id)"/>PayNow/ Pay!Lah
</div>
    <hr style="  border-top: 3px solid #888; border-radius: 5px; margin: 5% 5% 5% 0%;">
    <h4>Subtotal:</h4>
    <div style="display: flex;">
    <div>
      Item total:<br>Delivery fee:<br>GST (8%):<br>Total:
    </div>
    <div style="position: relative;left: 50%;">
    $<?php echo $itemtotal; ?><br>$<?php echo $deliveryfee; ?><br>$<?php echo $gst; ?><br>$<?php echo $totalprice; ?><br>
      
    </div>
  </div>
  <hr style="  border-top: 3px solid #888; border-radius: 5px; margin: 5% 5% 1% 0%;">
  <form id="checkoutForm" action="success.php" method="post"> <!-- email over here -->
    <center><input type="submit" id="loginButton" name="loginButton" value="Checkout"></center>
  </form>

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

function payment(x) {
switch (x) {
    case 'credit':
    document.getElementById("paypal").checked = false;
    document.getElementById("googlepay").checked = false;
    document.getElementById("paynow").checked = false;
    break;
    case 'paypal':
    document.getElementById("credit").checked = false;
    document.getElementById("googlepay").checked = false;
    document.getElementById("paynow").checked = false;
    break;
    case 'googlepay':
    document.getElementById("paypal").checked = false;
    document.getElementById("credit").checked = false;
    document.getElementById("paynow").checked = false;
    break;
    case 'paynow':
    document.getElementById("paypal").checked = false;
    document.getElementById("googlepay").checked = false;
    document.getElementById("credit").checked = false;
    break;
}
}


</script>

</html>