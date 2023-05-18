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
};

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = 'cart quantity updated successfully!';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   header('location:cart.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cart</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="cart.css">

</head>
<header>
    <img src="IMG/samplelogo.jpg" alt="My Shoe Company Logo" width="3%" height="3%">
      <nav>
        <ul>
          <li><a href="index1.php">Home</a></li>
          <li><a href="men.php">Men</a></li>
          <li><a href="women.php">Women</a></li>
          <li><a href="kids.php">Kids</a></li>
        </ul>
      </nav>
      <a></a>
    </header>
<body>
<br>
<div class="shopping-cart">
   <table>
      <thead>
         <th>image</th>
         <th>name</th>
         <th>price</th>
         <th>size</th>
         <th>quantity</th>
         <th>total price</th>
         <th>action</th>
      </thead>
      <tbody>
      <?php
         $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         $grand_total = 0;
         if(mysqli_num_rows($cart_query) > 0){
            while($fetch_cart = mysqli_fetch_assoc($cart_query)){
      ?>

         <tr>
            <td><img src="IMG/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td>₱<?php echo $fetch_cart['price']; ?></td>
            <td><?php echo $fetch_cart['size']; ?></td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                  <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                  <input type="submit" name="update_cart" value="update" class="update">
               </form>
            </td>
            <td><?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></td>
            <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" class="remove" onclick="return confirm('remove item from cart?');">remove</a></td>
         </tr>
         
      <?php
         $grand_total += $sub_total;
            }
         }else{
            echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no item added</td></tr>';
         }
      ?>
      <tr class="table-bottom">
         <td colspan="4">Total :</td>
         <td>₱<?php echo $grand_total; ?></td>
         <td><a href="checkout.php" class="checkout <?php echo ($grand_total > 1)?'':'disabled'; ?>">Checkout</a></td>
      </tr>
   </tbody>
   </table>

</div>

</div>



</body>
</html>