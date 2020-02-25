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
    <input type="number" name="firstNumberTaskFourth" value="<?php echo $colums; ?>">
    <br><br>
    Enter the number of rows
    <br><input type="number" name="secondNumberTaskFourth" value="<?php echo $rows; ?>">
    <br><br>
    <input type="submit" name="submit" value="Show">
</form>
<br>

<?php
if ($task == 4) {
    if (is_numeric($colums) && is_numeric($rows)) {
        $chessBoard = "<div id='chessBoard' class='chessBoard'>";
        for ($x = 1; $x <= $rows; $x++) {
            $chessBoard .= "<div class='row--board'>";
            for ($y = 0; $y < $colums; $y++) {
                $chessBoard .= "<div class='cells " . (($x + $y) % 2 == 0 ? "white" : "black") . "'></div>";
            }
            $chessBoard .= "</div>";
        }
        $chessBoard .= "</div>";
        echo $chessBoard;
        echo "<script src='../js/main.js'></script>";
    }
}
?>
<br>
<br>
