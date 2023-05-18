<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
   exit;
}

if (isset($_GET['logout'])) {
   unset($user_id);
   session_destroy();
   header('location:login.php');
   exit;
}

// Fetching order details from the database
$orderId = $_GET['order_id']; // Assuming you have an 'order_id' parameter in the URL
$query = "SELECT * FROM orders WHERE id = $orderId";
$result = mysqli_query($connection, $query);

if (!$result) {
   // Handle error if the query fails
   // You can redirect the user to an error page or display an error message
   die("Query failed: " . mysqli_error($connection));
}

$row = mysqli_fetch_assoc($result);

$total_amount = $row['total_amount'];
$payment_method = $row['payment_method'];
$shipping_address = $row['shipping_address'];

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Confirmation</title>

   <!-- Link to your CSS file -->
   <link rel="stylesheet" href="confirmation.css">

</head>
<body>
   
   <div class="container">
      <h1>Order Confirmation</h1>
      <div class="confirmation-details">
         <h2>Thank you for your order!</h2>
         <p>Total Amount: ₱<?php echo $total_amount; ?></p>
         <p>Payment Method: <?php echo $payment_method; ?></p>
         <p>Shipping Address: <?php echo $shipping_address; ?></p>
         <p>We have received your order details and will process it shortly.</p>
         <p>An email with the order summary will be sent to you.</p>
      </div>

      <div class="back-to-home">
         <a href="index.php">Back to Home</a>
      </div>
   </div>

</body>
</html>
