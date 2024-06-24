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

    if (isset($_GET['id'])) {
        $stmt = $pdo->prepare('SELECT * FROM `table` WHERE id = ?');
        $stmt->execute([$_GET['id']]);
        $table = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$table) {
            exit('task doesn\'t exist!');
        }

        if (isset($_GET['confirm'])) {
            if ($_GET['confirm'] == 'yes') {
                $stmt = $pdo->prepare('DELETE FROM `table` WHERE id = ?');
                $stmt->execute([$_GET['id']]);
                $massage = 'Task has been deleted!';
            }
            else {
                header('Location: tasks.php');
                exit;
            }
        }
    }
    else {
        exit('No ID entered!');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Delete Task</title>
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
            <h2>Delete task</h2>

            <?php if ($massage): ?>
                <p><?=$massage?></p>
            <?php else: ?>

            <p>Are you sure you want to delete task #<?=$table['id']?>?</p>

            <div>
                <a href="delete.php?id=<?=$table['id']?>&confirm=yes" class="option">Yes</a>
                <a href="delete.php?id=<?=$table['id']?>&confirm=no" class="option">No</a>
            </div>

            <?php endif; ?>
        </div>
    </div>

    </body>
    </html>
