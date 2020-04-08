<?php


class ErrorController
{
    private $codeError;

    public function __construct($codeError)
    {
        $this->codeError = $codeError;
    }

    public function run()
    {
        echo 'Error code ';
        print_r($this->codeError);
        die;
    }
}