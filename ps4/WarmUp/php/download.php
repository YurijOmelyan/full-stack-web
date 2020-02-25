<?php
$file = $_GET['file'];
file_download($file);

function file_download($file)
{

    if (file_exists($file)) {
        if (ob_get_level()) {
            ob_end_clean();
        }

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        return [
            'status' => 'success',
            'message' => 'Файл успешно отдан',
        ];
    } else {
        return [
            'status' => 'error',
            'message' => 'Файл не найден',
        ];
    }
}
