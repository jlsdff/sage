<?php

session_start();
include '../Welcome-content/db.php';
include '../utils/verify.php';
$user_id = $_SESSION['user_id'];

$is_verifying = false;

if(isset($_GET['is_verifying'])){
  $is_verifying = $_GET['is_verifying'];
}


if (isset($_POST['verify-code'])) {

  $code = $_POST['code'];

  $query = "SELECT * FROM verification_codes WHERE user_id = $user_id AND code = $code";
  $res = $conn->query($query);

  if ($res->num_rows > 0) {
    $query = "UPDATE users SET is_verified = 1 WHERE id = $user_id";
    $conn->query($query) or die($conn->error);
    $is_verified = true;
  } else {
    $error = 'Invalid code';
    header('Location: verify-email.php?is_verifying=true&error=invalid_code');
  }

}


if (isset($_POST['verify'])) {

  $is_verifying = $_GET['is_verifying'] ? $_GET['is_verifying'] : true;

  $user = $conn->query("SELECT * FROM users WHERE id = $user_id");
  $user = $user->fetch_array();

  $email = $user['email'];

  sendVerificationCode($user_id, $email);

}

if (isset($user_id)) {

  $user = $conn->query("SELECT * FROM users WHERE id = $user_id");
  $user = $user->fetch_array();

  $username = $user['username'];
  $name = $user['name'] ? $user['name'] : '';
  $email = $user['email'] ? $user['email'] : '';
  $phone_number = $user['phone_number'] ? $user['phone_number'] : '';
  $gender = $user['gender'] ? $user['gender'] : '';
  $birthdate = $user['birthdate'] ? $user['birthdate'] : '';
  $image = $user['image'] ? 'data:image/jpeg;base64,' . base64_encode($user['image']) : '';

} else {
  header('Location: ../Welcome-content/login.php');
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Account</title>
  <link rel="stylesheet" href="../css/output.css">
</head>

<body>

  <header>
    <?php include '../header-product.php'; ?>
  </header>

  <main class="min-h-screen">

    <section
      class="flex flex-col justify-start w-full min-h-screen gap-4 p-8 sm:flex-row sm:px-32 sm:py-16 text-primary-200">
      <!-- Navigation Settings -->
      <div class="w-[400px]">
        <!-- Image Profile -->
        <div class="flex items-center justify-center w-full aspect-square ">
          <img class="w-full rounded-full aspect-square" src="<?php echo $image ?>" alt="" srcset="">
        </div>
        <!-- Full Name -->
        <h1 class='text-3xl font-black text-center'><?php echo $username ?></h1>
        <!-- Navigation -->
        <div class='mt-4'>
          <h2 class='text-2xl font-bold'>Account Settings</h2>
          <div class='mt-2'>
            <a class='' href="profile.php">Profile</a>
            <br>
            <a class='' href="address.php">Address</a>
            <br>
            <a class='' href="verify-email.php">Verify Email</a>
            <br>
            <a class='' href="change-password.php">Change Password</a>
          </div>
          <form action="profile.php" post="post" class='mt-2'>
            <h2 class='text-xl font-bold'>General Settings</h2>
            <button type="submit" name="logout">
              Logout
            </button>
          </form>
        </div>
      </div>

      <!-- Settings -->
      <div class="w-full p-8 rounded-md bg-[#e6e9e3]/50 ">

        <?php

        $user_id = $_SESSION['user_id'];
        $res = $conn->query("SELECT * FROM users WHERE id = {$user_id}");
        $res = $res->fetch_array();

        $is_verified = $res['is_verified'];

        ?>
        <h2 class='mb-3 text-3xl font-bold'>Verify Email</h2>

        <hr>

        <div class='flex flex-col items-start justify-start h-full gap-8'>
          <!-- Inputs -->

          <h3 class="<?php echo $is_verified ? "text-green-500" : "text-red-500" ?> text-xl font-bold">
            <?php
            echo $is_verified ? 'Email is verified' : 'Email is not verified';
            ?>
          </h3>

          <?php
          // if (!$is_verifying) {
          if (!$is_verifying && !$is_verified) {
            echo '<form class="mt-8" action="verify-email.php" method="post">

            <button class="px-5 py-2.5 bg-primary-100 text-white rounded-full" type="submit" name="verify">
              Verify Email
            </button>

          </form>';
          } else {

            if (isset($_GET['error'])) {
              $error = "INVALID CODE";
              echo "<p class='text-red-500'>$error</p>";
            }

            if (!$is_verified) {
              echo '<form class="max-w-lg space-y-4" action="verify-email.php" method="post">
              <div class="max-w-lg">
                <label for="code" class="block mb-2 text-sm font-medium text-gray-900 ">Code</label>
                <input type="number" id="code" name="code"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
              </div>
              <div>
                <button class="px-8 py-4 text-white rounded-full bg-primary-100" type="submit" name="verify-code" >Verify</button>
              </div>
            </form>';
            }

          }
          ?>
        </div>

      </div>

    </section>

  </main>
  <script src="/sage/js/verify.js"></script>
</body>

</html>