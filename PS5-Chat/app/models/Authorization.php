<?php


class Authorization
{
    private $user;
    private $response = [];
    private $userBase;

    public function __construct($userData)
    {
        $this->user = $userData;
        $this->userBase = $this->loadUserDatabase();
    }


    public function runAuthorization()
    {
        if (!$this->isValidatePasswordAndUsername()) {
            return json_encode($this->response);
        }


        if (!($this->isThisUserInDatabase($this->user, $this->userBase))) {
            $this->addNewUserToDatabase($this->user, $this->userBase);
            return json_encode($this->response);
        }


        if ($this->isPasswordMatchThisUser($this->user, $this->userBase)) {
            $this->getChatForm();
        } else {
            $this->setResponse('pass', 'The password you entered does not match this user');
        }

        return json_encode($this->response);
    }

    /*
     * validation of password and login
     */
    private function isValidatePasswordAndUsername()
    {
        $check = true;
        if (strlen($this->user['name']) === 0) {
            $this->setResponse('name', 'Enter username');
            $check = false;
        }

        if (strlen($this->user['pass']) < 6) {
            $this->setResponse('pass', 'Enter a password greater than 6 characters');
            $check = false;
        }
        return $check;
    }

    /*
     * set server response
     */
    private function setResponse($key, $value)
    {
        $this->response[$key] = $value;
    }

    /*
     * 
     */
    private function isPasswordMatchThisUser($user, $userBase)
    {
        return password_verify($user['pass'], $userBase[$user['name']]);
    }

    private function isThisUserInDatabase($user, $userBase)
    {
        return $userBase && array_key_exists($user['name'], $userBase);
    }

    function getChatForm()
    {
        $this->setResponse('form', file_get_contents(ROOT . PATH_FORM . CHAT_FORM));
    }

    private function addNewUserToDatabase($user, $userBase)
    {
        if (!file_exists(ROOT . PATH_BASE)) {
            mkdir(ROOT . PATH_BASE);
            chmod(ROOT . PATH_BASE, 0777);
        }

        $userBase[$user['name']] = password_hash($user['pass'], PASSWORD_DEFAULT);
        if ((bool)file_put_contents(ROOT . USER_BASE, json_encode($userBase))) {
            $this->getChatForm();
        } else {
            $this->setError(1);
        }
    }

    private function loadUserDatabase()
    {
        if (!file_exists(ROOT . USER_BASE)) {
            return [];
        }

        $jsonResult = file_get_contents(ROOT . USER_BASE);
        return json_decode($jsonResult, true);
    }

    private function setError($codeError)
    {
        $error = new ErrorController(['Authorization' => $codeError]);
        $error->run();
    }
}

