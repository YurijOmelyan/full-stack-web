<?php
$text = '';
if (isset($_POST['task'])) {
    $task = htmlspecialchars($_POST['task']);
    if ($task == 8) {
        $text = htmlspecialchars($_POST["text"]);
    }
}
?>
<br>
<h2>Task8</h2>
<h3>Count the number of lines, letters and spaces in the entered text.
    <br> Consider the Cyrillic alphabet, emoji and special characters.
    <br> Check with any online counterRemove repeats from the array, sort, reverse and multiply each element by two.
</h3>
<form method="post">
    <input type="hidden" name="task" value="8">
    <textarea name="text" cols="30" rows="10"><?php echo $text; ?></textarea>
    <br><br>
    <input type="submit" name="submit" value="Show result">
</form>
<br>

<?php
if ($task == 8) {
    if (!empty($text)) {
        echo '<br>Number of spaces - ' . $numberSpaces = mb_substr_count($text, ' ');
        $numberLines = mb_substr_count($text, "\r\n");
        echo '<br>Number of lines - ' . ($numberLines + 1);
        echo '<br>Number of letters - ' . (mb_strlen($text) - $numberSpaces - ($numberLines === 0 ? $numberLines : $numberLines + 1));
        echo '<br> len - ' . mb_strlen($text);
    }
}
?>
