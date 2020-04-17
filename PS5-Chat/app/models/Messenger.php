<?php


class Messenger
{

    private $data;
    private $messageBase;
    private $response;

    public function __construct($data)
    {
        $this->messageBase = $this->getMessageList();
        $this->data = $data;
    }

    public function runGetting()
    {
        $this->selectMessages($this->messageBase, $this->data['id']);

        return json_encode($this->response, JSON_FORCE_OBJECT);
    }

    public function runSending()
    {
        $this->sendMessages($this->data);
        return json_encode($this->response, JSON_FORCE_OBJECT);
    }

    private function sendMessages($user)
    {
        if (!file_exists(ROOT . PATH_BASE)) {
            mkdir(ROOT . PATH_BASE);
            chmod(ROOT . PATH_BASE, 0777);
        }

        $messageList = $this->getMessageList();

        $userMessage = array(
            'id' => count($messageList),
            'time' => getdate()['0'],
            'name' => $user['userName'],
            'message' => $user['message']
        );

        array_push($messageList, $userMessage);
        if (file_put_contents(ROOT . MESSAGE_BASE, json_encode($messageList))) {
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

    private function selectMessages($messageList, $id)
    {
        //select messages in the last hour
        $filteredMessageList = array_filter(
            $messageList,
            function ($key) {
                return $key['time'] >= strtotime('-1 hours');
            },
            ARRAY_FILTER_USE_BOTH
        );

        //select messages larger than the given id
        if ((int)$id !== -1) {
            $filteredMessageList = array_filter(
                $filteredMessageList,
                function ($key) use ($id) {
                    return $key['id'] > $id;
                },
                ARRAY_FILTER_USE_BOTH
            );
        }

        $this->setResponse('count', count($filteredMessageList));
        if (count($filteredMessageList) !== 0) {
            $this->setResponse('list', $filteredMessageList);
        }
    }

    private function getMessageList()
    {
        if (!file_exists(ROOT . MESSAGE_BASE)) {
            return [];
        }

        $json = file_get_contents(ROOT . MESSAGE_BASE);
        return json_decode($json, true);
    }

}
