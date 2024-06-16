<?php

session_start();
include 'protect-route.php';
include '../Welcome-content/db.php';

if (isset($_POST['new_item'])) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $category = $_POST['category'];
  $seller = $_POST['seller'];
  $description = $_POST['description'];
  $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

  $query = "INSERT INTO products (name, seller, description, image, price, category) VALUES ('$name', '$seller', '$description', '$image', '$price', '$category')";
  $conn->query($query) or die($conn->error);
  header('Location: items.php');
  echo "<script>alert('Product added successfully')</script>";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Item</title>
  <link rel="stylesheet" href="/sage/css/output.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>

<body>
  <header>
    <?php include 'admin-navbar.php' ?>
  </header>
  <main class="flex items-center justify-center">
    <section>
      <form action="add-item.php" method="post" class="mt-2.5" enctype="multipart/form-data">
        <h1 class="text-2xl font-bold text-center">Add Products</h1>
        <!-- Image -->
        <div class="max-w-lg">
          <label for="image" class="block mb-2 text-sm font-medium text-gray-900 ">Image</label>
          <input id="image" name='image' type="file" accept="image/png, image/jpeg" name="image" required
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
        </div>
        <!-- Name -->
        <div class="max-w-lg">
          <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Name</label>
          <input type="text" id="name" name='name' required
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
        </div>
        <!-- Price -->
        <div class="max-w-lg">
          <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ">Price</label>
          <input type="number" id="price" name='price' required
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
        </div>
        <!-- Seller -->
        <div class="max-w-lg">
          <label for="seller" class="block mb-2 text-sm font-medium text-gray-900 ">Seller</label>
          <input type="text" id="seller" name='seller' required
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
        </div>
        <!-- Description -->
        <div class="max-w-lg">
          <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">Description</label>
          <input type="text" id="description" name='description' required
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
        </div>
        <!-- Category -->
        <div class="max-w-lg">
          <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 ">Category</label>
          <select
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
            name="category" id="category">
            <option value="living">Living</option>
            <option value="health">Health</option>
            <option value="clothing">Clothing</option>
            <option value="accessories">Accessories</option>
          </select>
        </div>
        <div class="mt-4 text-center">
          <button type="submit" name="new_item" class="bg-primary-200  px-5 py-2.5 rounded-full">New Item</button>
        </div>
      </form>
    </section>
  </main>

</body>

</html>