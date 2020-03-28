<br>
<h2>Task1</h2>
<h3> Problem statement: calculate the sum of numbers in the entered range</h3>
<form method="post">
    <input type="hidden" name="task" value="1">
    Enter the first number
    <br>
    <input
            type="number"
            name="firstNumberTaskOne"
            value="<?= (isset($_SESSION['task1'])) ? $_SESSION['task1']['firstNumber'] : '' ?>">
    <br><br>
    Enter the second number
    <br><input
            type="number"
            name="secondNumberTaskOne"
            value="<?= (isset($_SESSION['task1'])) ? $_SESSION['task1']['secondNumber'] : '' ?>">
    <br><br>
    <input type="submit" name="submitTaskOne" value="Calculate">
</form>
<br>
<?php if (isset($_SESSION['task1'])): ?>
    <div><?= $_SESSION['task1']['result']; ?> </div>
    <br>
<?php endif;
