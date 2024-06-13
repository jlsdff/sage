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

    <section class="px-8 py-4 sm:px-24 sm:py-16">

      <!-- TABLE HEADER -->
      <form action="basket.php" method="post" class="table w-full">
        <div class="table-header-group">
          <div class="table-row">
            <div class="table-cell text-left font-bold  ">
              <!-- <div class="w-16 border border-2"></div> -->
            </div>
            <div class="table-cell text-left font-bold ">Product</div>
            <div class="table-cell text-left font-bold ">Unit Price</div>
            <div class="table-cell text-left font-bold ">Quantity</div>
            <div class="table-cell text-left font-bold ">Total Price</div>
            <div class="table-cell text-left font-bold ">Actions</div>
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
            <div class='table-cell align-middle text-left'><input type='checkbox' name='include' id=''></div>
            <div class='table-cell align-middle text-left'>
              <div class='flex items-center justify-start gap-2 min-w-60'>
                <div class='object-contain w-32 aspect-square'>
                  <img class='' src='{$product_image}' alt=''>
                </div>
                <h2>{$product_name}</h2>
              </div>
            </div>
            <div class='table-cell align-middle text-left  '>
              <span class='__product_price'>₱{$product_price}</span>
            </div>
            <div class='table-cell align-middle text-left '>
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
            <div class='table-cell align-middle text-left __total_price'> </div>
            <div class='table-cell align-middle text-left '> <button type='submit' name='delete' value='{$id}'>Delete</button> </div>
          </div>
            ";
          }
          ?>

          <!-- Table Row Template -->
          <!-- <div class="table-row">
            <div class="table-cell align-middle text-left"><input type='checkbox' name='include' id=''></div>
            <div class="table-cell align-middle text-left">
              <div class='flex items-center justify-start gap-2 min-w-60'>
                <div class='object-contain w-32 aspect-square'>
                  <img class='' src='{$product_image}' alt=''>
                </div>
                <h2>Veggie Bag</h2>
              </div>
            </div>
            <div class="table-cell align-middle text-left  ">
              <span>₱500</span>
            </div>
            <div class="table-cell align-middle text-left ">
              <div class='flex items-center justify-start gap-2'>
                <button class='' name='decrement' type='submit' value='{$id}'><svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                  </svg></button>
                <span class='text-lg'>1</span>
                <button class='' name='increment' type='submit' value='{$id}'><svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                  </svg></button>
              </div>
            </div>
            <div class="table-cell align-middle text-left "> ₱500 </div>
            <div class="table-cell align-middle text-left "> <button type='submit' name='delete' value='{$id}'>Delete</button> </div>
          </div> -->
          <!-- Table Row Template -->
        </div>
      </form>

      <div class="w-full flex justify-center">
          <button  >
            Check out
          </button>
        </div>


    </section>

  </main>
  <script src="../js/basket.js"></script>
</body>

</html>