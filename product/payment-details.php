<?php
session_start();
include "../Welcome-content/db.php";
include "../utils/cart.php";

$user_id = $_SESSION['user_id'];

if (isset($_POST['confirm-payment'])) {

  $products = $_POST['products'];
  $user_id = $_POST['user_id'];
  $total = $_POST['total'];
  $payment_option = $_POST['payment_option'];
  $transaction_id = $_POST['transaction_id'];
  $reference_id = $_POST['reference_id'];
  $tracking_number = $_POST['tracking_number'];
  $user = '';
  $result = $conn->query("SELECT * FROM users WHERE id=$user_id");
  if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc()['name'];
  }
  $address = $conn->query("SELECT * FROM addresses WHERE user_id=$user_id");
  if ($address && $address->num_rows > 0) {
    $address = $address->fetch_assoc();
    $address = "$address[house_number] $address[street], $address[city]";
  }

  foreach ($products as $product_id) {

    $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id=? AND product_id=?");
    $stmt->bind_param("ii", $user_id, $product_id);

    $stmt->execute();

    $product_from_cart = $stmt->get_result()->fetch_assoc();
    $quantity = $product_from_cart['quantity'];

    $stmt = $conn->prepare("INSERT INTO orders ( user_id, product_id, quantity, transaction_id, payment_option, reference_id, tracking_number ) VALUES ( ?, ?, ?, ?, ?, ?, ? )");
    $stmt->bind_param("iiissss", $user_id, $product_id, $quantity, $transaction_id, $payment_option, $reference_id, $tracking_number);

    $stmt->execute() or die("Error: " . $conn->error);

    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id=? AND product_id=?");
    $stmt->bind_param("ii", $user_id, $product_id);

    $stmt->execute() or die("Error: " . $conn->error);


  }

  $success = true;

}

if (isset($_POST['buy'])) {
  $total = $_POST['total'];
  $payment_option = $_POST['payment-option'];
  $transaction_id = '';
  for ($i = 0; $i < 20; $i++) {
    $transaction_id .= rand(0, 9);
  }
  $reference_id = '';
  for ($i = 0; $i < 20; $i++) {
    $reference_id .= rand(0, 9);
  }
  $tracking_number = '';
  for ($i = 0; $i < 12; $i++) {
    $tracking_number .= rand(0, 9);
  }
  $user = '';
  $result = $conn->query("SELECT * FROM users WHERE id=$user_id");
  if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc()['name'];
  }
  $address = $conn->query("SELECT * FROM addresses WHERE user_id=$user_id");
  if ($address && $address->num_rows > 0) {
    $address = $address->fetch_assoc();
    $address = "$address[house_number] $address[street], $address[city]";
  }

}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sage</title>
  <link rel="stylesheet" href="/sage/css/output.css">
</head>

<body class="bg-[#f5f4f2]">

  <header>
    <?php include '../header-product.php'; ?>
  </header>

  <main class="flex flex-col items-center justify-start ">
    <h1 class="my-4 text-3xl font-bold text-center text-primary-100">Payment Details</h1>
    <form action="payment-details.php" method="post" class="w-1/3 p-12 bg-white rounded-md">

      <input type="text" name="user_id" class="hidden" value="<?php echo $user_id; ?>">
      <input type="text" name="total" class="hidden" value="<?php echo $total; ?>">
      <input type="text" name="payment_option" class="hidden" value="<?php echo $payment_option; ?>">
      <input type="text" name="transaction_id" class="hidden" value="<?php echo $transaction_id; ?>">
      <input type="text" name="reference_id" class="hidden" value="<?php echo $reference_id; ?>">
      <input type="text" name="tracking_number" class="hidden" value="<?php echo $tracking_number; ?>">
      <?php
      foreach ($_POST['products'] as $product_id) {
        echo "<input type='text' name='products[]' class='hidden' value={$product_id}>";
      }
      ?>

      <div class="grid w-full grid-cols-2 gap-4 pt-4 pb-4 border-b-2 border-neutral-400">
        <h2 class="text-xl font-bold text-left text-primary-100">To:</h2>
        <h2 class="text-xl text-left text-primary-100"><?php echo $user; ?></h2>
      </div>
      <div class="grid w-full grid-cols-2 gap-4 pt-4 pb-4 border-b-2 border-neutral-400">
        <h2 class="text-xl font-bold text-left text-primary-100">Address:</h2>
        <h2 class="text-xl text-left text-primary-100"><?php echo $address; ?></h2>
      </div>
      <div class="grid w-full grid-cols-2 gap-4 pt-4 pb-4 border-b-2 border-neutral-400">
        <h2 class="text-xl font-bold text-left text-primary-100">Merchant Location:</h2>
        <h2 class="text-xl text-left text-primary-100">Manila</h2>
      </div>
      <div class="grid w-full grid-cols-2 gap-4 pt-4 pb-4 border-b-2 border-neutral-400">
        <h2 class="text-xl font-bold text-left text-primary-100">Payment Option:</h2>
        <h2 class="text-xl text-left text-primary-100">COD</h2>
      </div>
      <div class="grid w-full grid-cols-2 gap-4 pt-4 pb-4 border-b-2 border-neutral-400">
        <h2 class="text-xl font-bold text-left text-primary-100">Purchace Amount:</h2>
        <h2 class="text-xl text-left text-primary-100"><?php echo $total; ?></h2>
      </div>
      <div class="grid w-full grid-cols-2 gap-4 pt-4 pb-4 border-b-2 border-neutral-400">
        <h2 class="text-xl font-bold text-left text-primary-100">Transaction ID:</h2>
        <h2 class="text-xl text-left text-primary-100"><?php echo $transaction_id; ?></h2>
      </div>
      <div class="grid w-full grid-cols-2 gap-4 pt-4 pb-4 border-b-2 border-neutral-400">
        <h2 class="text-xl font-bold text-left text-primary-100">Reference ID:</h2>
        <h2 class="text-xl text-left text-primary-100"><?php echo $reference_id; ?></h2>
      </div>
      <div class="grid w-full grid-cols-2 gap-4 pt-4 pb-4 border-b-2 border-neutral-400">
        <h2 class="text-xl font-bold text-left text-primary-100">Tracking Number:</h2>
        <h2 class="text-xl text-left text-primary-100"><?php echo $tracking_number; ?></h2>
      </div>
      <div>
        <?php
        if (isset($success)) {
          echo "<h2 class='my-4 text-xl font-bold text-center text-primary-100'>Order Successful!</h2>";
        } else {
          echo "<button class='w-full p-4 mt-4 text-xl font-bold text-white rounded-md bg-primary-100' type='submit'
          name='confirm-payment'>Confirm</button>";
        }
        ?>
      </div>
    </form>

  </main>

</body>

</html>