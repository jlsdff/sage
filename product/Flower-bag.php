<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Living</title>
  <link href="../css/product-description.css" rel="stylesheet" />
</head>

<body>
<div>
    <?php include '../header-product.php'; ?>
  </div>

  <main class="w-screen min-h-screen gap-4 px-8 py-4 sm:px-24 sm:py-16">
    <section class="flex flex-col items-center justify-center gap-4 sm:flex-row">
      <div class="relative w-full sm:w-80">
        <!--ambot--->
        <a href="../main-category/main_living.php" id="back-button" class="absolute top-0 w-8 cursor-pointer -left-9 sm:-left-20">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#3B5326" class="size-10">
            <path fill-rule="evenodd"
              d="M7.72 12.53a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 1 1 1.06 1.06L9.31 12l6.97 6.97a.75.75 0 1 1-1.06 1.06l-7.5-7.5Z"
              clip-rule="evenodd" />
          </svg>
</a>
        <!--ambot sa imo Julius--->

        <img class="w-full" src="../WEBDEV_PICS/12.png" alt="" srcset="" />
      </div>

      <div class="flex flex-col justify-between w-full h-full gap-4 items-between sm:w-80">
        <div class="flex flex-col items-start justify-start">
          <div class="flex items-center justify-start gap-2">
            <h1 class="text-2xl font-bold text-primary-200">Flower Bag</h1>
            <form action="" method="post" id="like_button" class="block cursor-pointer">
              <input type="checkbox" class="hidden" id="like_checkbox" />
              <input type="submit" class="hidden" id="like_submit" />
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
              </svg>
            </form>
          </div>
          <span class="text-base font-bold">
            <span class="font-normal">by</span> den.ease</span>
        </div>

        <div>
          <h2 class="text-6xl font-black text-primary-200">₱200</h2>
          <h3 class="text-primary-200">Product price</h3>
        </div>

        <form action="" method="post">

          <div class="flex items-center justify-center gap-4">
            <button class="p-2" id="decrement" type="button">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" class="fill-primary-200"
                width="24px">
                <path d="M200-440v-80h560v80H200Z" />
              </svg>
            </button>

            <div class="flex flex-col items-center justify-center">
              <p class="text-2xl font-bold text-primary-200" id="quantity">0</p>
              <input type="number" name="quantity" id="quantity-input" class="hidden">
              <h3 class="text-xl font-bold text-primary-200">Quantity</h3>
            </div>
            <button class="p-2" id="increment" type="button">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" class="fill-primary-200"
                width="24px">
                <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
              </svg>
            </button>
          </div>

          <div class="flex items-center justify-between py-2">
            <button class="px-4 py-2 font-bold text-white rounded-lg bg-primary-100" id="add-to-basket">
              Add to basket
            </button>
            <button class="px-4 py-2 font-bold text-white rounded-lg bg-primary-100" id="buy-now">
              Buy now
            </button>
          </div>

        </form>

      </div>
    </section>
    <section class="flex justify-center w-full py-4 mt-4">
      <div class="w-full sm:w-[40rem]">
        <h2 class="text-xl font-bold text-primary-200">
          Product Description
        </h2>
        <p class="py-2 text-base text-justify text-primary-200">
        A flower bag cloth is a versatile and durable fabric featuring vibrant floral designs. 
        It's commonly used for making tote bags, pouches, and other accessories. 
        Made from natural fibers like cotton or canvas, flower bag cloth offers a soft 
        and sturdy texture. Its colorful patterns add a touch of charm to any outfit or home decor. 
        Ideal for carrying groceries, books, or everyday essentials, flower bag cloth is both practical 
        and stylish.
        </p>
      </div>
    </section>
  </main>
  <script src="product-description.js"></script>
</body>

</html>
