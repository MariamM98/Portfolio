<?php
    session_start();

    if (!isset($_SESSION['loggedin'])) {
	    header('Location: login.php');
	    exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>My Tasks</title>
        <link rel="stylesheet" href="mytasks.css">
    </head>
    <body>

    <?php require 'navbartwo.php'; ?>

    <div class="typewriter" > <h1>My-Tasks</h1> </div>

    <div class="container" >
        <div class="lists" >
            <dl class="listNames">
                <dt><a href="tasks.php"># Task List</a></dt>
                <br><br>
                <dt><a href="add.php"># Add Task</a></dt>
            </dl>
        </div>

        <div class="main" >
            <div>
                <h2>Hi! (◔◡◔)</h2>
                <h3>Welcome <?=$_SESSION['name']?> <3</h3>
                <p>
                    This is where you view and add tasks. On the left you will see a column that holds a list of options.
                    <br><br>

                    click on Task list to view your tasks.
                    <br>
                    Click on Add task to add a task to your list.
                    <br><br>

                    Now go get organized!! (≧◠‿◠≦)

                </p>
            </div>
        </div>
    </div>

    </body>
    </html>