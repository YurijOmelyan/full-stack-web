<?php

define('ROOT', dirname(__FILE__));
require_once(ROOT . '/app/Router.php');

$router = new Router($_POST);
$router->run();
