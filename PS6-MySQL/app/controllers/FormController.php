<?php

include_once ROOT . FORM_MODEL;

class FormController
{

    private $data;

    public function __construct($post)
    {
        $this->data = $post['form'];
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
            $this->setError('Form file not found');
        }
    }
}