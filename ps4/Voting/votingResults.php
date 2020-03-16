<?php
$resultArr = 0;

if (isset($_POST['selectedValue'])) {
    $dir = $_SERVER['DOCUMENT_ROOT'] . '/base/';
    $file = $dir . 'base.json';
    $jsonBase = file_get_contents($file);
    $arr = json_decode($jsonBase, true);

    $key = $_POST['selectedValue'];
    if (!in_array($key, $arr)) {
        header("Location: index.php");
        exit;
    }

    $file = $dir . 'result.json';
    if (file_exists($file)) {
        $json = file_get_contents($file);
        $resultArr = json_decode($json, true);
    }

    if ($resultArr === 0) {
        $resultArr = array_fill_keys($arr, 0);
    }

    $resultArr[$key] = $resultArr[$key] + 1;
    file_put_contents($file, json_encode($resultArr));

} else {
    header("Location: index.php");
    exit;
}

?>
<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
</head>
<body>
<div id="piechart" style="width: 900px; height: 500px;"></div>
<script> draw(<?=file_get_contents($file)?>)</script>
</body>
</html>