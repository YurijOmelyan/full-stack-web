<?php

namespace app\controllers;

use app\models\Form;

class FormController
{

    private $data;

    public function __construct($post)
    {
        $this->data = $post['formName'] ?? null;
        $this->isUserAuthorized();
    }

    public function actionForm()
    {
        $formObject = new Form($this->data ?? 'index');

        if ($formObject::isValidForm()) {
            $result = $formObject::getForm();
            echo $this->data ?
                json_encode($result, JSON_FORCE_OBJECT) :
                $result['form'];
            return;
        }
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
    }

    private function isUserAuthorized()
    {
        if (isset($_SESSION['user'])
            && $_SESSION['user'] === session_id()
            && $this->data === 'authForm') {
            $this->data = 'chatForm';
        }
    }
}