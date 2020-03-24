<br>
<h2>Task8</h2>
<h3>Count the number of lines, letters and spaces in the entered text.
    <br> Consider the Cyrillic alphabet, emoji and special characters.
    <br> Check with any online counterRemove repeats from the array, sort, reverse and multiply each element by two.
</h3>
<form method="post">
    <input type="hidden" name="task" value="8">
    <textarea
            name="text"
            cols="30"
            rows="10"><?= (isset($_SESSION['task8'])) ? $_SESSION['task8']['text'] : '' ?></textarea>
    <br><br>
    <input type="submit" name="submit" value="Show result">
</form>
<br>
<?php
if (isset($_SESSION['task8'])) {
    $result = $_SESSION['task8'];
    if (isset($result['message'])) {
        echo $result['message'];
    } else {
        foreach ($result['result'] as $item) {
            echo $item['message'] . $item['result'] . '<br>';
        }
    }
} ?>
<br>
