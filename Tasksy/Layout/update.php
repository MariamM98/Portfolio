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

        if (!empty($_POST)) {
            $id = isset($_POST['id']) ? $_POST['id'] : NULL;
            $task = isset($_POST['task']) ? $_POST['task'] : '';
            $stmt = $pdo->prepare('UPDATE `table` SET id = ?, task = ? WHERE id = ?');
            $stmt->execute([$id, $task, $_GET['id']]);
            $massage = 'Task has been updated!';
        }

        $stmt = $pdo->prepare('SELECT * FROM `table` WHERE id = ?');
        $stmt->execute([$_GET['id']]);
        $table = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$table) {
                exit('task doesn\'t exist with that ID!');
            }
    }
    else {
        exit('No ID specified!');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Update Task</title>
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
            <h2>Update Task #<?=$table['id']?></h2>

            <form action="update.php?id=<?=$table['id']?>" method="post">
                <label for="id">ID</label>
                    <label>
                        <input type="text" name="id" placeholder="1" value="<?=$table['id']?>" id="id">
                    </label>

                <label for="task">Task</label>
                    <label>
                        <input type="text" name="task" placeholder="Enter task here.." value="<?=$table['task']?>" id="task">
                    </label>

                <input type="submit" value="Update" class="add">
            </form>

            <?php if ($massage): ?>
                <p><?=$massage?></p>
            <?php endif; ?>
        </div>
    </div>

    </body>
    </html>
