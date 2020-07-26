<?php

session_start();
define('ROOT', str_replace('/public', '', __DIR__));
require_once ROOT . '/app/AutoLoadClass.php';

$router = new app\Router($_POST);
$router->run();
