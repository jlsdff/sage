<?php

session_start();
include '../Welcome-content/db.php';
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
  echo "Please login to like this product";
}


if(isset($_POST['unlike'])){

  $conn->query("DELETE FROM likes WHERE product_id = {$_POST['unlike']} AND user_id = $user_id");
  
}



$query = "SELECT products.*, likes.user_id as liked FROM products LEFT JOIN likes ON products.id = likes.product_id WHERE likes.user_id = $user_id";

$products = $conn->query($query);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Likes</title>
  <link rel="stylesheet" href="../css/output.css">
</head>

<body>

  <header>
    <?php include '../header-product.php' ?>
  </header>

  <main>

    <section class="grid p-8 grid-cols-1sm:grid-cols-2 md:grid-cols-4 place-items-stretch gap-y-4">

      <?php

      while ($product = $products->fetch_array()) {

        $name = $product['name'];
        $product_id = $product['id'];
        $price = $product['price'];
        $product_image = 'data:image/jpeg;base64,' . base64_encode($product['image']);

        echo "<div class='flex flex-col justify-between max-w-xs gap-2 '>
        <div class='w-full rounded-md'>
          <img src='{$product_image}' alt='pics' class='rounded-md'>
        </div>

        <div>
        <div class='text-center'>
          <h2 class='text-lg font-bold'>{$name}</h2>
          <h3 class='text-base '>Author</h3>
        </div>
        <form method='post' action='likes.php' class='flex items-center justify-center '>
          <button type='submit' name='unlike' value='{$product_id}'>
            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' class='cursor-pointer size-6 fill-primary-100 '>
              <path
                d='m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z' />
            </svg>
          </button>
        </form>
        </div>
        
      </div>";
      }

      ?>


    </section>

  </main>

</body>

</html>

<!-- PRODUCT TEMPLATE -->
<!-- 
<div class="flex flex-col max-w-xs ">
        <div class="">
          <img src="../WEBDEV_PICS/22.png" alt="pics">
        </div>
        <div class="text-center">
          <h2 class="text-lg font-bold">Product Name</h2>
          <h3 class="text-base ">Author</h3>
        </div>
        <form method="post" action="likes.php" class="flex items-center justify-center ">
          <button type="submit" value='id'>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="cursor-pointer size-6 fill-primary-100 ">
              <path
                d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
            </svg>
          </button>
        </form>
      </div> -->