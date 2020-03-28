<?php
include_once 'app/appConstants.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vote for the best programming language</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
            width: max-content;
        }
    </style>
</head>
<body>
<form action="<?= PATH_LOGIC ?>" method="post">
    <h2>Make your choice:</h2>
    <?php include_once PATH_LIST_VOTING; ?>
    <input type="submit" value="Show voting result">
</form>

</body>
</html>