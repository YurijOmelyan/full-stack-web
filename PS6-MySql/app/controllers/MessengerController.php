<?php

namespace app\controllers;

use app\models\Messenger;

class MessengerController
{

    private $data;
    private $action;

    public function __construct($post)
    {
        $this->action = $post['action']??null;
        $this->data = $post['data']??null;
    }

    public function actionMessenger()
    {
        $messenger = new Messenger($this->data);

        if (is_array($messenger::$connect)) {
            echo json_encode($messenger::$connect, JSON_FORCE_OBJECT);
            return;
        }

        $result = $messenger::isUserAuthorized();
        if (isset($result['error'])) {
            echo json_encode($result, JSON_FORCE_OBJECT);
            return;
        }
        $action = $this->action . 'Messages';

        if (!method_exists($messenger, $action)) {
            echo json_encode(['error' => 'There is no such method'], JSON_FORCE_OBJECT);
            return;
        }

        echo json_encode($messenger::$action(), JSON_FORCE_OBJECT);
    }
}