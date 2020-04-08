<?php

include_once ROOT . AUTHORIZATION_MODEL;

class AuthorizationController
{

    private $data;

    public function __construct($post)
    {
        $this->data = array_pop($post);
    }

    public function actionAuthorization()
    {
        $authorizationObject = new Authorization($this->data);
        $authorization = $authorizationObject->runAuthorization();
        echo $authorization;
    }
}