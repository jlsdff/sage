<?php

session_start();
include '../Welcome-content/db.php';
$user_id = $_SESSION['user_id'];

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

if(isset($_POST['change-password'])){

  $new_password = $_POST['new-password'];
  $confirm_password = $_POST['confirm-password'];

  if($new_password == $confirm_password){
    $new_password = md5($new_password); 
    $query = "UPDATE users SET password = '$new_password' WHERE id = '$user_id'";
    $conn->query($query) or die($conn->error);
    $is_changed = true;
  } else {
    $error = 'Password does not match';
  }
  
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
          <form action="profile.php" method="post" class='mt-2'>
            <h2 class='text-xl font-bold'>General Settings</h2>
            <button type="submit" name="logout" value="--">
              Logout
            </button>
          </form>
        </div>
      </div>

      <!-- Settings -->
      <div class="w-full p-8 rounded-md bg-[#e6e9e3]/50 ">

        <h2 class='mb-3 text-3xl font-bold'>Change Password</h2>

        <hr>

        <div class='flex items-start justify-start h-full'>
          <!-- Inputs -->
          <form action="change-password.php" method="post" class='flex flex-col justify-center w-full h-full gap-4'>
            <div>
              <?php
                if(isset($error)){
                  echo "<p class='text-red-500'>$error</p>";
                } 
                if(isset($is_changed)){
                  echo "<p class='text-green-500'>Password has been changed</p>";
                }
              ?>
            </div>
            
            <div class="max-w-lg">
              <label for="new-password" class="block mb-2 text-sm font-medium text-gray-900 ">New Password</label>
              <input type="password" id="new-password" name='new-password'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
            </div>
            <div class="max-w-lg">
              <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 ">Confirm Password</label>
              <input type="password" id="confirm-password" name='confirm-password'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
            </div>
            
            <div class='mt-4'>
              <button class="py-2.5 px-5 bg-primary-200 hover:bg-primary-100 font-bold text-white rounded-md text-sm"
                type="submit" name="change-password">Change Password</button>
            </div>
          </form>
        </div>

      </div>

    </section>

  </main>

</body>

</html>