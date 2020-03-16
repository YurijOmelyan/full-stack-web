<br>
<h2>Task3</h2>
<h3>Make file upload to a separate folder.<br>All files from the folder should be displayed in a
    list containing only the name and file size in a human-readable size (1kB, 3mB, 1.5gb) in brackets.<br>
    Files can be downloaded. Make a small preview for image files.</h3>
<form enctype="multipart/form-data" method="POST">
    <br>
    Select a file to send:
    <input type="hidden" name="task" value="3">
    <input name="userfile" type="file"/>
    <br>
    <br>
    <input type="submit" value="Send file"/>
</form>
<br>

<?php
if (isset($_POST['task'])) {
    $task = htmlspecialchars($_POST['task']);
    if ($task == 3) {
        $dirUpload = "upload";
        if (isset($_FILES['userfile']['name'])) {

            if ($_FILES['userfile']['error'] === 0) {
                if (!file_exists($dirUpload)) {
                    mkdir($dirUpload);
                }

                $file = "./" . $dirUpload . "/" . $_FILES['userfile']['name'];
                move_uploaded_file($_FILES['userfile']['tmp_name'], $file);
                echo "File - " . $_FILES['userfile']['name'] . " successfully uploaded!";
            } else {
                $phpFileUploadErrors = array(
                    0 => 'There is no error, the file uploaded with success',
                    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
                    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
                    3 => 'The uploaded file was only partially uploaded',
                    4 => 'No file was uploaded',
                    6 => 'Missing a temporary folder',
                    7 => 'Failed to write file to disk.',
                    8 => 'A PHP extension stopped the file upload.',
                );
                echo $phpFileUploadErrors[$_FILES['userfile']['error']];
            }
        }
        $dir = $dirUpload;
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) :?>
                <ol>
                    <? while (($file = readdir($dh)) !== false) {
                        $arrayImageTypes = ['jpeg', 'jpg', 'gif', 'png', 'svg', 'bmp'];
                        $pathToFile = "../" . $dir . "/" . $file;
                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

                        if ($file != "." && $file != "..") : ?>
                            <li><a href='/php/download.php?file=<?= $pathToFile; ?>'><?= $file; ?>
                                    ( <?= human_filesize(filesize($dir . "/" . $file)); ?>)
                                    <? if (in_array($fileExtension, $arrayImageTypes)): ?>
                                        <img class="small--image" src="<?= $pathToFile; ?>" alt="<?= $file; ?>">
                                    <? endif; ?>
                                </a></li>
                        <? endif;

                    } ?>
                </ol>
                <?php closedir($dh);
            endif;
        }
    }
}

function human_filesize($bytes, $decimals = 2)
{
    $factor = floor((strlen($bytes) - 1) / 3);
    if ($factor > 0) {
        $sz = 'KMGT';
    }
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor - 1] . 'B';
}

?>
<br>
<br>
