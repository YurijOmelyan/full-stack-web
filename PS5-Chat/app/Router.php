<?php

include_once ROOT . '/app/constants.php';
include_once ROOT . PATH_CONTROLLERS . 'ErrorController.php';

class Router
{
    private $routes;
    private $post;

    public function __construct($post)
    {
        $this->routes = include(ROOT . ROOTS);
        $this->post = $post;
    }

    private function setError($codeError)
    {
        $error = new ErrorController(['Router' => $codeError]);
        $error->run();
    }

    public function run()
    {
        if (!$this->post) {
            $this->setError(1);
        }

        $keyPost = array_key_first($this->post);
        if (!array_key_exists($keyPost, $this->routes)) {
            $this->setError(2);
        }
        $controllerName = $keyPost . 'Controller';
        $controllerName = ucfirst($controllerName);


        if (!in_array($this->post[$keyPost], $this->routes[$keyPost])) {
            $this->setError(3);
        }

        $controllerFile = ROOT . PATH_CONTROLLERS . $controllerName . '.php';
        if (!file_exists($controllerFile)) {
            $this->setError(4);
        }

        include_once($controllerFile);

        $controllerObject = new $controllerName($this->post);
        $actionName = 'action' . ucfirst($keyPost);
        $result = $controllerObject->$actionName();
    }
}