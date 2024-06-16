<?php

session_start();
include 'protect-route.php';
include '../Welcome-content/db.php';

if (isset($_POST['logout'])) {
  session_destroy();
  header('Location: /sage/admin');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link rel="stylesheet" href="/sage/css/output.css">
</head>

<body class="bg-[#f5f4f2]">

  <header>
    <?php include 'admin-navbar.php' ?>
  </header>

  <main class="flex items-center justify-center min-h-[70vh]">

    <section class="grid grid-cols-2 gap-8 ">
      <a href="users.php" class="flex flex-col items-center justify-center p-8 rounded-md bg-[#dedfd9] ">
        <div class="w-24 aspect-square">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#16260b" class="w-full hover:fill-primary-100">
            <path fill-rule="evenodd"
              d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
              clip-rule="evenodd" />
          </svg>
        </div>
        <h2>User List</h2>
      </a>
      <a href="items.php" class="flex flex-col items-center justify-center p-8 rounded-md bg-[#dedfd9] ">
        <div class="w-24 aspect-square">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#16260b" class="w-full hover:fill-primary-100">
            <path
              d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375Z" />
            <path fill-rule="evenodd"
              d="m3.087 9 .54 9.176A3 3 0 0 0 6.62 21h10.757a3 3 0 0 0 2.995-2.824L20.913 9H3.087Zm6.163 3.75A.75.75 0 0 1 10 12h4a.75.75 0 0 1 0 1.5h-4a.75.75 0 0 1-.75-.75Z"
              clip-rule="evenodd" />
          </svg>
        </div>
        <h2>Item List</h2>
      </a>
      <a href="orders.php" class="flex flex-col items-center justify-center p-8 rounded-md bg-[#dedfd9] ">
        <div class="w-24 aspect-square">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#16260b" class="w-full hover:fill-primary-100">
            <path fill-rule="evenodd"
              d="M12 5.25c1.213 0 2.415.046 3.605.135a3.256 3.256 0 0 1 3.01 3.01c.044.583.077 1.17.1 1.759L17.03 8.47a.75.75 0 1 0-1.06 1.06l3 3a.75.75 0 0 0 1.06 0l3-3a.75.75 0 0 0-1.06-1.06l-1.752 1.751c-.023-.65-.06-1.296-.108-1.939a4.756 4.756 0 0 0-4.392-4.392 49.422 49.422 0 0 0-7.436 0A4.756 4.756 0 0 0 3.89 8.282c-.017.224-.033.447-.046.672a.75.75 0 1 0 1.497.092c.013-.217.028-.434.044-.651a3.256 3.256 0 0 1 3.01-3.01c1.19-.09 2.392-.135 3.605-.135Zm-6.97 6.22a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 1 0 1.06 1.06l1.752-1.751c.023.65.06 1.296.108 1.939a4.756 4.756 0 0 0 4.392 4.392 49.413 49.413 0 0 0 7.436 0 4.756 4.756 0 0 0 4.392-4.392c.017-.223.032-.447.046-.672a.75.75 0 0 0-1.497-.092c-.013.217-.028.434-.044.651a3.256 3.256 0 0 1-3.01 3.01 47.953 47.953 0 0 1-7.21 0 3.256 3.256 0 0 1-3.01-3.01 47.759 47.759 0 0 1-.1-1.759L6.97 15.53a.75.75 0 0 0 1.06-1.06l-3-3Z"
              clip-rule="evenodd" />
          </svg>
        </div>
        <h2>Orders</h2>
      </a>
      <a href="add-item.php" class="flex flex-col items-center justify-center p-8 rounded-md bg-[#dedfd9] ">
        <div class="w-24 aspect-square">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#16260b" class="w-full hover:fill-primary-100">
            <path fill-rule="evenodd"
              d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
              clip-rule="evenodd" />
          </svg>

        </div>
        <h2>Add Item</h2>
      </a>
    </section>

  </main>

</body>

</html>