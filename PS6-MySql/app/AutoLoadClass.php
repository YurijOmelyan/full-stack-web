<?php

spl_autoload_register(
    function ($className) {
        $classArray = [
            'controllers' => 'app/controllers/',
            'models' => 'app/models/',
            'app' => 'app/'
        ];

        $arr = explode('\\', $className);
        $name = array_pop($arr);

        $path = '';
        if (isset($classArray[$arr[array_key_last($arr)]])) {
            $path = $classArray[$arr[array_key_last($arr)]];
        }

        $fileClass = ROOT . DIRECTORY_SEPARATOR . $path . $name . '.php';

        if (file_exists($fileClass)) {
            return require($fileClass);
        }
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
        include 'view/404.html';
        exit;
    }
    ,
    true,
    true
);