<?php

include_once ROOT . PATH_APP . DATABASE_CONNECTION;

class Authorization
{
    private $user;
    private $response = [];
    private $bd;
    private $userInDataBase;

    public function __construct($userData)
    {
        $this->user = $userData;
        $this->bd = new DatabaseConnection();
    }


    public function runAuthorization(): array
    {
        if (!$this->isValidatePasswordAndUsername()) {
            return $this->response;
        }


        if (!($this->isThisUserInDatabase($this->user))) {
            $this->addNewUserToDatabase($this->user);
            return $this->response;
        }

        if ($this->isPasswordMatchThisUser($this->user)) {
            $this->getChatForm();
        } else {
            $this->setResponse('pass', 'The password you entered does not match this user');
        }

        return $this->response;
    }

    /*
     * validation of password and login
     */
    private function isValidatePasswordAndUsername(): bool
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
    private function isPasswordMatchThisUser($user): bool
    {
        return password_verify($user['pass'], $this->userInDataBase[0]['password']);
    }

    private function isThisUserInDatabase($user): bool
    {
        $name = mysqli_real_escape_string($this->bd->getLink(), $user['name']);
        $sql = "SELECT * FROM users WHERE user_name = '$name'";
        $result = $this->bd->getData($sql);
        if ($result) {
            $this->userInDataBase = $result;
        }

        return (bool)$result;
    }

    function getChatForm()
    {
        $name = mysqli_real_escape_string($this->bd->getLink(), $this->user['name']);
        $sql = "SELECT id FROM users WHERE user_name ='$name'";
        $_SESSION['userId'] = $this->bd->getData($sql)[0]['id'];

        $this->setResponse('form', file_get_contents(ROOT . PATH_FORM . CHAT_FORM));
    }

    private function addNewUserToDatabase($user)
    {
        $sql = 'INSERT INTO users SET ';
        $sql .= 'user_name = "' . mysqli_real_escape_string($this->bd->getLink(), $user['name']);
        $sql .= '",password = "' . password_hash($user['pass'], PASSWORD_DEFAULT) . '"';

        if ($this->bd->setData($sql)) {
            $this->getChatForm();
        } else {
            $this->setError('Error writing new user to database');
        }
    }

    private function setError($codeError)
    {
        $error = new ErrorController(['Authorization' => $codeError]);
        $error->run();
    }
}

