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
      <h1>Thank You For Your Order!</h1>
      <div class="back-to-home">

         <a href="index1.php">Back to Home</a>
      </div>
   </div>

</body>
</html>
