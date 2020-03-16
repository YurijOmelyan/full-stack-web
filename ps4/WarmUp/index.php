<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PS4 PHP</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<header><h1>Warm Up Job PS4</h1></header>
<main class="main">
    <div class="task"><?php include "php/task1.php"; ?></div>
    <div class="task"><?php include "php/task2.php"; ?></div>
    <div class="task"><?php include "php/task3.php"; ?></div>
    <div class="task"><?php include "php/task4.php"; ?></div>
    <div class="task"><?php include "php/task5.php"; ?></div>
    <div class="task"><?php include "php/task6.php"; ?></div>
    <div class="task"><?php include "php/task8.php"; ?></div>

</main>
<footer>
    <h3>Number of views -
        <?php
        if (!isset($_SESSION['numberViews'])) {
            $_SESSION['numberViews'] = 1;
        } ?>
        <?= $_SESSION['numberViews']++; ?></h3>
</footer>
</body>
</html>
