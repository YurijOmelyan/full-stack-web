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
<?php if (isset($_SESSION['task3'])):
    echo $_SESSION['task3']['message'] ?>
    <ol>
        <?= $_SESSION['task3']['result']; ?>
    </ol>
    <br><br>
<?php endif;