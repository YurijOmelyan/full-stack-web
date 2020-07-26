<?php

namespace app\models;

use app\models\Database as DB;

class Authorization
{
    private static $user = [];
    private static $db;
    private static $tableName;
    public static $connect;


    public function __construct()
    {
        $setting = include(ROOT . DB_SETTING);
        self::$db = new DB($setting);
        self::$tableName = $setting['tables']['table2_name'];
        self::$connect = self::$db->setConnection();
    }

    public static function isValidUser($userData): array
    {
        if (is_array(self::$connect)) {
            return self::$connect;
        }
        $result = [];
        if (!isset($userData['name'])
            || strlen($userData['name']) < 1
            || strlen($userData['name']) > 20
            || $userData['name'] !== htmlspecialchars($userData['name'])) {
            $result['error']['name'] = 'Login does not match the template. Enter a login with a length of 1 to 20 characters with A-Z, a-z, 0-9, characters';
        }

        if (!isset($userData['pass'])
            || strlen($userData['pass']) < 6
            || strlen($userData['pass']) > 16) {
            $result['error']['pass'] = 'Password does not match the pattern. Enter a password between 6 and 16 characters';
        }

        if (count($result) === 0) {
            self::$user = [
                'name' => $userData['name'],
                'pass' => $userData['pass']
            ];
        }

        return $result;
    }

    public static function checkUserInDatabase(): array
    {
        $sql = 'SELECT * FROM ' . self::$tableName . ' WHERE name =?';
        if (is_array($result = self::$db->prepare($sql))) {
            return $result;
        }

        if (is_array($result = self::$db->execute([self::$user['name']]))) {
            return $result;
        }

        $result = self::$db->fetchAll();
        if (count($result) === 0) {
            return self::addТNewUserDatabase();
        } elseif (count($result) === 1
            && password_verify(self::$user['pass'], $result[0]['pass'])) {
            return $result[0];
        }

        return ['error' => 'The password you entered does not match this user'];
    }

    private static function addТNewUserDatabase(): array
    {
        $sql = 'INSERT INTO ' . self::$tableName . ' SET name=?, pass=?';

        if (is_array($result = self::$db->prepare($sql))) {
            return $result;
        }


        if (is_array(
            $result = self::$db->execute(
                [
                    self::$user['name'],
                    password_hash(self::$user['pass'], PASSWORD_DEFAULT)
                ]
            )
        )) {
            return $result;
        }
        self::$db->fetchAll();
        return ['id' => self::$db->lastInsertId('id')];
    }
}

