<?php


namespace app\controllers;

use app\models\Authorization;

class AuthorizationController
{

    private $data;

    public function __construct($post)
    {
        $this->data = $post['user'] ?? null;
    }

    public function actionAuthorization()
    {
        $auth = new Authorization();

        if (is_array($auth::$connect)) {
            echo json_encode($auth::$connect, JSON_FORCE_OBJECT);
            return;
        }
        $result = $auth::isValidUser($this->data);
        if (isset($result['error'])) {
            echo json_encode($result, JSON_FORCE_OBJECT);
            return;
        }

        $result = $auth::checkUserInDatabase();
        if (isset($result['error'])) {
            echo json_encode($result, JSON_FORCE_OBJECT);
            return;
        }

        $_SESSION['user'] = session_id();
        $_SESSION['userId'] = $result['id'];
        echo json_encode(['nameForm' => 'chatForm'], JSON_FORCE_OBJECT);
    }
}