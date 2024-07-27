<?php
session_start();
include 'database\config.php';

if (isset($_SESSION['message'])) {
  echo "<div class='welcome-message'>Welcome, " . $_SESSION['username'] . "!</div>";
  unset($_SESSION['message']);
}

if (isset($_COOKIE['logout_message'])) {
  echo "<div class='notification-message'>" . $_COOKIE['logout_message'] . "</div>";
  setcookie("logout_message", "", time() - 3600, "/");
}
include 'database\config.php';


$sql = "SELECT * FROM items WHERE promoprice IS NOT NULL";
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
<div id="navbar">
    <nav>
        <ul>
            <li><a href="" class="active">Home</a></li>
            <li><a href="top_listing.php">Tops</a></li>
            <li><a href="">Pants</a></li>
            <li><a href="shoe_listing.php">Shoes</a></li>
            <li><a href="">Accessories</a></li>            
        </ul>
        <img src="graphics/logo.png"/>
        
    </nav>
  <div class="nav-right">
        <!-- <a href="login.html"><i class="fa fa-id-card-o" style="font-size: 30px; padding-right: 10px; color: #000;" ></i></a> -->
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
<br/>

<img src="graphics/welcome post.png" width="90%" style="padding: 5%"/>
<br/>
<div class="marquee">
    <div class="marquee__group">
       <img src="graphics/marquee component.png"  width="120px", style="padding: 0 80px ;"/>BACK TO SCHOOL SALES!!!
        <img src="graphics/marquee component.png"  width="120px", style=" padding: 0 80px ;"/>UP TO 60% OFF!!!
        <img src="graphics/marquee component.png"  width="120px", style=" padding: 0 80px ;"/>COME CHECK US OUT!!!    
      
    </div>
  <div class="marquee__group" aria-hidden="true">
       <img src="graphics/marquee component.png"  width="120px", style="padding: 0 80px ;"/>BACK TO SCHOOL SALES!!!
        <img src="graphics/marquee component.png"  width="120px", style=" padding: 0 80px ;"/>UP TO 60% OFF!!!
        <img src="graphics/marquee component.png"  width="120px", style=" padding: 0 80px ;"/>COME CHECK US OUT!!!    
    </div>
</div>
<br/>
<div id="maincategory">
  <ul>
    <li><a href="top_listing.php"><div id="mainpagecategory" style="background-image: url(graphics/tops.png);">
      <h1 style="padding-right: 10px; padding-top: 10px;margin-top: 5px;">TOPS</h1>
    </div></a></li>
    <li><div id="mainpagecategory" style="background-image: url(graphics/pants.png);">
      <h1 style="padding-top: 80%;  padding-right: 10px;position: absolute;">PANTS</h1>
    </div></li>
    <li><a href="shoe_listing.php"><div id="mainpagecategory" style="background-image: url(graphics/shoes.png);">
      <h1 style="padding-right: 100px; padding-top: 5px;margin-top: 5px;position: absolute;">SHOES</h1>
    </div></a></li>
    <li><div id="mainpagecategory" style="background-image: url(graphics/accessories.png);">
      <h1 style="padding-top: 80%;position: absolute;">ACCESSORIES</h1>
    </div></li>
  </ul>
</div>
<br/>
<center><h1 style="font-family: 'Bigshot One'; font-size:40px">-&#160;Promotions&#160;-</h1>
<br/>
<div class="home-items-container">
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
                    <h5>$<?php echo $item['price']; ?> </h5>;
                    <?php } ?>
            </div>
        <?php endforeach; ?>
  </div>


  <form id="cartform" action="add_cart.php" method="post" style="display:none;">
    <input type="hidden" name="product_id" id="item-id-field">
    <input type="hidden" name="quantity" value="1">
  </form>
 
    
<br/>

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
</script>

</html>