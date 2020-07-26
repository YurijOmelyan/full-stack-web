<?php

namespace app;

use app\controllers\MigrationController;
use mysql_xdevapi\Exception;

include_once ROOT . '/app/constants.php';

class Router
{

    private $post;

    public function __construct($post)
    {
        MigrationController::actionMigration();
        $this->post = $post;
    }


    public function run()
    {
        try {

            if ($_SERVER['REQUEST_URI'] === DIRECTORY_SEPARATOR) {
                $name = 'form';
            } else {
                $array = explode(DIRECTORY_SEPARATOR, $_SERVER['REQUEST_URI']);
                $name = array_pop($array);
            }

            if ($name === 'logout') {
                unset($_SESSION['user']);
                unset($_SESSION['userId']);
                header('Location: http://' . $_SERVER['HTTP_HOST']);
                exit;
            }

            $controllerClass = 'app\\controllers\\' . ucfirst($name) . 'Controller';
            $controllerObject = new $controllerClass($this->post);
            $actionName = 'action' . ucfirst($name);
            $controllerObject->$actionName();
        } catch (Exception $e) {
            echo 'An error has occurred ' . $e->getMessage();
        }

    }
}