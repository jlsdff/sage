<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sage eco-shop | Header</title>
    <link rel="stylesheet" href="/sage/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>

    <div class="navbar">

        <div class="navbar-logo">

            <a href="main_content.php"><img src="../WEBDEV_PICS/sage.png" alt="Logo"></a>

            <div class="navbar-links">
                <a href="/sage/main-category/main_living.php">Living</a>
                <a href="/sage/main-category/main_health.php">Health</a>
                <a href="/sage/main-category/main_clothing.php">Clothing</a>
                <a href="/sage/main-category/main_accessories.php">Accessories</a>
            </div>

        </div>

        <!------SEARCH PANEL----->

        <div class="navbar-search">
            <form action="/sage/main-category/search.php" method="get">
                <input type="text" name="text" placeholder="Search Product">
            </form>
        </div>

        <!-----ADD TO CART, ACCOUNT, FAVORITES---->
        <div class="navbar-links-1">
            <a href="/sage/product/likes.php"><img src="../WEBDEV_PICS/10 (2).png">Likes</a>
            <a href="/sage/account/profile.php"><img src="../WEBDEV_PICS/11 (2).png">Account</a>
            <a href="/sage/product/basket.php"><img src="../WEBDEV_PICS/12 (1).png">Basket</a>
        </div>
    </div>

</body>

</html>