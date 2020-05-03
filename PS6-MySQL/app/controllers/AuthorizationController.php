<?php

include_once ROOT . AUTHORIZATION_MODEL;

class AuthorizationController
{

    private $data;

    public function __construct($post)
    {
        $this->data = $post['user'];
    }

    public function actionAuthorization()
    {
        $authorizationObject = new Authorization($this->data);
        $authorization = $authorizationObject->runAuthorization();
        echo json_encode($authorization);
    }
}