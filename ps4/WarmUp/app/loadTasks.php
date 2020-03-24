<?php
$dir = $_SERVER['DOCUMENT_ROOT'].'/php/';
if (is_dir($dir) && ($arrFiles = scandir($dir))) {
    foreach ($arrFiles as $file) {
        if ($file != "." && $file != "..") :?>
            <div class="task"><?php include $dir.$file; ?></div>
        <? endif;
    }
} ?>