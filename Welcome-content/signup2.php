<?php

include 'config.php';

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    $user_type = $_POST['user_type'];

    $select_users = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {
        $message[] = 'user already exists!';
    } else {
        if ($pass != $cpass) {
            $message[] = 'confirm password does not match!';
        } else {
            mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$pass', '$user_type')") or die('query failed');
            $message[] = 'registered successfully!';
            header('location:login.php');
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sage eco-shop | Sign Up</title>
    <link rel="stylesheet" type="text/css" href="../css/signup2style.css">
</head>

<body>
    <div class="header">
        <a href="welcome.php"><img src="../pic/newlogo.png" alt="Logo" class="logo"></a>
        <a href="welcome.php" class="back-button">
        </a>
    </div>
    <div class="container">
        <form action="" method="post">
            <h2>Create an account</h2>
            <p>Join our community today! Sign up and start making sustainable
                <br> choices that benefit both you and the planet.
            </p>

            <?php
            if (isset($message)) {
                foreach ($message as $msg) {
                    echo '
                    <div class="message">
                        <span>' . $msg . '</span>
                        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                    </div>
                    ';
                }
            }
            ?>

            <div class="form-group">
                <label for="name"><b>Your name </b></label>
                <input type="name" id="name" name="name" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <label for="email"><b>Email</b></label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password"><b>Password</b></label>
                <input type="password" id="password" name="password" placeholder="******"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}"
                    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                    required>
            </div>
            <div class="form-group">
                <label for="cpassword"><b>Retype password</b></label>
                <input type="password" id="cpassword" name="cpassword" placeholder="******"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}"
                    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                    required>
            </div>
            <input type="submit" name="submit" value="Sign Up" class="continue-button">

            <div class="signup-text">
                Already have an account? <a href="login.php"><b>Login</b></a>
            </div>

            <div class="terms-policy">
                By continuing, you agree to our<br>
                <a href="terms.php"><b>Terms of Service</b></a> and <a href="policy.php"> <b>Privacy Policy</b></a>
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
        </form>
    </div>
    <script src="../js/signup2.js"></script>
</body>

</html>