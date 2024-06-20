<link rel="stylesheet" href="../css/output.css">
<nav class="min-h-[80px] w-full flex justify-between items-center px-8 py-4 sm:px-16 sm:py-4 bg-[#3b5326]">
  <div class="w-[200px] ">
    <img class="object-fit" src="../WEBDEV_PICS/sage.png" alt="Logo">
  </div>

  <ul class="flex items-center gap-4 tracking-widest text-white">
    <li><a
        class='text-lg relative hover:text-[#b8bf4f] before:content-[""] before:absolute before:w-[0px] hover:before:w-full before:h-[3px] before:bg-[#b8bf4f] before:top-[calc(100%_+_5px)] before:transition-all before:duration-300'
        href="main_living.php">Living</a></li>
    <li><a
        class='text-lg relative hover:text-[#b8bf4f] before:content-[""] before:absolute before:w-[0px] hover:before:w-full before:h-[3px] before:bg-[#b8bf4f] before:top-[calc(100%_+_5px)] before:transition-all before:duration-300'
        href="main_health.php">Health</a></li>
    <li><a
        class='text-lg relative hover:text-[#b8bf4f] before:content-[""] before:absolute before:w-[0px] hover:before:w-full before:h-[3px] before:bg-[#b8bf4f] before:top-[calc(100%_+_5px)] before:transition-all before:duration-300'
        href="main_clothing.php">Clothing</a></li>
    <li><a
        class='text-lg relative hover:text-[#b8bf4f] before:content-[""] before:absolute before:w-[0px] hover:before:w-full before:h-[3px] before:bg-[#b8bf4f] before:top-[calc(100%_+_5px)] before:transition-all before:duration-300'
        href="main_accessories.php">Accessories</a></li>
  </ul>

  <form action="../main-category/search.php" method="get">
    <input class="w-full border rounded-full border-[#b8bf4f] py-2.5 px-5 bg-[#7e8e70] text-white placeholder:text-neutral-500"
      placeholder="type to search" type="text" name="text" id="text">
  </form>

  <ul class="flex items-center justify-center gap-4">
    <li class=""><a class="flex gap-2" href=""><img class="w-[24px]" src="../WEBDEV_PICS/10 (2).png"><span
          class="text-white">Likes</span></a></li>
    <li class=""><a class="flex gap-2" href=""><img class="w-[24px]" src="../WEBDEV_PICS/11 (2).png"><span
          class="text-white">Account</span></a></li>
    <li class=""><a class="flex gap-2" href=""><img class="w-[24px]" src="../WEBDEV_PICS/12 (1).png"><span
          class="text-white">Basket</span></a></li>
  </ul>
</nav>