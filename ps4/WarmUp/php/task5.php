<br>
<h2>Task5</h2>
<h3>Find the sum of the digits of the entered number.</h3>
<form method="post">
    Enter the number
    <br><br>
    <input type="hidden" name="task" value="5">
    <input
            type="number"
            name="numberTaskFive"
            value="<?= (isset($_SESSION['task5'])) ? $_SESSION['task5']['firstNumber'] : '' ?>">
    <br><br>
    <input type="submit" name="submit" value="Calculate">
</form>
<br>
<?php if (isset($_SESSION['task5'])):
    echo $_SESSION['task5']['message'] . $_SESSION['task5']['result']; ?>
    <br><br>
<?php endif; ?>
