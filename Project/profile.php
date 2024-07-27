<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}
include 'database\config.php';
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows>0){
  $user = $result->fetch_assoc();
} else {
  echo "Hey you sholdn't be here!";
}

if (isset($_POST['update'])){
  $newName = $_POST['fullname'];
  $newEmail = $_POST['email'];
  $newContact = $_POST['contact'];
  $newFulladdress = $_POST['fulladdress'];

  if(!empty($_POST['new-password'])) {
    $newPassword = $_POST['new-password'];
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $updateSql = "UPDATE users SET fullname='$newName', email='$newEmail', contact='$newContact', fulladdress='$newFulladdress', password='$hashedPassword' WHERE username='$username'";
  } else {
    $updateSql = "UPDATE users SET fullname='$newName', email='$newEmail', contact='$newContact', fulladdress='$newFulladdress' WHERE username='$username'";
  }
  if ($conn->query($updateSql) == TRUE){
    header("Location: profile.php?message=Your profile has been updated!");
    exit;
  } else {
    echo "Error: " . $updateSql . "<br>" . $conn->error;
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
    <div id="navbar">
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="top_listing.php">Tops</a></li>
                <li><a href="">Pants</a></li>
                <li><a href="shoe_listing.php">Shoes</a></li>
                <li><a href="">Accessories</a></li>            
            </ul>
            <img src="graphics/logo.png"/>
            
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
          echo '<a href="cart.php"><i class="fa fa-shopping-cart" style="font-size: 30px;padding-right: 10px;"></i></a>';
        } else {
          echo '<a href="login.html"><i class="fa fa-shopping-cart" style="font-size: 30px;"></i></a>';
        }
        ?>
        <?php
        if (isset($_SESSION['username'])) {
          echo '<a href="logout.php"><i class="fa fa-sign-out" style="font-size: 30px;  color: #000;"></i></a>';
        }
        ?>
        </div>
    </div>
    <br>
    <br>
    <div id="profile-section">
        <!-- side nav -->
        <div class="side-nav">
            <div id="profile-image">
                <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar">
            </div>
            <button>Your Details</button>
        </div>
        <div class="vl"></div>
        <div id="user-details">
            <h1>Welcome, <?php echo $user['username']; ?>!</h1>
            <div style="display: inline-block;">
                <div style="float: left;">
                    <h4>Username:</h4> <h4>Password:</h4><h4>Full Name:</h4><h4>Email:</h4><h4>Contact Number:</h4><h4 style="margin-bottom: 75%;">Full Address:</h4>
                </div>
                <div style="margin-left: 20%;">
                <form method="post" action="profile.php">
                      <input type="text" id="username" name="username" value="<?php echo $user['username'];?>" disabled>
                      <input type="text" id="password" name="new-password" placeholder="New Password. Leave it empty if you do not wish to update your password"> 
                      <input type="text" id="fullname" name="fullname" value="<?php echo $user['fullname']; ?>">
                      <input type="text" id="email" name="email" value="<?php echo $user['email']; ?>">
                      <input type="text" id="contact" name="contact" value="<?php echo $user['contact'];?>">
                      <textarea id="fulladdress" rows="4" wrap="soft" maxlength="400" name="fulladdress">
                        <?php echo $user['fulladdress'];?>
                      </textarea>
                      <button type="submit" class="actionbutton"name="update" style="background-color:#FFECA7">Save Changes</button>
                 </form>
                 <div id='update-message'></div>
                </div>
            </div>
        </div>

    </div>

<script>
  const urlParams = new URLSearchParams(window.location.search);
  const message = urlParams.get('message');
  if (message) {
    document.getElementById('update-message').textContent = message;
  }   

 
</script>

</body>

</html>
