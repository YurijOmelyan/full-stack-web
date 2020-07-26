<?php

namespace app\models;

class Form
{
    private static $fileForm;

    /**
     * Form constructor.
     */
    public function __construct($nameForm)
    {
        self::$fileForm = ROOT . PATH_FORM . $nameForm . '.php';
    }

    public static function isValidForm(): bool
    {
        return file_exists(self::$fileForm);
    }

    public static function getForm(): array
    {
        ob_start();
        include_once self::$fileForm;
        $content = ob_get_contents();
        ob_end_clean();
        return ['form' => $content];
    }
}
