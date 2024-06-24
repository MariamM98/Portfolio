<?php
    session_start();
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'login_db';

    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
        if ( mysqli_connect_errno() ) {
            exit('Failed to connect to MySQL: ' . mysqli_connect_error());
        }

        if ( !isset($_POST['username'], $_POST['password']) ) {
            exit('Please fill both the username and password fields!');
        }

        if ($stmt = $con->prepare('SELECT id, password FROM users WHERE username = ?')) {

            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute();

            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $password);
                $stmt->fetch();
                // Account exists, now we verify the password.
                // Note: remember to use password_hash in your registration file to store the hashed passwords.
                if ($_POST['password'] === $password) {
                    // Verification success! User has logged-in!
                    // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
                    session_regenerate_id();
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['name'] = $_POST['username'];
                    $_SESSION['id'] = $id;
                    header('Location: mytasks.php');
                } else {
                    // Incorrect password
                    echo 'Incorrect username and/or password!';
                }
            } else {
                // Incorrect username
                echo 'Incorrect username and/or password!';
            }


            $stmt->close();
        }