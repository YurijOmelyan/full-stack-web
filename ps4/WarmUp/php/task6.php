<br>
<h2>Task6</h2>
<h3>Generate an array of random integers from 1 to 10, the length of the array is 100.<br> Remove repeats from the
    array, sort, reverse and multiply each element by two.</h3>
<form method="post">
    <input type="hidden" name="task" value="6">
    <input type="submit" name="submit" value="show">
</form>
<br>
<?php if (isset($_SESSION['task6'])) {
    foreach ($_SESSION['task6'] as $step) {
        echo '<br>' . $step['message'] . ':<br>' . implode(' ', $step['result']) . '<br><br>';
    }
}
