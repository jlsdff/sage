<?php

session_start();
include '../Welcome-content/db.php';
$user_id = $_SESSION['user_id'];

if (isset($_POST['logout'])) {
  session_destroy();
  header('Location: ../Welcome-content/login.php');
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

if (isset($_POST['update'])) {

  $username = $_POST['username'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone_number = $_POST['phone_number'];
  $gender = $_POST['gender'];
  $birthdate = $_POST['birthdate'];

  $query = "UPDATE users SET username = '$username', name = '$name', email = '$email', phone_number = '$phone_number', gender = '$gender', birthdate = '$birthdate' WHERE id = '$user_id'";

  $conn->query($query) or die($conn->error);

}
if (isset($_POST['update_profile_image'])) {
  if (isset($_FILES['profile_input']) && $_FILES['profile_input']['error'] == 0) {
    $image = addslashes(file_get_contents($_FILES['profile_input']['tmp_name']));
    $query = "UPDATE users SET image = '$image' WHERE id = '$user_id'";
    $conn->query($query) or die($conn->error);
    header('Location: profile.php');
  } else {
    echo "No file was uploaded.";
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
          <img class="object-cover w-full rounded-full aspect-square " src="<?php echo $image ?>" alt="" srcset="">
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

        <h2 class='mb-3 text-3xl font-bold'>My Profile</h2>

        <hr>

        <div class='flex items-start justify-start h-full'>
          <!-- Inputs -->
          <form action="profile.php" method="post" enctype="multipart/form-data"
            class='flex flex-col justify-center w-full h-full gap-4'>
            <div class="max-w-lg">
              <label for="username" class="block mb-2 text-sm font-medium text-gray-900 ">Username</label>
              <input type="text" id="username" name='username' value="<?php echo $username ?>"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
            </div>
            <div class="max-w-lg">
              <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Name</label>
              <input type="text" id="name" name='name' value="<?php echo $name ?>"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
            </div>
            <div class="max-w-lg">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
              <input type="email" id="email" name='email' value="<?php echo $email ?>"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
            </div>
            <div class="max-w-lg">
              <label for="number" class="block mb-2 text-sm font-medium text-gray-900 ">Phone
                Number</label>
              <input type="number" id="number" name='phone_number' value="<?php echo $phone_number ?>"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
            </div>
            <div class="max-w-lg">
              <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 ">Gender</label>
              <select
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                name="gender" id="gender">
                <option value="Male" <?php echo $gender == 'Male' ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo $gender == 'Female' ? 'selected' : ''; ?>>Female</option>
                <option value="Secret" <?php echo $gender == 'Secret' ? 'selected' : ''; ?>>Prefer not to say</option>
              </select>
            </div>
            <div class="max-w-lg">
              <label for="birthdate" class="block mb-2 text-sm font-medium text-gray-900 ">Date of
                birth</label>
              <input type="date" id="birthdate" name='birthdate'
                value="<?php echo $birthdate ? date('Y-m-d', strtotime($birthdate)) : ''; ?>"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
            </div>
            <div class=''>
              <button class="py-2.5 px-5 bg-primary-200 hover:bg-primary-100 font-bold text-white rounded-md"
                type="submit" name='update'>Change</button>
            </div>

          </form>
          <!-- Profile Image -->
          <form action="profile.php" enctype="multipart/form-data" method="post"
            class='w-64 h-full p-4 border-l-4 border-l-slate-400/5'>
            <div class="w-full aspect-square">
              <img class="object-cover w-full rounded-full aspect-square " src="<?php echo $image ?>" alt="" srcset="">
            </div>
            <div>
              <label class="block mb-2 text-sm font-medium text-gray-900 " for="file_input">Upload
                file</label>
              <input
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 "
                id="file_input" type="file" accept="image/png, image/jpeg" name="profile_input">
            </div>
            <div class='mt-4'>
              <button class="py-2.5 px-5 bg-primary-200 hover:bg-primary-100 font-bold text-white rounded-md text-sm"
                type="submit" name="update_profile_image">Update Profile Picture</button>
            </div>
          </form>
        </div>

      </div>

    </section>

  </main>

</body>

</html>