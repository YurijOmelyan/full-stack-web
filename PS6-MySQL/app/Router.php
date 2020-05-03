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
            $this->setError('No data in the array');
        }

        $keyPost = array_key_first($this->post);
        if (!isset($this->routes[$keyPost])) {
            $this->setError('The data does not match the pattern.');
        }
        $controllerName = $keyPost . 'Controller';
        $controllerName = ucfirst($controllerName);


        if (!in_array($this->post[$keyPost], $this->routes[$keyPost])) {
            $this->setError('There is no such data in the template.');
        }

        $controllerFile = ROOT . PATH_CONTROLLERS . $controllerName . '.php';
        if (!file_exists($controllerFile)) {
            $this->setError('Error opening controller file');
        }

        include_once($controllerFile);

        $controllerObject = new $controllerName($this->post);
        $actionName = 'action' . ucfirst($keyPost);
        $controllerObject->$actionName();
    }
}