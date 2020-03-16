<?php
$columsName = "firstNumberTaskFourth";
$rowsName = "secondNumberTaskFourth";

if (isset($_POST['task'])) {
    $task = htmlspecialchars($_POST['task']);
    if ($task == 4) {
        $colums = htmlspecialchars($_POST[$columsName]);
        $rows = htmlspecialchars($_POST[$rowsName]);
    }
}
?>
<br>
<h2>Task4</h2>
<h3>Chess board</h3>
<form method="post">
    Enter the number of columns
    <br><br>
    <input type="hidden" name="task" value="4">
    <input type="number" name="firstNumberTaskFourth"
        <? if (isset($colums)) : ?>
            value="<?= $colums; ?>"
        <? endif; ?>>
    <br><br>
    Enter the number of rows
    <br><input type="number" name="secondNumberTaskFourth"
        <? if (isset($rows)): ?>
            value="<?= $rows; ?>"
        <? endif; ?>>
    <br><br>
    <input type="submit" name="submit" value="Show">
</form>
<br>

<?php
if ($task == 4) {
    if (is_numeric($colums) && is_numeric($rows)) :?>
        <div id='chessBoard' class='chessBoard'>
            <? for ($x = 1; $x <= $rows; $x++): ?>
                <div class='row--board'>
                    <? for ($y = 0; $y < $colums; $y++) : ?>
                        <div class='cells <?= (($x + $y) % 2 == 0 ? "white" : "black") ?>'></div>
                    <? endfor; ?>
                </div>
            <? endfor; ?>
        </div>
        <script src='../js/main.js'></script>
    <? endif;
}
?>
<br>
<br>
