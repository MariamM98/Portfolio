<?php
    session_start();

    if (!isset($_SESSION['loggedin'])) {
        header('Location: login.php');
        exit;
    }
?>

<?php
    include 'functions.php';
    $pdo = pdo_connect_mysql();
    $massage = '';

    if (!empty($_POST)) {
        $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] ? $_POST['id'] : NULL;
        $task = isset($_POST['task']) ? $_POST['task'] : '';
        $stmt = $pdo->prepare('INSERT INTO `table` VALUES (?, ?)');
        $stmt->execute([$id, $task]);
        $massage = 'Task has been added!';
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Task</title>
        <link rel="stylesheet" href="tasks.css">
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
            <h2>Add Task</h2>

            <form action="add.php" method="post">
                <label for="id"><b>ID</b></label>
                    <label>
                        <input type="text" name="id" placeholder="Enter id..." value="" id="id">
                    </label>

                <label for="task"><b>Task</b></label>
                    <label>
                        <input type="text" name="task" placeholder="Enter task here..." id="task">
                    </label>

                <input type="submit" value="Add" class="add">
            </form>

            <?php if ($massage): ?>
                <p><?=$massage?></p>
            <?php endif; ?>

        </div>
    </div>

    </body>
    </html>
