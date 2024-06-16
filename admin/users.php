<?php

session_start();
include 'protect-route.php';
include '../Welcome-content/db.php';

if (isset($_POST['delete'])) {
  $user_id = $_POST['user_id'];
  $conn->query("DELETE FROM users WHERE id = $user_id");
  echo "<script>alert('User deleted successfully')</script>";
}

if (isset($_POST['view'])) {
  // TODO: view user
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
      <h1 class="text-3xl font-bold text-primary-200 ">Users</h1>
      <table class="w-full p-8 mt-4 bg-white border-collapse rounded-lg shadow-md">
        <thead class="bg-gray-200">
          <tr>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Username</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Name</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Email</th>
            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">

          <?php

          $users = $conn->query("SELECT * FROM users");
          while ($row = $users->fetch_assoc()) {
            $user_id = $row['id'];
            $username = $row['username'];
            $name = $row['name'];
            $email = $row['email'];

            echo "<tr>
                    <td class='px-6 py-4 whitespace-nowrap'>{$username}</td>
                    <td class='px-6 py-4 whitespace-nowrap'>{$name}</td>
                    <td class='px-6 py-4 whitespace-nowrap'>{$email}</td>
                    <td class='px-6 py-4 text-sm text-gray-500 whitespace-nowrap'>
                        <form action='users.php' method='POST'>
                            <input type='text' name='user_id' value='{$user_id}' class='hidden'>
                            <button type='submit' name='view' class='text-blue-500 hover:text-blue-700'>View</button>
                            <button type='submit' name='delete' class='text-red-500 hover:text-red-700'>Delete</button>
                        </form>
                    </td>
                </tr>";
          }

          ?>

        </tbody>
      </table>
    </section>
  </main>

</body>

</html>


<!-- <tr>
  <td>johndoe</td>
  <td>John Doe</td>
  <td>johndoe@gmail.com</td>
  <td class="flex justify-center">
    <button class="px-4 py-2 mx-2 text-white rounded-md bg-primary-200">View</button>
    <button class="px-4 py-2 mx-2 text-white rounded-md bg-primary-200">Delete</button>
  </td>
</tr> -->