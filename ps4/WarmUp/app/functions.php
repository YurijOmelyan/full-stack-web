<?php

/*
 * Task1
 */
function getResultTaskOne()
{
    $arrResult = [];
    $arrResult['firstNumber'] = ($firstNumber = htmlspecialchars($_POST["firstNumberTaskOne"]));
    $arrResult['secondNumber'] = ($secondNumber = htmlspecialchars($_POST["secondNumberTaskOne"]));

    if (is_numeric($firstNumber) && is_numeric($secondNumber)) {

        $sum = 0;
        for ($x = min($firstNumber, $secondNumber); $x <= max($firstNumber, $secondNumber); $x++) {
            $sum += $x;
        }

        $arrResult['result'] = 'Result: ' . $sum;
    } else {
        $arrResult['result'] = 'Fill in the blank fields.';
    }
    return $arrResult;
}

/*
 * Task2
 */
function getResultTaskSecond()
{
    $arrResult = [];

    $arrResult['firstNumber'] = ($firstNumber = htmlspecialchars($_POST["firstNumberTaskSecond"]));
    $arrResult['secondNumber'] = ($secondNumber = htmlspecialchars($_POST["secondNumberTaskSecond"]));

    if (is_numeric($firstNumber) && is_numeric($secondNumber)) {
        $sum = 0;

        for ($x = min($firstNumber, $secondNumber); $x <= max($firstNumber, $secondNumber); $x++) {
            $remainderDivision = $x % 10;
            if ($remainderDivision == 2 || $remainderDivision == 3 || $remainderDivision == 7) {
                $sum += $x;
            }
        }
        $arrResult['result'] = 'Result: ' . $sum;

    } else {
        $arrResult['result'] = 'Fill in the blank fields.';
    }
    return $arrResult;
}

/*
 *  Task3
 */
function getResultTaskThird()
{
    $arrResult = [];
    $dirUpload = "upload/";

    $arrResult['message'] = fileUpload($dirUpload);
    $arrResult['result'] = showFileList($dirUpload);
    return $arrResult;

}

function fileUpload($dir)
{
    if (!isset($_FILES['userfile']['name'])) {
        exit;
    }

    if ($_FILES['userfile']['error'] === 0) {
        if (!file_exists($dir)) {
            mkdir($dir);
        }

        $file = $dir . $_FILES['userfile']['name'];
        move_uploaded_file($_FILES['userfile']['tmp_name'], $file);
        return 'File - ' . $_FILES['userfile']['name'] . ' successfully uploaded!';

    } else {
        $phpFileUploadErrors = array(
            1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
            2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
            3 => 'The uploaded file was only partially uploaded',
            4 => 'No file was uploaded',
            6 => 'Missing a temporary folder',
            7 => 'Failed to write file to disk.',
            8 => 'A PHP extension stopped the file upload.',
        );
        return $phpFileUploadErrors[$_FILES['userfile']['error']];
    }
}

function showFileList($dir)
{
    $result = '';
    if (!is_dir($dir) || !($dh = opendir($dir))) {
        return $result;
    }

    while (($file = readdir($dh)) !== false) {
        if ($file != "." && $file != "..") {
            continue;
        }

        $path = $dir . $file;
        $arrayImageTypes = ['jpeg', 'jpg', 'gif', 'png', 'svg', 'bmp'];
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

        $result .= "<li><a href='app/download.php?file=" . urlencode($file) . "'>$file";
        $result .= '(' . human_filesize(filesize($path)) . ')';

        if (in_array($fileExtension, $arrayImageTypes)) {
            $result .= "<img class='small--image' src='$path' alt = '$file' />";
        }
        $result .= '</a></li>';

    }
    closedir($dh);
    return $result;
}

function human_filesize($bytes, $decimals = 2)
{
    $factor = floor((strlen($bytes) - 1) / 3);
    if ($factor > 0) {
        $sz = 'KMGT';
    }
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor - 1] . 'B';
}

/*
 * Task 4
 */
function getResultTaskFourth()
{
    $arrResult = [];
    $arrResult['firstNumber'] = ($colums = htmlspecialchars($_POST['firstNumberTaskFourth']));
    $arrResult['secondNumber'] = ($rows = htmlspecialchars($_POST['secondNumberTaskFourth']));
    $result = '';
    $message = '';
    if (is_numeric($colums) && is_numeric($rows)) {
        $result = "<div id='chessBoard' class='chessBoard'>";
        for ($x = 1; $x <= $rows; $x++) {
            $result .= "<div class='row--board'>";
            for ($y = 0; $y < $colums; $y++) {
                $result .= '<div class="cells ' . (($x + $y) % 2 == 0 ? 'white' : 'black') . '" ></div >';
            };
            $result .= '</div >';
        }
        $result .= '</div >';
        $result .= '<script src = "../js/main.js"></script >';
        $message = "Chess Board size $colums x $rows";
    } else {
        $message = 'Enter the dimension of the chessboard';
    }
    $arrResult['message'] = $message;
    $arrResult['result'] = $result;
    return $arrResult;
}

/*
 * Task 5
 */
function getResultTaskFifth()
{
    $arrResult = [];
    $arrResult['firstNumber'] = ($number = htmlspecialchars($_POST["numberTaskFive"]));
    $result = 0;
    $message = '';
    if (is_numeric($number)) {
        $ten = 10;
        while ($number >= $ten) {
            $result += $number % $ten;
            $number = intdiv($number, $ten);
        }
        $message = 'The sum of numbers of the entered number is equal to ';
        $result += $number % $ten;
    } else {
        $message = 'Enter the number and repeat';
    }

    $arrResult['message'] = $message;
    $arrResult['result'] = $result;
    return $arrResult;
}

/*
 * Task 6
 */
function getResultTaskSixth()
{
    $arrResult = [];

    function random()
    {
        return mt_rand(1, 10);
    }

    function doubleValue($el)
    {
        return $el * 2;
    }

    $arrResult['firstStep']['message'] = 'Starting array';
    $arrResult['firstStep']['result'] = ($array = array_map('random', range(0, 99)));

    $arrResult['secondStep']['message'] = 'Massive without repetitions';
    $arrResult['secondStep']['result'] = ($array = array_unique($array));

    sort($array);
    $arrResult['thirdStep']['message'] = 'Sorted array';
    $arrResult['thirdStep']['result'] = $array;

    $arrResult['fourthStep']['message'] = 'Reversed array';
    $arrResult['fourthStep']['result'] = ($array = array_reverse($array));

    $arrResult['fifthStep']['message'] = 'All array elements are multiplied by two';
    $arrResult['fifthStep']['result'] = array_map('doubleValue', $array);

    return $arrResult;
}

/*
 * Task 8
 */
function getResultTaskEight()
{
    $arrResult = [];
    $arrResult['text'] = ($text = htmlspecialchars($_POST["text"]));

    if (!empty($text)) {

        $result['firstStep']['message'] = 'Number of spaces - ';
        $result['firstStep']['result'] = ($numberSpaces = mb_substr_count($text, ' '));

        $numberLines = mb_substr_count($text, "\r\n");
        $result['secondStep']['message'] = 'Number of lines - ';
        $result['secondStep']['result'] = $numberLines + 1;

        $result['thirdStep']['message'] = 'Number of letters - ';
        $result['thirdStep']['result'] = (mb_strlen($text) - $numberSpaces - ($numberLines === 0 ? $numberLines : $numberLines + 1));

        $result['fourthStep']['message'] = 'len - ';
        $result['fourthStep']['result'] = mb_strlen($text);
        $arrResult['result'] = $result;
    } else {
        $arrResult['message'] = 'Enter a line and repeat';
    }

    return $arrResult;
}
