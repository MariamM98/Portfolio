<!DOCTYPE html>
    <html lang="en">
    <head>
        <title>login</title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>

    <?php require 'navbar.php'; ?>


        <form action="authenticate.php" method="post">
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

                <button type="submit">Login</button>

                <br> <br>

                <a>Don't have an account?</a>
                <a class="sign" href="signup.php">Sign Up</a>
            </div>

        </form>

    </body>
    </html>