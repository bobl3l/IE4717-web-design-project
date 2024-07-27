<?php
session_start();

include 'database\config.php';
if (!isset($_SESSION['cart'])){
  $_SESSION['cart'] = [];
}

$sql = "SELECT * FROM items WHERE category_id = '2'";
$result = $conn->query($sql);
$items = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
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
<link rel="stylesheet" href="style.css">
<style>
.items-container {
  width: 70%;
display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    padding: 10%;
}
</style>

</head>

<body>
    <div id="navbar">
        <nav>
            <ul>
                <li><a href="home.php" >Home</a></li>
                <li><a href="top_listing.php">Tops</a></li>
                <li><a href="">Pants</a></li>
                <li><a href="shoe_listing.php" class="active">Shoes</a></li>
                <li><a href="">Accessories</a></li>            
            </ul>
            <img src="graphics/logo.png"/>
            
        </nav>
        <div class="nav-right">
        <?php 
        if (isset($_SESSION['username'])) {
            echo '<a href="profile.php"><i class="fa fa-id-card-o" style="font-size: 30px; padding-right: 10px; color: #000;"></i></a>';
        } else {
            echo '<a href="login.html"><i class="fa fa-user" style="font-size: 30px; padding-right: 10px; color: #000;"></i></a>';
        }
        ?>
        <?php
        if (isset($_SESSION['username'])) {
          echo '<a href="cart.php"><i class="fa fa-shopping-cart" style="font-size: 30px;"></i></a>';
        } else {
          //nothing
        }
        ?>
        </div>
    </div>
  <div class="items-container">
        <?php foreach($items as $item): ?>
          <div id="item" onclick="showProductDetails('<?php echo $item['id']; ?>', '<?php echo addslashes($item['name']); ?>', '<?php echo $item['price']; ?>', '<?php echo addslashes($item['description']); ?>','<?php echo addslashes($item['image_url']); ?>','<?php echo addslashes($item['hover_image_url']); ?>')">
                <center>

                    <img src="<?php echo $item['image_url']; ?>" 
                        onmouseover="this.src='<?php echo $item['hover_image_url']; ?>';" 
                        onmouseleave="this.src='<?php echo $item['image_url']; ?>';" 
                    />
                    <h4><?php echo $item['name']; ?></h4>
                    <h5 style="color: red;">
                       $ <?php echo $item['price']; ?>
                    </h5>
                </center>

            </div>
        <?php endforeach; ?>
  </div>
  <div class="form-popup" id="myForm">
  <form action="" class="form-container">
              <div style="float: right;"onclick="closeForm()"><i class="fa fa-window-close" style="font-size: 30px;"></i></div>
                <div style="height: 75%;max-height: 75%;">
                    <div style="width: 50%;float: left;">
                    <center>
                      <img class="display-img" id="display-img"/><br>
                      <img class="img-button" id="img1" onclick="displayIMG(this.id)"/>
                      <img class="img-button" id="img2"  onclick="displayIMG(this.id)"/>
                    </center>
                    </div>
                  <div style="float: left;width: 50%;">
                        <h1 id="title"></h1>
                        <h3 id="price"></h3>
                        <h3>Size:</h3>
                        <button class="cart-button" onclick="sizing()" id="XS">XS</button>
                        <button class="cart-button" onclick="sizing()" id="S">S</button>
                        <button class="cart-button" onclick="sizing()" id="M">M</button>
                        <button class="cart-button" onclick="sizing()" id="L">L</button>
                        <button class="cart-button" onclick="sizing()" id="XL">XL</button><br>
                        <div style="margin-top: 4.5%; background-color: #f2f2f2;height: 30px;width:24%;border-radius: 5px;">
                        <button class="quantity-button" id='minus' onclick="changeQuantity(this.id)">-</button>
                        <input class="quantity-input"type="number" id="quantity" value="1" min="1"/>
                        <button class="quantity-button" id='plus' onclick="changeQuantity(this.id)">+</button>
                        </div>
                          <input type="submit" id="addToCart" name="addToCart" value="Add to cart" onclick="addToCart()">

                          <hr style="margin:3% 2%;border-bottom: 2px solid #bbb; width: 60%;">
                          <h3>Description:</h3>
                          <pre><h5 id="description"></h5></pre>
                  </div>
                </div>
                <hr style="margin:2% 0;border: 4px dotted #bbb; width: 99%;border-top: none;">
                <div style="margin: 2%;height: 20%;">
                  <center>
                    <h5>Related Products</h5>

                </center>
                </div>
                
            </form>
          </div>

  <form id="add-to-cart-form" action="database\add_cart.php" method="post" style="display:none;">
    <input type="hidden" name="product_id" id="item-id-field">
    <input type="hidden" name="quantity" value="1">
  </form>
          
    
  <footer>
    <center>
      <br/>
      <h2>FOLLOW US</h2><br/>
      <img src="graphics/ss icons.png"/>
      <h6>© copyright 2023. West Coast Collection. All rights reserved</h6>
  </center>
  </footer>
</body>

<script>
let cart = [];
let currentProductID;

function showProductDetails(productID, productName, productPrice, productDescription,img1,img2) {
  currentProductID = productID;

  document.getElementById("title").innerText = productName;
  document.getElementById("price").innerText = "$" + productPrice;
  document.getElementById("description").innerHTML = productDescription;
  document.getElementById("display-img").src = img1;
  document.getElementById("img1").src = img1;
  document.getElementById("img2").src = img2;

  let addToCartButton = document.querySelector(".form-container button.addToCart");
  openForm();
}

// function addToCart(productID, productName, productPrice) {
//     const item = {
//         id: productID,
//         name: productName,
//         price: productPrice,
//         quantity: parseInt(document.getElementById("quantity").value)
//     };
//     cart.push(item);
//     alert(productName + " has been added to the cart!");
//     updateCartDisplay();
//     closeForm();
// }

function addToCart() {
  let form = document.getElementById("add-to-cart-form");
  let itemID = document.getElementById("item-id-field");
  let quantity = document.getElementById("quantity");

  itemID.value = currentProductID;
  quantity.value = document.getElementById('quantity').value;

  form.submit();
} 


function openForm() {
      document.getElementById("myForm").style.display = "block";
    }
    function closeForm() {
      document.getElementById("myForm").style.display = "none";
    }
function updateCartDisplay() {
    document.getElementById('cart-count').innerText = cart.length;
}

function displayIMG(x){
switch(x){
  case 'img1': 
  document.getElementById("display-img").src=document.getElementById("img1").src;
  break;
  case 'img2': 
  document.getElementById("display-img").src=document.getElementById("img2").src;
  break;

}
}
</script>    
</html>
