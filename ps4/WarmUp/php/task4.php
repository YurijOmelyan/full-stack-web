<br>
<h2>Task4</h2>
<h3>Chess board</h3>
<form method="post">
    Enter the number of columns
    <br><br>
    <input type="hidden" name="task" value="4">
    <input
            type="number"
            name="firstNumberTaskFourth"
            value="<?= (isset($_SESSION['task4'])) ? $_SESSION['task4']['firstNumber'] : '' ?>">
    <br><br>
    Enter the number of rows
    <br><input
            type="number"
            name="secondNumberTaskFourth"
            value="<?= (isset($_SESSION['task4'])) ? $_SESSION['task4']['secondNumber'] : '' ?>">
    <br><br>
    <input type="submit" name="submit" value="Show">
</form>
<br>

<?php if (isset($_SESSION['task4'])):
    echo $_SESSION['task4']['message'] ?>
    <br>
    <?= $_SESSION['task4']['result']; ?>
    <br><br>
<?php endif;
