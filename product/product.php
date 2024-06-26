<?php

include '../Welcome-content/db.php';

session_start();
$product_id = $_GET['id'];
$user_id = $_SESSION['user_id'];


if (empty($user_id)) {
  // TODO: REFACTOR THIS
  header('location:/sage/main-category/main_content.php');
}

if (empty($product_id)) {
  // redirect to main category if product id is not set
  header('location:/sage/main-category/main_content.php');
}

if (isset($_POST['buy'])) {
  $quantity = $_POST['quantity'];
  $conn->query("INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, $quantity)") or die($conn->error);
  header('Location: checkout.php?products=' . $product_id);
}

if (isset($_POST['like'])) {

  include '../utils/likes.php';

  $query = add_to_likes($product_id, $user_id);

}



$product = $conn->query("SELECT * FROM products WHERE id=$product_id");

// redirect to main category if product does not exist
if ($product->num_rows == 0) {
  header('location:/sage/main-category/main_content.php');
}

$product = $product->fetch_array();

$name = $product['name'];
$description = $product['description'];
$price = $product['price'];
$image = 'data:image/jpeg;base64,' . base64_encode($product['image']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Living</title>
  <link href="../css/output.css" rel="stylesheet" />
</head>

<body class="relative">
  <?php
  if (isset($_POST['basket'])) {
    $quantity = $_POST['quantity'];

    $query = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id ,$product_id, $quantity)";

    if ($conn->query($query) === TRUE) {
      echo '
      <div id="toaster"
      class="fixed flex justify-start w-64 gap-2 px-8 py-4 text-white transition-all duration-300 transform -translate-x-full border rounded-md opacity-0 bg-primary-100 bottom-16 left-16 border-neutral-500 ">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
          <path fill-rule="evenodd"
          d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
          clip-rule="evenodd" />
        </svg>
        <h2 class="text-lg font-bold">Added to basket</h2>
      </div>';
    } else {
      echo "Error: " . $query . "<br>" . $conn->error;
    }
  }
  ?>
  <div>
    <?php include '../header-product.php'; ?>
  </div>



  <main class="w-screen min-h-screen gap-4 px-8 py-4 sm:px-24 sm:py-16">
    <section class="flex flex-col items-center justify-center gap-4 sm:flex-row">
      <div class="relative w-full sm:w-80">
        <!--ambot--->
        <a href="../main-category/main_living.php" id="back-button"
          class="absolute top-0 w-8 cursor-pointer -left-9 sm:-left-20">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#3B5326" class="size-10">
            <path fill-rule="evenodd"
              d="M7.72 12.53a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 1 1 1.06 1.06L9.31 12l6.97 6.97a.75.75 0 1 1-1.06 1.06l-7.5-7.5Z"
              clip-rule="evenodd" />
          </svg>
        </a>
        <!--ambot sa imo Julius--->

        <img class="w-full" src="<?php echo $image; ?>" alt="" srcset="" />
      </div>

      <div class="flex flex-col justify-between w-full h-full gap-4 items-between sm:w-80">
        <div class="flex flex-col items-start justify-start">
          <div class="flex items-center justify-start gap-2">
            <h1 class="text-2xl font-bold text-primary-200">
              <?php echo $name; ?>
            </h1>
            <form action="product.php?id=<?php echo $product_id ?>" method="post" id="like_button"
              class="block cursor-pointer">
              <button type="submit" name="like" value="like">
                <svg xmlns="http://www.w3.org/2000/svg" fill="<?php
                $query = "SELECT * FROM likes WHERE user_id={$user_id} AND product_id={$product_id}";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                  echo "currentColor";
                } else {
                  echo "none";
                }
                ?>" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 <?php
                if ($result->num_rows > 0) {
                  echo "cursor-not-allowed opacity-50";
                }
                ?>">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
              </button>
            </form>
          </div>
          <span class="text-base font-bold">
            <span class="font-normal">by</span> Rupaul</span>
        </div>

        <div>
          <h2 class="text-6xl font-black text-primary-200">₱
            <?php echo $price; ?>
          </h2>
          <h3 class="text-primary-200">Product price</h3>
        </div>

        <form action="product.php?id=<?php echo $product_id; ?>" method="post">

          <div class="flex items-center justify-center gap-4">
            <button class="p-2" id="decrement" type="button">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" class="fill-primary-200"
                width="24px">
                <path d="M200-440v-80h560v80H200Z" />
              </svg>
            </button>

            <div class="flex flex-col items-center justify-center">
              <p class="text-2xl font-bold text-primary-200" id="quantity">1</p>
              <input type="number" name="quantity" id="quantity-input" class="hidden" value="1">
              <h3 class="text-xl font-bold text-primary-200">Quantity</h3>
            </div>
            <button class="p-2" id="increment" type="button">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" class="fill-primary-200"
                width="24px">
                <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
              </svg>
            </button>
          </div>

          <div class="flex items-center justify-between py-2">

            <?php

            $user_id = $_SESSION['user_id'];

            $query = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id";
            $is_in_cart = $conn->query($query);
            $is_in_cart = $is_in_cart->num_rows > 0;

            $class;
            if ($is_in_cart) {
              $class = "bg-primary-100";
            } else {
              $class = "";
            }

            ?>

            <button type="submit"
              class="px-4 py-2 font-bold text-white rounded-lg cursor-pointer bg-primary-100 disabled:opacity-50 disabled:cursor-not-allowed"
              id="add-to-basket" name="basket" value="add_to_basket" <?php
              if ($is_in_cart) {
                echo "disabled";
              }
              ?>>
              <?php
              if ($is_in_cart) {
                echo "Already in basket";
              } else {
                echo "Add to basket";
              }
              ?>
            </button>
            <button type="submit" class="px-4 py-2 font-bold text-white rounded-lg bg-primary-100" id="buy-now"
              name="buy" value="buy-now">
              Buy now
            </button>
          </div>

        </form>

      </div>
    </section>
    <section class="flex justify-center w-full py-4 mt-4">
      <div class="w-full sm:w-[40rem]">
        <h2 class="text-xl font-bold text-primary-200">
          Product Description
        </h2>
        <p class="py-2 text-base text-justify text-primary-200">
          <?php echo $description; ?>
      </div>
    </section>
  </main>
  <script src="../js/product-description.js"></script>
</body>

</html>