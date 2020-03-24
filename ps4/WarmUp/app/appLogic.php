<?php

if (isset($_POST['task'])) {
    include_once 'functions.php';

    $task = htmlspecialchars($_POST['task']);
    switch ($task) {
        case 1:
            $_SESSION['task1'] = getResultTaskOne();
            break;
        case 2:
            $_SESSION['task2'] = getResultTaskSecond();
            break;
        case 3:
            $_SESSION['task3'] = getResultTaskThird();
            break;
        case 4:
            $_SESSION['task4'] = getResultTaskFourth();
            break;
        case 5:
            $_SESSION['task5'] = getResultTaskFifth();
            break;
        case 6:
            $_SESSION['task6'] = getResultTaskSixth();
            break;
        case 8:
            $_SESSION['task8'] = getResultTaskEight();
            break;

    }
}
