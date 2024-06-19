<?php

session_start();
include '../Welcome-content/db.php';
$user_id = $_SESSION['user_id'];
$user_address = $conn->query("SELECT * FROM addresses WHERE user_id = $user_id");

if ($user_address->num_rows == 0) {
  echo "<script>alert('No address found');</script>";
}else {
  $user_arr = $user_address->fetch_array();

  $house_number = $user_arr['house_number'];
  $street = $user_arr['street'];
  $city = $user_arr['city'];
  $zip_code = $user_arr['zip_code'];
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

if (isset($_POST['change_address'])) {

  $house_number = $_POST['house_number'];
  $street = $_POST['street'];
  $city = $_POST['city'];
  $zip_code = $_POST['zip_code'];

  if($user_address->num_rows == 0 || $user_address == null){
    $query = "INSERT INTO addresses (user_id, house_number, street, city, zip_code) VALUES ('$user_id', '$house_number', '$street', '$city', '$zip_code')";
  } else {
    $query = "UPDATE addresses SET house_number = '$house_number', street = '$street', city = '$city', zip_code = '$zip_code' WHERE user_id = '$user_id'";
  }

  $conn->query($query) or die($conn->error);

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

        <h2 class='mb-3 text-3xl font-bold'>My Address</h2>

        <hr>

        <div class='flex items-start justify-start h-full'>

          <form action="address.php" method="post" class="w-1/3 space-y-4">
            <div class="max-w-lg">
              <label for="house_number" class="block mb-2 text-sm font-medium text-gray-900 ">House #</label>
              <input type="text" id="house_number" name='house_number' value="<?php echo $house_number; ?>" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
            </div>
            <div class="max-w-lg">
              <label for="street" class="block mb-2 text-sm font-medium text-gray-900 ">Street</label>
              <input type="text" id="street" name='street' required value="<?php echo $street; ?>"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
            </div>
            <div class="max-w-lg">
              <label for="city" class="block mb-2 text-sm font-medium text-gray-900 ">City</label>
              <input type="text" id="city" name='city' required value="<?php echo $city; ?>"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
            </div>
            <div class="max-w-lg">
              <label for="zip_code" class="block mb-2 text-sm font-medium text-gray-900 ">Zip Code</label>
              <input type="text" id="zip_code" name='zip_code' required value="<?php echo $zip_code; ?>"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
            </div>
            <div class="max-w-lg">
              <button type="submit" name="change_address"
                class="px-5 py-2.5 bg-primary-100 text-white rounded-md">Change</button>
            </div>
          </form>



        </div>

      </div>

    </section>

  </main>

</body>

</html>