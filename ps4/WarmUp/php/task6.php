<br>
<h2>Task6</h2>
<h3>Generate an array of random integers from 1 to 10, the length of the array is 100.<br> Remove repeats from the
    array, sort, reverse and multiply each element by two.</h3>
<form method="post">
    <input type="hidden" name="task" value="6">
    <input type="submit" name="submit" value="show">
</form>
<br>

<?php
if (isset($_POST['task'])) {
    $task = htmlspecialchars($_POST['task']);
    if ($task == 6) {

        function random()
        {
            return mt_rand(0, 10);
        }

        function doubleValue($el)
        {
            return $el * 2;
        }

        $array = array_unique(array_map('random', range(0, 99)));
        sort($array);
        print_r(array_map('doubleValue', array_reverse($array)));
    }
}

?>
<br>
<br>
