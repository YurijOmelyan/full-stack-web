<br>
<h2>Task2</h2>
<h3>Problem statement: calculate the sum of numbers that end in 2, 3 and 7 in the entered range</h3>
<form method="post">
    <input type="hidden" name="task" value="2">
    <br>
    Enter the first number
    <br>
    <input
            type="number"
            name="firstNumberTaskSecond"
            value="<?= (isset($_SESSION['task2'])) ? $_SESSION['task2']['firstNumber'] : '' ?>">
    <br><br>
    Enter the second number
    <br>
    <input
            type="number"
            name="secondNumberTaskSecond"
            value="<?= (isset($_SESSION['task2'])) ? $_SESSION['task2']['secondNumber'] : '' ?>">
    <br><br>
    <input type="submit" name="submit" value="Calculate">
</form>
<br>
<?php if (isset($_SESSION['task2'])): ?>
    <div><?= $_SESSION['task2']['result']; ?> </div>
    <br>
<?php endif;
