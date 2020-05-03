<?php

include_once ROOT . MESSENGER_MODEL;

class MessengerController
{

    private $data;
    private $action;

    public function __construct($post)
    {
        $this->action = $post['messenger'];
        $this->data = $post['data'];
    }

    public function actionMessenger()
    {
        $messenger = new Messenger($this->data);

        $methodName = 'run' . ucfirst($this->action);
        $result = $messenger->$methodName();
        echo json_encode($result, JSON_FORCE_OBJECT);
    }
}