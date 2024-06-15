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

  <main class="min-w-screen">

    <section class="flex justify-start w-full h-screen gap-4 p-8 sm:px-32 sm:py-16 text-primary-200">
      <!-- Navigation Settings -->
      <div class="w-[400px]">
        <!-- Image Profile -->
        <div class="w-full h-[300px] rounded-full bg-neutral-600">
          <img src="" alt="" srcset="">
        </div>
        <!-- Full Name -->
        <h1 class='text-3xl font-black text-center'>John Doe</h1>
        <!-- Navigation -->
        <div class='mt-4'>
          <h2 class='text-2xl font-bold'>Account Settings</h2>
          <div class='mt-2'>
            <a class='' href="profile.php">Profile</a>
            <br>
            <a class='' href="banks.php">Banks & Cards</a>
            <br>
            <a class='' href="">Address</a>
            <br>
            <a class='' href="">Change Password</a>
          </div>
          <div class='mt-2'>
            <h2 class='text-xl font-bold'>General Settings</h2>
            <a class='' href="">Settings</a>
            <br>
            <a class='' href="">Logout</a>
          </div>
        </div>
      </div>

      <!-- Settings -->
      <div class="w-full p-8 rounded-md bg-neutral-400/50 ">

        <h2 class='mb-3 text-3xl font-bold'>My Profile</h2>
        
        <hr>

        <div class='flex items-start justify-start h-full'>
          <!-- Inputs -->
          <div class='table w-full'>

            <div class=''>
              <label class='text-lg font-bold min-w-32' for="username">Username</label>
              <input type="text" name="username" id="username" value="">
            </div>
            <div class=''>
              <label class='text-lg font-bold' for="name">Name</label>
              <input type="text" name="name" id="name" value="">
            </div>
            <div class=''>
              <label class='text-lg font-bold' for="email">Email</label>
              <input type="email" name="email" id="email" value="">
            </div>
            <div class=''>
              <label class='text-lg font-bold' for="number">Phone Number</label>
              <input type="number" name="number" id="number" value="">
            </div>
            <div class=''>
              <label class='text-lg font-bold' for="gender">Gender</label>
              <input type="text" name="gender" id="gender" value="">
            </div>
            <div class=''>
              <label class='text-lg font-bold' for="birthdate">Date of birth</label>
              <input type="text" name="birthdate" id="birthdate" value="">
            </div>
          </div>
          <!-- Profile Image -->
          <div></div>
        </div>

      </div>

    </section>

  </main>

</body>

</html>