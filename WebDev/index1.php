<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:index.php');
};

?>
<!DOCTYPE html>
<html>
  <head>
    <title>My Shoe Store</title>
    <meta charset="UTF-8">
    <meta name="description" content="Shop the latest collection of shoes at My Shoe Store.">
    <meta name="keywords" content="shoes, footwear, fashion">
    <meta name="author" content="Your Name">
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xxWleQCvDeLw/qaBA3yJcREjY/JatvfyfDUOoJ6gB8lfxzcHwbvWLz8dnHql/3egzRYq1KjCGiH8dzcnLrN1NQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
  </head>
  <body>
    <?php include 'header1.php'; ?>

    <main>
      <br>
      <section class="hero">
      <h1>Welcome to Spectrum!</h1>
        <p>Shop the latest collection of shoes for you.</p>
        <a href="#" class="button">Shop Now</a>
      </section>
      <br>
      <br>
      <section class="heroM">
        <a href="men.php" class="button">Shop Now</a>
      </section>
      <br>
      <br>
      <section class="heroW">
        <a href="women.php" class="button">Shop Now</a>
      </section>
      <br>
      <br>
      <section class="heroK">
        <a href="kids.php" class="button">Shop Now</a>
      </section>

    </div>
  </section>
    </main>
    <br>
    <footer>
    <ul>
      <li><a href="about.php">About Us</a></li>
      <li><a href="contact.php">Contact Us</a></li>
      <li><a href="policy.php">Privacy Policy</a></li>
      <li><a href="terms.php">Terms & Conditions</a></li>
    </ul>
    <p>&copy; 2023 Shopper. All Rights Reserved.</p>
  </footer>
  </body>
</html>
