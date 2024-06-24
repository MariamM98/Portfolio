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
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $records_per_page = 5;

    $stmt = $pdo->prepare('SELECT * FROM `table` ORDER BY id LIMIT :current_page, :record_per_page');
    $stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
    $stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
    $stmt->execute();

    $table = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $num_table = $pdo->query('SELECT COUNT(*) FROM `table`')->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Tasks</title>
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

        <div class="main">
            <form method="post">
                <label>
                    <input type="text"
                        <?php echo isset($_POST['userinput']) ? : '' ?>
                   placeholder="Search task list.." name="userinput">
                </label>
                <input type="submit" class="search" name="search" value="Search">

                <?php
                if(ISSET($_POST['search'])){
                $userinput = $_POST['userinput'];
                $stmt = $pdo->prepare("SELECT * FROM `table` WHERE `task` LIKE '%$userinput%'");
                $stmt->execute();
                while($row = $stmt->fetch()){
                ?>

                    <br> <br>
                    <a><?php echo $row['task']?></a>

                <?php
                } }
                ?>

            </form>

            <h2>Task List</h2>

            <table>
                <thead>
                <tr>
                    <td class="one">#</td>
                    <td>task</td>
                    <td></td>
                </tr>
                </thead>

                <tbody>
                    <?php foreach ($table as $tables): ?>

                    <tr>
                        <td class="one"><?=$tables['id']?></td>
                        <td><?=$tables['task']?></td>
                        <td class="actions">
                            <a href="update.php?id=<?=$tables['id']?>" class="edit">Update</a>
                            <a href="delete.php?id=<?=$tables['id']?>" class="delete">Delete</a>
                        </td>
                    </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php if ($page > 1): ?>
                <a href="tasks.php?page=<?=$page-1?>"></a>
            <?php endif; ?>

            <?php if ($page*$records_per_page < $num_table): ?>
                <a href="tasks.php?page=<?=$page+1?>"></a>
            <?php endif; ?>

        </div>
    </div>

    </body>
    </html>
