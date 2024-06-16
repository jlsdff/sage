<?php

session_start();
include 'protect-route.php';
include '../Welcome-content/db.php';
$stmt = $conn->prepare("
    SELECT orders.*, users.name, products.name AS product_name 
    FROM orders 
    INNER JOIN users ON orders.user_id = users.id 
    INNER JOIN products ON orders.product_id = products.id
");
$stmt->execute();
$orders = $stmt->get_result();

if (isset($_POST['delete'])) {

}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orders</title>
  <link rel="stylesheet" href="/sage/css/output.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>

<body>
  <header>
    <?php include 'admin-navbar.php' ?>
  </header>
  <main class="flex flex-col items-center justify-start w-screen">
    <h1 class="my-8 text-3xl font-bold text-primary-100" >Orders</h1>

    <section class="w-full px-16">
    <table class="w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Product</th>
          <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Buyer</th>
          <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Tracking Number
          </th>
          <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Quantity</th>
          <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <?php
        while ($order = $orders->fetch_assoc()) {
          $product_name = $order['product_name'];
          $buyer = $order['name'];
          $tracking_number = $order['tracking_number'];
          $quantity = $order['quantity'];

          echo '<tr>
                <td class="px-6 py-4 whitespace-nowrap">' . $product_name . '</td>
                <td class="px-6 py-4 whitespace-nowrap">' . $buyer . '</td>
                <td class="px-6 py-4 whitespace-nowrap">' . $tracking_number . '</td>
                <td class="px-6 py-4 whitespace-nowrap">' . $quantity . '</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <form action="" method="post">
                        <input type="hidden" name="order_id" value="' . $order['id'] . '">
                        <button type="submit" name="view" class="text-indigo-600 hover:text-indigo-900">View</button>
                        <button type="submit" name="delete" class="text-red-600 hover:text-red-900">Delete</button>
                    </form>
                </td>
            </tr>';
        }
        ?>
      </tbody>
    </table>
    </section>

  </main>
</body>

</html>