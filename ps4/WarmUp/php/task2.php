<?php
$firstNumber = $secondNumber = "";
$result = $remainderDivision = 0;

if (isset($_POST['task'])) {
    $task = htmlspecialchars($_POST['task']);
    if ($task == 2) {
        $firstNumber = htmlspecialchars($_POST["firstNumberTaskSecond"]);
        $secondNumber = htmlspecialchars($_POST["secondNumberTaskSecond"]);
    }
}
?>
    <br>
    <h2>Task2</h2>
    <h3>Problem statement: calculate the sum of numbers that end in 2, 3 and 7 in the entered range</h3>
    <form method="post">
        <input type="hidden" name="task" value="2">
        <br>
        Enter the first number
        <br>
        <input type="number" name="firstNumberTaskSecond" value="<?= $firstNumber; ?>">
        <br><br>
        Enter the second number
        <br>
        <input type="number" name="secondNumberTaskSecond" value="<?= $secondNumber; ?>">
        <br><br>
        <input type="submit" name="submit" value="Calculate">
    </form>
    <br>

<?php
if ($task == 2) {

    if (is_numeric($firstNumber) && is_numeric($secondNumber)) {
        for ($x = min($firstNumber, $secondNumber); $x <= max($firstNumber, $secondNumber); $x++) {
            $remainderDivision = $x % 10;
            if ($remainderDivision == 2 || $remainderDivision == 3 || $remainderDivision == 7) {
                $result += $x;
            }
        } ?>
        <div>Result: <?= $result; ?></div><br>
    <? } else { ?>
        <div>Fill in the blank fields.</div><br>
    <? }
    unset($task);
}
?>