<?php

include_once 'appConstants.php';

$json = file_get_contents(PATH_BASE);
$arr = json_decode($json, true);
foreach ($arr as $key => $value) :?>
    <label>
        <input type="radio" name="selectedValue" value="<?= $value ?>"><?= $value ?>
    </label>
<? endforeach; ?>
