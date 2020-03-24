<?php

include_once 'appConstants.php';


function redirect()
{
    header("Location: ../index.php");
    exit;
}

$pathBase = '../' . PATH_BASE;
$jsonBase = file_get_contents($pathBase);
$arr = json_decode($jsonBase, true);

$key = $_POST['selectedValue'];

if (!isset($_POST['selectedValue']) || !in_array($key, $arr)) {
    redirect();
}

$resultArr = 0;
$pathResult = '../' . PATH_RESULT_VOTING;
if (file_exists($pathResult)) {
    $jsonResult = file_get_contents($pathResult);
    $resultArr = json_decode($jsonResult, true);
}

if ($resultArr === 0) {
    $resultArr = array_fill_keys($arr, 0);
}

$resultArr[$key]++;
file_put_contents($pathResult, json_encode($resultArr));

header("Location: ../votingResults.php");

