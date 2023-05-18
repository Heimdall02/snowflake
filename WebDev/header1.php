
<style>
body {
    font-family: Arial, sans-serif;
    color: #333;
    background-color: #f5f5f5;
  }

.home-header {
   display: flex;
   align-items: center;
   background-color: #333;
   color: #fff;
   padding: 20px;
}

.logo img {
   width: 50px;
   height: auto;
}

.navigation {
   flex-grow: 1;
   text-align: center;
}

.navigation ul {
   list-style-type: none;
   margin: 0;
   padding: 0;
}

.navigation ul li {
   display: inline;
   margin-right: 20px;
}

.navigation ul li a {
   color: #fff;
   text-decoration: none;
}

.header-buttons {
   margin-left: auto;
}

.cart-button,
.logout-button {
   color: #fff;
   text-decoration: none;
   margin-left: 10px;
}

.cart-button:hover,
.logout-button:hover {
   color: #ff8c00;
}


</style>
<?php

include 'config.php';

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
  header('location:login.php');
};

if(isset($_GET['logout'])){
  unset($user_id);
  session_destroy();
  header('location:login.php');
};
?>
<header class="home-header">
   <div class="logo">
      <img src="IMG/samplelogo.jpg" alt="Logo">
   </div>
   <div class="navigation">
      <ul>
        <li><a href="index1.php">Home</a></li>
        <li><a href="women.php">Women</a></li>
        <li><a href="men.php">Men</a></li>
        <li><a href="kids.php">Kids</a></li>
      </ul>
   </div>
   <?php
          $select_user = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
          if(mysqli_num_rows($select_user) > 0){
          $fetch_user = mysqli_fetch_assoc($select_user);
          };
        ?>
        <a href="cart.php" class="button">Cart</a>
        <a href="login.php?logout=<?php echo $user_id; ?>" onclick="return confirm('are your sure you want to logout?');" class="button">logout</a>
</header>
