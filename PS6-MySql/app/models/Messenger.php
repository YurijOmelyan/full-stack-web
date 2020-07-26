<?php

namespace app\models;

use app\models\Database as DB;


class Messenger
{
    private static $tableName;
    private static $data;
    private static $db;
    public static $connect;


    public function __construct($data)
    {
        $setting = include(ROOT . DB_SETTING);
        self::$db = new DB($setting);
        self::$tableName = $setting['tables']['table1_name'];
        self::$data = $data;
        self::$connect = self::$db->setConnection();
    }

    public static function isUserAuthorized()
    {
        if (isset($_SESSION['user']) && $_SESSION['user'] === session_id()) {
            return false;
        }

        $result['error']['notAuthorized'] = 'User not authorize';
        $result['error']['nameForm'] = 'authForm';
        return $result;
    }

    public static function getMessages()
    {
        $id = 0;
        if (isset(self::$data['id']) && is_numeric(self::$data['id'])) {
            $id = intval(self::$data['id']);
        }

        $sql = '
            SELECT 
                m.id, 
                UNIX_TIMESTAMP(m.date) AS time, 
                m.message, 
                u.name AS name 
            FROM ' . self::$tableName . ' AS m
            JOIN users AS u ON m.user_id = u.id
            WHERE
                m.date >= DATE_SUB(NOW(), INTERVAL 1 HOUR )
                AND m.id > ?
            ORDER BY m.id';

        if (is_array($result = self::$db->prepare($sql))) {
            return $result;
        }

        if (is_array($result = self::$db->execute([$id]))) {
            return $result;
        }

        $result = self::$db->fetchAll();
        if (($amount = count($result)) === 0) {
            return ['count' => $amount];
        }

        return [
            'count' => $amount,
            'list' => $result
        ];

    }

    public static function setMessages()
    {
        if (!isset(self::$data['message'])) {
            return ['error' => 'no messages'];
        }

        $message = self::$data['message'];
        $userId = $_SESSION['userId'];

        $sql = 'INSERT INTO ' . self::$tableName . ' SET user_id = ?, message = ?';

        if (is_array($result = self::$db->prepare($sql))) {
            return $result;
        }

        if (is_array($result = self::$db->execute([$userId, $message]))) {
            return $result;
        }

        return self::$db->fetchAll();
    }

}
