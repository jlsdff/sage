<?php

session_start();
include '../Welcome-content/db.php';
include '../utils/cart.php';

if (isset($_POST['increment'])) {
  $id = $_POST['increment'];
  incrementItemCart($id);
}

if (isset($_POST['decrement'])) {
  $id = $_POST['decrement'];
  decrementItemCart($id);
}

if(isset($_POST['delete'])){
  $id = $_POST['delete'];
  deleteItemCart($id);
}

$minus = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
<path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
</svg>
';
$plus = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
</svg>
';


$user_id = $_SESSION['user_id'];

// $carts = $conn->query("SELECT * FROM cart WHERE user_id=$user_id ");

$query = "SELECT cart.*, products.name, products.price, products.image 
FROM cart
JOIN products ON cart.product_id = products.id
WHERE cart.user_id = $user_id
";

$carts = $conn->query($query);

if ($carts->num_rows > 0) {

  // while ($product = $carts->fetch_array()) {
  //   echo "<br>";
  //   echo $product['name'];
  //   echo "<br>";
  //   echo $product['price'];
  //   echo "<br>";
  //   echo $product['quantity'];
  //   echo "<br>";
  // }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Basket</title>
  <link rel="stylesheet" href="../css/output.css">
</head>

<body>

  <header>
    <?php include '../header-product.php'; ?>
  </header>

  <main>
    <section class="flex items-center justify-center">
      <form action="basket.php" method="post">
        <table class="table-fixed">
          <thead class="text-xl">
            <tr>
              <th>
                <div class="p-2"></div>
              </th>
              <th>Product</th>
              <th>Unit Price</th>
              <th>Quantity</th>
              <th>Total Price</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($product = $carts->fetch_array()) {
              $id = $product['id'];
              $product_id = $product['product_id'];
              $product_name = $product['name'];
              $product_price = $product['price'];
              $product_image = 'data:image/jpeg;base64,' . base64_encode($product['image']);
              $product_quantity = $product['quantity'];

              echo "
                <tr class='mt-2 __item'>
              <td><input type='checkbox' name='include' id=''></td>
              <td>
                <div class='flex items-center justify-start gap-2'>
                  <div class='object-contain w-32 aspect-square'>
                    <img class='' src='{$product_image}' alt=''>
                  </div>
                  <h2>{$product_name}</h2>
                </div>
              </td>
              <td class='__product_price'>₱{$product_price}</td>
              <td> 
                <div class='flex items-center justify-center gap-2'>
                  <button class='' name='decrement' type='submit' value='{$id}'>{$minus}</button> 
                  <span class='text-lg'>{$product_quantity}</span> 
                  <button class='' name='increment' type='submit' value='{$id}'>{$plus}</button> 
                </div> 
              </td>
              <td class='__total_price'>₱</td>
              <td> <button type='submit' name='delete' value='{$id}'>Delete</button> </td>
            </tr>
            ";
            }
            ?>
            <!-- sample -->
            <tr class='mt-2'>
              <td><input type='checkbox' name='include' id=''></td>
              <td>
                <div class='flex items-center justify-start gap-2'>
                  <div class='object-contain w-32 aspect-square'>
                    <img class='' src='{$product_image}' alt=''>
                  </div>
                  <h2>{$product_name}</h2>
                </div>
              </td>
              <td>₱{$product_price}</td>
              <td>
                <div class='flex items-center justify-center gap-2'>
                  <button class='' type='submit' value='decrement'>{$minus}</button>
                  <span class='text-lg'>{$product_quantity}</span>
                  <button class='' type='submit' value='decrement'>{$plus}</button>
                </div>
              </td>
              <td id='total-price'>₱</td>
              <td><input type='submit' name='delete' value='Delete'></td>
            </tr>
            <!-- sample -->
          </tbody>
        </table>
      </form>
    </section>
  </main>
  <script src="../js/basket.js"></script>
</body>

</html>