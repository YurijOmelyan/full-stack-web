<?php
$firstNumber = $secondNumber = "";
$result = $task = 0;

if (isset($_POST['task'])) {
    $task = htmlspecialchars($_POST['task']);
    if ($task == 1) {
        $firstNumber = htmlspecialchars($_POST["firstNumberTaskOne"]);
        $secondNumber = htmlspecialchars($_POST["secondNumberTaskOne"]);
    }
}
?>
<br>
<h2>Task1</h2>
<h3> Problem statement: calculate the sum of numbers in the entered range</h3>
<form method="post">
    Enter the first number
    <br><br>
    <input type="hidden" name ="task" value="1">
    <input type="number" name="firstNumberTaskOne" value="<?php echo $firstNumber; ?>">
    <br><br>
    Enter the second number
    <br><input type="number" name="secondNumberTaskOne" value="<?php echo $secondNumber; ?>">
    <br><br>
    <input type="submit" name="submitTaskOne" value="Calculate">
</form>
<br>

<?php

if ($task == 1) {

    if (is_numeric($firstNumber) && is_numeric($secondNumber)) {
        for ($x = min($firstNumber, $secondNumber); $x <= max($firstNumber, $secondNumber); $x++) {
            $result += $x;
        }

        echo "<div>Result: " . $result . "</div><br>";
    } else {
        echo "<div>Fill in the blank fields.</div><br>";
    }
    unset($task);
}
?>