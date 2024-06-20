<?php

include 'db.php';
session_start();

if (isset($_POST['login'])) {

  $email = $_POST['email'];
  $pass = md5($_POST['password']);

  $stmt = $conn->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
  $stmt->bind_param('ss', $email, $pass);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();
    $stmt->close();

    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_id'] = $user['id'];
    header('location:/sage/main-category/main_content.php');


  } else {
    $message[] = 'Invalid Credentials!';
  }



}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/output.css">
</head>

<body class="bg-[#f5f4f2]">

  <main class="flex items-center justify-center w-full min-h-screen">
    <section class="flex items-center w-full px-8 sm:px-32">
      <!-- Form -->
      <div class="flex flex-col w-full gap-4 sm:w-1/2">
        <div class="flex justify-center w-full sm:justify-start">
          <img src="../pic/sagelogo.png" alt="Logo" class="w-[200px]">
        </div>
        <div class="w-full text-center sm:text-left text-primary-100 ">
          <h1 class="text-2xl font-bold sm:text-4xl">Login</h1>
          <p class="text-lg tracking-wide">Log in to our marketplace and shop sustainably
            with a conscience.</p>
        </div>

        <div>
          <ul>
            <?php
            if (isset($message)) {
              foreach ($message as $msg) {
                echo '
                    <li class="font-bold text-red-500">
                        <span>' . $msg . '</span>
                    </li>
                    ';
              }
            }
            ?>
          </ul>
        </div>

        <form class="flex flex-col gap-3" action="login.php" method="post">
          <div class="w-full sm:max-w-lg">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
            <input name="email" type="email" id="email" placeholder="Enter your email"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
              value="<?php echo !empty($email) ? $email : '' ?>" required />
          </div>
          <div class="w-full sm:max-w-lg">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
            <input name="password" type="password" id="password" placeholder="Password"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
              required />
          </div>
          <div class="w-full sm:max-w-lg">
            <button type="submit" name="login"
              class="w-full  bg-primary-100 text-white hover:bg-primary-200 py-2.5 rounded-full">Login</button>
          </div>

        </form>

        <div class="w-full max-w-lg">
          <p class="text-sm text-center text-gray-500">Don't have an account? <a href="signup.php"
              class="font-bold text-primary-100 hover:underline">Sign up</a></p>
        </div>

      </div>
      <!-- Carousel -->
      <div class="hidden w-1/2 sm:block">
        <!-- Carousel Container-->
        <div class="w-full p-8" id="default-carousel" class="relative w-full" data-carousel="slide">
          <div class="relative w-full overflow-hidden rounded-lg h-[700px]">
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
              <img src="../pic/p1.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                alt="...">
            </div>
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
              <img src="../pic/p2.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                alt="...">
            </div>
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
              <img src="../pic/p3.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                alt="...">
            </div>
          </div>
        </div>
    </section>
  </main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>