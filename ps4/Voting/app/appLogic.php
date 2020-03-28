<?php

include_once 'appConstants.php';

main();

function main()
{
    $arr = getVotingList();
    $key = $_POST['selectedValue'];

    if (!isset($_POST['selectedValue']) || !in_array($key, $arr)) {
        redirect();
    }

    $pathResult = '../' . PATH_RESULT_VOTING;
    $resultArr = getResultVotingFromBase($pathResult);

    if ($resultArr === 0) {
        $resultArr = array_fill_keys($arr, 0);
    }

    saveVotingResult($resultArr,$key,$pathResult);

    header("Location: ../votingResults.php");

}

function saveVotingResult($arr, $key,$path){
    $arr[$key]++;
    file_put_contents($path, json_encode($arr));
}

function getResultVotingFromBase($path)
{
    if (!file_exists($path)) {
        return 0;
    }

    $jsonResult = file_get_contents($path);
    return json_decode($jsonResult, true);
}

function getVotingList()
{
    $pathBase = '../' . PATH_BASE;
    $jsonBase = file_get_contents($pathBase);
    return json_decode($jsonBase, true);
}

function redirect()
{
    header("Location: ../index.php");
    exit;
}
