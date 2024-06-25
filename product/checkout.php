<?php

session_start();
include '../Welcome-content/db.php';
include '../utils/cart.php';
include '../utils/check-verification.php';

$user_id = $_SESSION['user_id'];

checkVerification($user_id);
$total = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sage</title>
  <link rel="stylesheet" href="/sage/css/output.css">
</head>

<body>
  <header>
    <?php include '../header-product.php'; ?>
  </header>
  <main>

    <form action="payment-details.php" method="post">

      <section>
        <div class="p-8">
          <h1 class="text-2xl font-bold text-center ">Order Summary</h1>
          <table class="w-full p-8 mt-4 bg-white border-collapse rounded-lg shadow-md">
            <thead class="bg-gray-200">
              <tr>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Product</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Price</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Quantity</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Subtotal</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              
              

              <?php
              if (isset($_GET['products'])) {

                foreach (explode(',',$_GET['products']) as $product_id) {
                  $item = getItem($product_id, $user_id);
                  $image = 'data:image/jpeg;base64,' . base64_encode($item['image']);
                  $name = $item['name'];
                  $price = $item['price'];
                  $quantity = $item['quantity'];
                  $subtotal = $price * $quantity;
                  $total += $subtotal;
                  echo "
                <tr>
                  <input name='products[]' value='$product_id' class='hidden' >
                  <td class='px-6 py-4 whitespace-nowrap'><div class='flex items-center gap-4' ><img src='$image' alt='product-image' width='100' height='100'> $name </div></td>
                  <td class='px-6 py-4 whitespace-nowrap'>$price</td>
                  <td class='px-6 py-4 whitespace-nowrap'>$quantity</td>
                  <td class='px-6 py-4 whitespace-nowrap'>$subtotal</td>
                </tr>
              ";
                }

              }
              ?>
              <input name='total' value='<?php echo $total; ?>' class='hidden' >
              <!-- Shipping Option -->
              <tr>
                <td class="px-6 py-4 text-right">
                  <h2 class="text-xl font-bold">Shipping Option:</h2>
                </td>
                <td class="px-6 py-4 text-center">
                  <div>
                    <h2 class="text-lg ">Standard Local</h2>
                    <h3 class="text-lg text-green-500">Guaranteed to get by June 28</h3>
                  </div>
                </td>
                <td>
                  <div>
                    <p class="text-xl font-bold">₱49</p>
                  </div>
                </td>
              </tr>
              <!-- Payment Method -->
              <tr>
                <td class="px-6 py-4 text-right">
                  <h2 class="text-xl font-bold">Payment Method:</h2>
                </td>
                <td class="px-6 py-4 text-center">
                  <div>
                    <select name="payment-option" id="">
                      <option value="cod">Cash on Delivery</option>
                    </select>
                  </div>
                </td>
              </tr>

              <tr>
                <td colspan="4" class="px-6 py-4 text-center">
                  <button class="px-5 py-2.5 bg-primary-100 text-white rounded-full hover:bg-primary-200" type="submit"
                    name="buy">
                    Proceed
                  </button>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </section>


    </form>
  </main>
</body>

</html>