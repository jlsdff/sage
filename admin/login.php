<?php

session_start();

include '../Welcome-content/db.php';

if (isset($_POST['login'])) {

  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $password = md5(htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8'));

  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
  $stmt->bind_param("ss", $email, $password);
  $stmt->execute();

  $res = $stmt->get_result();
  if ($res->num_rows === 0) {

    $error = "Invalid email or password";
    
  } else {

    $user = $res->fetch_array();

    if ($user['user_type'] !== 'admin') {
      $error = "You are not an admin";
    } else {
      $_SESSION['admin_id'] = $user['id']; 
      header('location: index.php');
    }

  }
}

?>


<!DOCTYPE html>
<html lang="en">
<l>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SAGE | Admin Login</title>
  <link rel="stylesheet" href="/sage/css/output.css">
</l>

<body class="bg-[#f5f4f2]">
  <header class='w-full p-8'>
    <img class="w-64" src="/sage/WEBDEV_PICS/newlogo.png" alt="">
  </header>
  <main>
    <section class="min-h-[70vh] flex justify-center items-center">
      <form class="w-full sm:w-1/3 bg-[#dedfd9] rounded-md p-8 " action="login.php" method="post">
        <h2 class="text-2xl font-bold text-center">Admin</h2>
        <div>
          <?php
          if (isset($error)) {
            echo "<p class='text-center text-red-500'>$error</p>";
          }
          ?>
        </div>

        <section class="mt-5 space-y-4">
          <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
            <input type="email" id="email" name="email"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
          </div>
          <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
            <input type="password" id="password" name="password"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              required />
          </div>

          <div class="text-center">
            <button type="submit" name="login"
              class="text-white bg-[#3c5327] hover:bg-[#2e3f1e] focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 w-32">Login</button>
          </div>

        </section>

      </form>
    </section>
  </main>
</body>

</html>