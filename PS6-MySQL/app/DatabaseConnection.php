<?php

include_once ROOT . PATH_CONTROLLERS . 'ErrorController.php';

class DatabaseConnection
{

    private $bdSetting;
    private $link;

    /**
     * DatabaseConnection constructor.
     */
    public function __construct()
    {
        $this->bdSetting = include_once(ROOT . DB_SETTING);
        $this->link = $this->getConnection();
    }

    private function setError($codeError)
    {
        $error = new ErrorController(['DatabaseConnection' => $codeError]);
        $error->run();
    }

    private function getConnection(): object
    {
        $link = mysqli_connect(
            $this->bdSetting['servername'],
            $this->bdSetting['username'],
            $this->bdSetting['password'],
            $this->bdSetting['dbname']
        );

        if (mysqli_connect_errno()) {
            $this->setError('Database Connection Error');
        }

        return $link;
    }

    public function getLink(): object
    {
        return $this->link;
    }

    public function getData($sqlQuery): ?array
    {
        return mysqli_fetch_all(mysqli_query($this->link, $sqlQuery), MYSQLI_ASSOC);
    }

    public function setData($sqlQuery): ?bool
    {
        return mysqli_query($this->link, $sqlQuery);
    }
}