<?php

session_start();
include 'protect-route.php';
include '../Welcome-content/db.php';

if (isset($_POST['delete'])) {
  $product_id = $_POST['product_id'];
  $conn->query("DELETE FROM products WHERE id = $product_id");
  echo "<script>alert('Product deleted successfully')</script>";
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="/sage/css/output.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>

<body>

  <header>
    <?php include 'admin-navbar.php' ?>
  </header>

  <main class="min-h-[70vh]">
    <section class="flex flex-col items-center justify-start h-full px-8 py-4">
      <div class="relative w-full text-center">
        <h1 class="text-3xl font-bold text-primary-200 ">Items</h1>
        <button class="absolute top-0 right-0 p-2 text-white origin-center bg-primary-100 hover:bg-primary-200"><a
            href="add-item.php">New Item</a></button>
      </div>
      <table class="w-full p-8 mt-4 bg-white border-collapse rounded-lg shadow-md">
        <thead class="bg-gray-200">
          <tr>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Name</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Price</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Seller</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">

          <?php

          $users = $conn->query("SELECT * FROM products");
          while ($row = $users->fetch_assoc()) {
            $product_id = $row['id'];
            $product_name = $row['name'];
            $price = $row['price'];
            $seller = $row['seller'];

            echo "<tr>
                    <td class='px-6 py-4 whitespace-nowrap'>{$product_name}</td>
                    <td class='px-6 py-4 whitespace-nowrap'>{$price}</td>
                    <td class='px-6 py-4 whitespace-nowrap'>{$seller}</td>
                    <td class='px-6 py-4 text-sm text-gray-500 whitespace-nowrap'>
                        <form class='space-x-2' action='items.php' method='POST'>
                            <input type='text' name='product_id' value='{$product_id}' class='hidden'>
                            <button type='submit' name='view' class='text-blue-500 hover:text-blue-700'>View</button>
                            <button type='submit' name='edit' class='text-blue-500 hover:text-blue-700'>Edit</button>
                            <button type='submit' name='delete' class='text-red-500 hover:text-red-700'>Delete</button>
                        </form>
                    </td>
                </tr>";
          }

          ?>
      </table>
    </section>
  </main>

</body>

</html>