<?php
session_start();

include 'database\config.php';


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


</head>

<body>
<button onclick="topFunction()" id="upButton" title="Go to top"><i class="fa fa-chevron-up" style="font-size: 24px;"></i><br/>Top</button>
<form action="" method='post'>
<select id='sorting' name='sort' onchange="this.form.submit()" ><option value="--" selected>--</option>
<option value="default" >Default</option>
        <option value="price">Price(Low to high)</option>
        <option value="date">Release Date</option>
</select>
</form>
<?php
include 'database\config.php';
if(isset($_POST["sort"])){
    $sort=$_POST["sort"];
if ($sort=='price') {
    $sql = "SELECT * FROM items WHERE category_id = '2' ORDER BY price ASC";
} else if ($sort=='date') {
    $sql = "SELECT * FROM items WHERE category_id = '2' ORDER BY updated_at DESC";
} else if ($sort=='default') {
    $sql = "SELECT * FROM items WHERE category_id = '2' ORDER BY id ASC";
}
$result = $conn->query($sql);
$items = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

}
?>
    <div id="navbar">
        <nav>
            <ul>
                <li><a href="home.php" >Home</a></li>
                <li><a href="top_listing.php" >Tops</a></li>
                <li><a href="">Pants</a></li>
                <li><a href="shoe_listing.php" class="active">Shoes</a></li>
                <li><a href="">Accessories</a></li>            
            </ul>
            <img src="graphics/logo.png"/>
            
        </nav>
        <div class="nav-right">
        <?php 
        if (isset($_SESSION['username'])) {
          if ($_SESSION['role'] == 'admin'){
            echo '<a href="admin.php"><i class="fa fa-user-plus" style="font-size: 30px; padding-right: 10px; "></i></a>';
          } else {
            echo '<a href="profile.php"><i class="fa fa-id-card-o" style="font-size: 30px; padding-right: 8px; "></i></a>';
          }
        } else {
            echo '<a href="login.html"><i class="fa fa-user" style="font-size: 30px; padding-right: 10px; "></i></a>';
        }
        ?>
        <?php
        if (isset($_SESSION['username'])) {
          if ($_SESSION['role'] == 'admin'){
            echo '<a href="logout.php"><i class="fa fa-sign-out" style="font-size: 30px;  "></i></a>';
          } else {
            echo '<a href="cart.php"><i class="fa fa-shopping-cart" style="font-size: 30px; padding-right: 10px; "></i></a>';
            echo '<a href="logout.php"><i class="fa fa-sign-out" style="font-size: 30px;  "></i></a>';
          }
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
                    <?php if ($item['promoprice']!=NULL) {?>
                    <h5 style="color: red;"><s style="color: #513F3A;">$<?php echo $item['price']; ?></s>&nbsp; $<?php echo $item['promoprice']; ?> </h5>
                    <?php }
                    else {?>
                    <h5>$<?php echo $item['price']; ?> </h5>
                    <?php } ?>
                </center>

            </div>
        <?php endforeach; ?>
  </div>
  <div class="form-popup" id="myForm">
  <form  id="cartform" action="add_cart.php" method="post" class="form-container">
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
                        <input type="hidden" name="size" id="size" value='S'>
                        <input type="hidden" name="product_id" id="item-id-field">
                        <button type="button" class="size-button" onclick="sizing(this.id)" id="XS">XS</button>
                        <button type="button" class="size-button" onclick="sizing(this.id)" id="S">S</button>
                        <button type="button" class="size-button" onclick="sizing(this.id)" id="M">M</button>
                        <button type="button" class="size-button" onclick="sizing(this.id)" id="L">L</button>
                        <button type="button" class="size-button" onclick="sizing(this.id)" id="XL">XL</button><br>
                        <div style="margin: 4% 0; background-color: #f2f2f2;height: 30px;padding:10px;width:25%;border-radius: 5px;"><center>
                        <button type="button" class="quantity-button" id='minus' onclick="changeQuantity(this.id)">-</button>
                        <input class="quantity-input"type="number" id="quantity" name="quantity"  value="1" min="1"/>
                        <button type="button" class="quantity-button" id='plus' onclick="changeQuantity(this.id)">+</button></center>
                        </div>
                          <input type="button" id="addToCart" name="addToCart" value="Add to cart" onclick="addProductToCart()">
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

function showProductDetails(productID, productName, productPrice, productDescription,img1,img2) {
  document.getElementById("title").innerText = productName;
  document.getElementById("price").innerText = "$" + productPrice;
  document.getElementById("description").innerHTML = productDescription;
  document.getElementById("display-img").src = img1;
  document.getElementById("img1").src = img1;
  document.getElementById("img2").src = img2;
  document.getElementById("item-id-field").value = productID;
  // alert("Product ID: " + productID + "\nProduct Name: " + productName + "\nProduct Price: " + productPrice + "\nProduct Description: " + productDescription);
  let addToCartButton = document.querySelector(".form-container button.addToCart");
  openForm();
}

function addProductToCart() {
  // alert("Item has been added to cart!");
  var productId = document.getElementById("item-id-field").value;
  var size = document.querySelector("[name='size']").value;
  var quantity = document.querySelector("[name='quantity']").value;

  alert("Item ID: " + productId + "\nSize: " + size + "\nQuantity: " + quantity + "\nItem has been added to cart!");

  document.getElementById("cartform").submit();
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
let mybutton = document.getElementById("upButton");

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 10 || document.documentElement.scrollTop > 10) {
    mybutton.style.display = "block";
    
  } else {
    mybutton.style.display = "none";
  }
}

function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
  function changeQuantity(x) {
  var quantity = document.getElementById("quantity");
  if (x=='minus' && quantity.value>1) {
    quantity.value--;
  } else if (x=='plus') {
    quantity.value++;
  }
}
function sizing(x) {
switch (x) {
    case 'XS':
    document.getElementById("S").focus = false;
    document.getElementById("M").focus = false;
    document.getElementById("L").focus = false;
    document.getElementById("XL").focus = false;
    document.getElementById("size").value = "XS";
    break;
    case 'S':
    document.getElementById("S").focus = false;
    document.getElementById("M").focus = false;
    document.getElementById("XS").focus = false;
    document.getElementById("XL").focus = false;
    document.getElementById("size").value = "S";
    break;
    case 'M':
    document.getElementById("S").focus = false;
    document.getElementById("M").focus = false;
    document.getElementById("XS").focus = false;
    document.getElementById("XL").focus = false;
    document.getElementById("size").value = "M";
    break;
    case 'L':
    document.getElementById("S").focus = false;
    document.getElementById("M").focus = false;
    document.getElementById("XS").focus = false;
    document.getElementById("XL").focus = false;
    document.getElementById("size").value = "L";
    break;
    case 'XL':
    document.getElementById("S").focus = false;
    document.getElementById("M").focus = false;
    document.getElementById("L").focus = false;
    document.getElementById("XS").focus = false;
    document.getElementById("size").value = "XL";
    break;
}
}
</script>    
</html>
