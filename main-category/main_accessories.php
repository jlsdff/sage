<?php

include '../Welcome-content/db.php';

$query = "SELECT * FROM products WHERE category = 'accessories'";

$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sage eco-shop |Header</title>
    <link rel="stylesheet" type="text/css" href="../css/main_living.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <form action="search.php" method="get">
                <input type="text" name="text" placeholder="Type to search">
            </form>
        </div>

        <!-----ADD TO CART, ACCOUNT, FAVORITES---->
        <div class="navbar-links-1">
            <a href="/sage/product/likes.php"><img src="../WEBDEV_PICS/10 (2).png">Likes</a>
            <a href="/sage/account/profile.php"><img src="../WEBDEV_PICS/11 (2).png">Account</a>
            <a href="/sage/product/basket.php"><img src="../WEBDEV_PICS/12 (1).png">Basket</a>
        </div>
    </div>


    <!----PRODUCTS(ACCESSORIES)-->


    <div class="container">
        <?php
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_array()) {

                $id = $row['id'];
                $name = $row['name'];
                $description = $row['description'];
                $price = $row['price'];
                $seller = $row['seller'];
                $image = 'data:image/jpeg;base64,' . base64_encode($row['image']);


                echo "<div class='item'>
                <a href='../product/product.php?id={$id}'><img src='{$image}'></a>
                <div class='card-text'>
                    <a href='../product/product.php?id={$id}'>{$name}</a>
                    <a href='../product/product.php?id={$id}'>
                        <p>{$seller}</p>
                    </a>
                    <span>₱{$price}</span>
                    <label> | Price</label>
                </div>
            </div>";
            }
        } else {
            echo "No products found";
        }
        ?>
    </div>

    <?php
    include '../footer.php';
    ?>


</body>

</html>