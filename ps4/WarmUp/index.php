<?php
session_start();
include 'app/appLogic.php';
if (!isset($_SESSION['numberViews'])) {
    $_SESSION['numberViews'] = 1;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PS4 PHP</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css"/>
</head>
<body>
<header><h1>Warm Up Job PS4</h1></header>
<main class="main">
    <?php include 'app/loadTasks.php' ?>
</main>
<footer>
    <h3>Number of views - <?= $_SESSION['numberViews']++; ?></h3>
</footer>
</body>
</html>
