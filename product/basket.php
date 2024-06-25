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

if(isset($_POST['checkout'])){

  // Redirect to checkout.php together with the selected products
  header('Location: checkout.php?products=' . implode(',', $_POST['products']));

}

if (isset($_POST['delete'])) {
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
    
    <?php 
    
    if($carts->num_rows == 0){
      echo "<input type='text' id='num_rows' value='true' class='hidden' >";
    }
    ?>

    <!-- No Items -->
    <div id="no_item" class="flex items-center justify-center hidden h-screen">
      <h1 class="text-2xl font-bold text-center text-red-500"> Basket is empty 😭 </h1>
    </div>

    <section id="basket_table" class="px-8 py-4 sm:px-24 sm:py-16">

      <!-- TABLE HEADER -->
      <form action="basket.php" method="post" class="relative table w-full">
        <div class="table-header-group">
          <div class="table-row">
            <div class="table-cell font-bold text-left ">
              <!-- <div class="w-16 border border-2"></div> -->
            </div>
            <div class="table-cell font-bold text-left ">Product</div>
            <div class="table-cell font-bold text-left ">Unit Price</div>
            <div class="table-cell font-bold text-left ">Quantity</div>
            <div class="table-cell font-bold text-left ">Total Price</div>
            <div class="table-cell font-bold text-left ">Actions</div>
          </div>
        </div>

        <!-- Table Body -->
        <div class="table-row-group spacing-y-2 ">
          <?php
          
          while ($product = $carts->fetch_array()) {
            
            $id = $product['id'];
            $product_id = $product['product_id'];
            $product_name = $product['name'];
            $product_price = $product['price'];
            $product_image = 'data:image/jpeg;base64,' . base64_encode($product['image']);
            $product_quantity = $product['quantity'];

            echo "
            <div class='table-row __item'>
            <div class='table-cell text-left align-middle'><input type='checkbox' name='products[]' value='{$product_id}' id='' data-checkbox></div>
            <div class='table-cell text-left align-middle'>
              <div class='flex items-center justify-start gap-2 min-w-60'>
                <div class='object-contain w-32 aspect-square'>
                  <img class='' src='{$product_image}' alt=''>
                </div>
                <h2>{$product_name}</h2>
              </div>
            </div>
            <div class='table-cell text-left align-middle '>
              <span class='__product_price'>₱{$product_price}</span>
            </div>
            <div class='table-cell text-left align-middle '>
              <div class='flex items-center justify-start gap-2'>
                <button class='' name='decrement' type='submit' value='{$id}'><svg xmlns='http://www.w3.org/2000/svg'
                    fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6'>
                    <path stroke-linecap='round' stroke-linejoin='round' d='M5 12h14' />
                  </svg></button>
                <span class='text-lg __product_quantity'>{$product_quantity}</span>
                <button class='' name='increment' type='submit' value='{$id}'><svg xmlns='http://www.w3.org/2000/svg'
                    fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6'>
                    <path stroke-linecap='round' stroke-linejoin='round' d='M12 4.5v15m7.5-7.5h-15' />
                  </svg></button>
              </div>
            </div>
            <div class='table-cell text-left align-middle __total_price'> </div>
            <div class='table-cell text-left align-middle '> <button type='submit' name='delete' value='{$id}'>Delete</button> </div>
          </div>
            ";
          }
          ?>
        </div>

        <div class="absolute left-1/2 top-full">
          <button id="checkout_button" type="submit" name="checkout" class="px-5 py-2.5 bg-primary-200 text-white rounded-md disabled:bg-gray-500 disabled:text-gray-100 disabled:cursor-not-allowed " disabled="true">
            Check out
          </button>
        </div>

      </form>



    </section>

  </main>
  <script src="../js/basket.js"></script>
</body>

</html>