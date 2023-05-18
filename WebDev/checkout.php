<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
   exit();
}

if (isset($_POST['checkout'])) {
   // Retrieve and validate form data
   $name = $_POST['name'];
   $contact = $_POST['contact'];
   $payment_method = $_POST['payment_method'];
   $shipping_address = $_POST['shipping_address'];

   // Insert order details into the database
   $insert_query = "INSERT INTO orders (user_id, order_date, name, contact, payment_method, shipping_address, status) VALUES ('$user_id', NOW(), '$name', '$contact', '$payment_method', '$shipping_address', 'Pending')";
   mysqli_query($conn, $insert_query) or die('Query failed');

   // Clear the cart after successful checkout
   $delete_query = "DELETE FROM cart WHERE user_id = '$user_id'";
   mysqli_query($conn, $delete_query) or die('Query failed');

   // Redirect to confirmation page
   header('location:confirmation.php');
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="checkout.css">

</head>
<body>

   <header>
      <img src="IMG/logo.png" alt="Logo">
      <nav>
         <ul>
            <li><a href="index1.php">Home</a></li>
            <li><a href="women.php">Women</a></li>
            <li><a href="men.php">Men</a></li>
            <li><a href="kids.php">Kids</a></li>
         </ul>
      </nav>
   </header>

   <div class="checkout-form">
      <h2>Checkout</h2>
      <form method="POST" action="">
         <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
         </div>
         <div class="form-group">
            <label for="address">Complete Address:</label>
            <textarea id="address" name="shipping_address" required></textarea>
         </div>
         <div class="form-group">
            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" required>
         </div>
         <div class="form-group">
            <span>payment method</span>
            <select name="payment_method">
               <option value="Cash on Delivery" selected>Cash on Devlivery</option>
               <option value="Credit Card">credit card</option>
               <option value="Gcash">Gcash</option>
            </select>
         </div>
         <button type="submit" name="checkout" class="button">Checkout</button>
      </form>
   </div>

</body>
</html>
