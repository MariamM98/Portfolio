<?php
    include 'signupDB.php';
    $pdo = pdo_connect_mysql();

    if (!empty($_POST)) {
        $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] ? $_POST['id'] : NULL;
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $stmt = $pdo->prepare('INSERT INTO `users` VALUES (?, ?, ?, ?)');
        $stmt->execute([$id, $username, $password, $email]);
    }
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Sign Up</title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>

    <?php require 'navbar.php'; ?>


        <form action="" method="post">
            <div class="imgcontainer">
                <img src="images/loginlogo.jpg" alt="Avatar" class="avatar">
            </div>

            <div class="container">

                <label for="username"><b>Username</b></label>
                <label>
                    <input type="text" placeholder="Enter Username" name="username" required>
                </label>

                <label for="password"><b>Password</b></label>
                <label>
                    <input type="password" placeholder="Enter Password" name="password" required>
                </label>

                <label for="email"><b>Email</b></label>
                <label>
                    <input type="text" placeholder="Enter Email" name="email" required>
                </label>

                <button type="submit" >Sign Up</button>

                <br> <br>

                <a>Have an account?</a>
                <a class= "sign" href="login.php">Login</a>
            </div>

        </form>

    </body>
    </html>
