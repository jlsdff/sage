<?php
include 'config.php';
session_start();

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {

        $row = mysqli_fetch_assoc($select_users);

        if ($row['user_type'] == 'admin') {

            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:welcome.php');

        } elseif ($row['user_type'] == 'user') {

            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location:/sage/main-category/main_content.php');

        }

    } else {
        $message[] = 'incorrect email or password!';
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sage eco-shop</title>
    <link rel="stylesheet" type = "text/css" href="../css/logins.css">
</head>

<body>

    <form action="login.php" method="post">
        <div class="header">
        <a href="welcome.php"><img src="../pic/newlogo.png" alt="Logo" class="logo"></a>

        </div>
        <div class="container">
            <h2>Login</h2>
            <p>Log in to our marketplace and shop sustainably
                <br> with a conscience.
            </p>

            <?php
            if (isset($message)) {
                foreach ($message as $message) {
                    echo '
                  <div class="message">
                     <span>' . $message . '</span>
                     <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                  </div>
                  ';
                }
            }
            ?>

            <div class="form-group">
                <label for="email"><b> Your email </b></label>
                <input type="email" id="email" name="email" placeholder="email" required>
            </div>
            <div class="form-group">
                <label for="password"><b>Password</b></label>
                <input type="password" id="password" name="password" placeholder="********" required>
            </div>

            <input type="submit" name="submit" value="Log In" class="continue-button">
            
            <div class="divider">
                <span class="divider-line"></span>
                <span class="divider-text">or</span>
                <span class="divider-line"></span>
            </div>

            <button class="continue-next-button"><img src="../pic/email.png" class="icon"> Continue with Google</button>
            <button class="continue-next-button"><img src="../pic/phone.png" class="icon"> Continue with Phone</button>

            <div class="signup-text">
                Don't have an account? <a href="signup2.php"><b>Sign up</b></a>
            </div>

            <div class="photo-container">
                <div class="slideshow">
                    <div class="slide">
                        <img src="../pic/p1.png" alt="Photo 1">
                        <div class="info"></div>
                    </div>

                    <div class="slide">
                        <img src="../pic/p2.png" alt="Photo 2">
                        <div class="info"></div>
                    </div>

                    <div class="slide">
                        <img src="../pic/p3.png" alt="Photo 3">
                        <div class="info"></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="../js/signup2.js"></script>
</body>

</html>