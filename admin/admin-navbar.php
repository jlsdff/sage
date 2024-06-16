<?php

include 'protect-route.php';
include '../Welcome-content/db.php';

$admin_id = $_SESSION['admin_id'];

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ? AND user_type = 'admin'");
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$admin = $stmt->get_result()->fetch_array();

$admin_image = $admin['image'] ? 'data:image/jpeg;base64,' . base64_encode($admin['image']) : '';



?>

<nav class="flex items-center justify-between px-8 py-4 bg-primary-100">
  <div class="w-32">
    <a href="/sage/admin">
      <img src="../WEBDEV_PICS/sage.png" alt="" srcset="">
    </a>
  </div>

  <ul class="flex items-center gap-4 text-white">
    <li><a class="text-xl font-semibold hover:text-neutral-200" href="users.php">Users</a></li>
    <li><a class="text-xl font-semibold hover:text-neutral-200" href="items.php">Items</a></li>
    <li><a class="text-xl font-semibold hover:text-neutral-200" href="orders.php">Orders</a></li>
    <li>
      <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown">
        <img class="w-10 h-10 rounded-full ring-2 ring-primary-200 " src="<?php echo $admin_image ?>"
          alt="Rounded avatar">
      </button>
    </li>
  </ul>


  <!-- Dropdown menu -->
  <div id="dropdown" class="z-10 hidden divide-y divide-gray-100 rounded-lg shadow bg-primary-200 w-44 ">
    <form action="index.php" method="post">
      <ul class="py-2 text-sm text-white" aria-labelledby="dropdownDefaultButton">
        <li>
          <button type="submit" name="logout" class="block w-full px-4 py-2 hover:text-red-500">
            Logout
          </button>
        </li>
      </ul>
    </form>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</nav>