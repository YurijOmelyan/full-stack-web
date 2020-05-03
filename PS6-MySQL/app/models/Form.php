<?php

class Form
{

    private $nameForm;

    public function __construct($nameForm)
    {
        $this->nameForm = $nameForm;
    }

    private function setError($codeError)
    {
        $error = new ErrorController(['Form' => $codeError]);
        $error->run();
    }

    public function getForm(): string
    {
        $fileForm = ROOT . PATH_FORM . $this->nameForm . '.php';
        if (!file_exists($fileForm)) {
            $this->setError('Not found form file');
        }
        return $fileForm;
    }
}
