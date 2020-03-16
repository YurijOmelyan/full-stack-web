<?php
$number = 0;
if (isset($_POST['task'])) {
    $task = htmlspecialchars($_POST['task']);
    if ($task == 5) {
        $number = htmlspecialchars($_POST["numberTaskFive"]);
    }
}
?>
<br>
<h2>Task5</h2>
<h3>Find the sum of the digits of the entered number.</h3>
<form method="post">
    Enter the number
    <br><br>
    <input type="hidden" name="task" value="5">
    <input type="number" name="numberTaskFive" value="<?= $number; ?>"><br><br>
    <input type="submit" name="submit" value="Calculate">
</form>
<br>

<?php

if ($task == 5) :?>
    Result: <?= getNumberDigitsInNumber(abs($number)); ?>
<?endif;

function getNumberDigitsInNumber($num)
{
    $ten = 10;
    $sum = 0;
    while ($num >= $ten) {
        $sum += $num % $ten;
        $num = intdiv($num, $ten);
    }
    return $sum += $num % $ten;
}

?>
<br>
<br>
