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
  header('location:login.php');
};

if(isset($_POST['add_to_cart'])){

  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_image = $_POST['product_image'];
  $product_quantity = $_POST['product_quantity'];
  $product_size = $_POST['product_size'];

  $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

  if(mysqli_num_rows($select_cart) > 0){
    $message[] = 'product already added to cart!';
  }else{
    mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity, size) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity', '$product_size')") or die('query failed');
    $message[] = 'product added to cart!';
  }

};
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>pang bitches</title>
  <link rel="stylesheet" href="women.css">
</head>
<body>
<?php include 'header1.php'; ?>
  <!-- Hero section -->
  <section class="hero">
    <h1>Shop Women's Fashion</h1>
    <p>Find your perfect style and look great from head to toe.</p>
  </section>

  <!-- Products section -->
  <section class="products">
    <h2>New Arrivals</h2>
    <div class="product-container">
    <?php
    $select_product =mysqli_query($conn, "SELECT * FROM `women_products`") or die('query failed');

    if (mysqli_num_rows($select_product) > 0) {
    while($fetch_product = mysqli_fetch_assoc($select_product)) {
    ?>

    <form method="post" class="product" action="">
      <img src="IMG/<?php echo $fetch_product['image']; ?>" alt="">
      <h3><?php echo $fetch_product['name']; ?></h3>
      <p>₱<?php echo $fetch_product['price']; ?></p>
      <label for="product_size">Size:</label>
      <select name="product_size" id="product_size">
        <option value="6">6</option>
        <option value="6.5">6.5</option>
        <option value="7">7</option>
    <!-- add more options for other sizes -->
      </select>
      <br>
      <br>
      <label for="product_quantity">Quantity:</label>
      <input type="number" min="1" name="product_quantity" value="1">
      <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
      <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>"><br><br>
      <input type="submit" value="add to cart" name="add_to_cart" class="button">
    </form>
        <?php
    }
  } else {
    echo "No products found.";
  }
  ?>
      </div>
      
  </section>

  <!-- Footer section -->
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


