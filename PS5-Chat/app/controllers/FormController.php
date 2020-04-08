<?php

include_once ROOT . FORM_MODEL;

class FormController
{

    private $data;

    public function __construct($post)
    {
        $this->data = array_shift($post);
    }

    private function setError($codeError)
    {
        $error = new ErrorController(['FormController' => $codeError]);
        $error->run();
    }

    public function actionForm()
    {
        $formObject = new Form($this->data);
        $form = $formObject->getForm();

        if (!include_once $form) {
            $this->setError(1);
        }
    }
}