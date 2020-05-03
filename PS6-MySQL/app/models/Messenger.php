<?php

include_once ROOT . PATH_APP . DATABASE_CONNECTION;

class Messenger
{

    private $data;
    private $response;
    private $bd;


    public function __construct($data)
    {
        $this->data = $data;
        $this->bd = new DatabaseConnection();
    }

    public function runGetting(): array
    {
        $this->selectMessages($this->data['id']);

        return $this->response;
    }

    public function runSending(): array
    {
        $this->sendMessages($this->data['message']);
        return $this->response;
    }

    private function sendMessages($message)
    {
        $sql = 'INSERT INTO messages SET ';
        $sql .= 'id_user = ' . $_SESSION['userId'] . ',';
        $sql .= 'message = "' . mysqli_real_escape_string($this->bd->getLink(), $message) . '"';

        if ($this->bd->setData($sql)) {
            $this->setResponse('result', 'successfully');
        } else {
            $this->setResponse('result', 'not successful');
        }
    }

    /*
     * set server response
     */
    private function setResponse($key, $value)
    {
        $this->response[$key] = $value;
    }

    private function selectMessages($messageId)
    {
        if (!settype($messageId, 'int')) {
            $this->setResponse('count', 0);
        }

        $sql = 'SELECT messages.id, UNIX_TIMESTAMP(messages.message_date) AS time, ';
        $sql .= 'messages.message, users.user_name AS name FROM messages ';
        $sql .= 'JOIN users ON messages.id_user = users.id ';
        $sql .= "WHERE message_date >= DATE_SUB(NOW(), INTERVAL 1 HOUR ) AND messages.id > $messageId ORDER BY id";

        $result = $this->bd->getData($sql);

        $this->setResponse('count', count($result));
        if (count($result) !== 0) {
            $this->setResponse('list', $result);
        }
    }

}
