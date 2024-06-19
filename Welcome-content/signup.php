<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign up</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/output.css">
</head>

<body>

  <main class="flex items-center justify-center w-screen min-h-screen px-8 sm:px-32">
    <section class="w-full min-h-[500px] flex flex-col sm:flex-row ">
      <!-- Form -->
      <div class="flex flex-col items-start justify-center w-full sm:w-1/2">
        <div class="w-[200px]">
          <img src="../pic/sagelogo.png" alt="Logo" class="w-full">
        </div>
        <div class="mt-4">
          <h1 class="text-xl font-bold sm:text-3xl text-primary-100">Create an Account</h1>
          <p class="text-base tracking-normal sm:text-xl text-primary-100">Join our community today! Sign up and start
            making sustainable
            <br> choices that benefit both you and the planet.
          </p>
        </div>
        <form class="w-full mt-4" action="" method="post">

          <div>
            <?php
            if (isset($message)) {
              foreach ($message as $msg) {
                echo '
                    <div class="font-bold text-red-500">
                        <span>' . $msg . '</span>
                        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                    </div>
                    ';
              }
            }
            ?>
          </div>

          <div class="flex flex-col w-full gap-2">
            <div class="w-full sm:max-w-lg">
              <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Your name</label>
              <input type="name" id="name" placeholder="Enter your name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                required />
            </div>
            <div class="w-full sm:max-w-lg">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
              <input type="email" id="email" placeholder="Email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                required />
            </div>
            <div class="w-full sm:max-w-lg">
              <!-- TODO: Make password verification -->
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
              <input type="password" id="password" placeholder="password"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                required />
            </div>
            <div class="w-full sm:max-w-lg">
              <label for="cpassword" class="block mb-2 text-sm font-medium text-gray-900 ">Confirm Password</label>
              <input type="password" id="cpassword" placeholder="Confirm password"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                required />
            </div>
            <div class="w-full mt-4 sm:max-w-lg">
              <button type="submit"
                class="w-full text-center py-2.5 bg-primary-100 text-white font-bold hover:bg-primary-200 rounded-full">
                Sign Up
              </button>
            </div>
          </div>
        </form>
        <div class="sm:w-[512px] mt-4 text-center">
          <p class="text-base text-neutral-400">Already have an account? <span
              class="text-base font-bold text-primary-100 hover:underline ">
              <!-- TODO: ROUTE -->
              <a href="">Login</a> </span> </p>
          <br>
          <p class="text-base text-neutral-400">By continuing, you agree to our
            <br>
            <!-- TODO: ROUTE -->
            <span class="text-base font-bold text-primary-100 hover:underline "><a href="">Terms of Service</a></span>
            and <span class="text-base font-bold text-primary-100 hover:underline "><a href="">Privacy Policy</a></span>
          </p>
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
      </div>
    </section>
  </main>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>