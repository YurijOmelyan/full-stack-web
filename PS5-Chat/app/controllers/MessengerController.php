<?php

include_once ROOT . MESSENGER_MODEL;

class MessengerController
{

    private $data;
    private $action;

    public function __construct($post)
    {
        $this->action = array_shift($post);
        $this->data = array_pop($post);
    }

    public function actionMessenger()
    {
        $messenger = new Messenger($this->data);

        $methodName = 'run' . ucfirst($this->action);
        $result = $messenger->$methodName();
        echo $result;
    }
}