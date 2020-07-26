<?php

namespace app\models;

use PDOException;

class Database
{

    private $connect;
    private $statement;
    private $db_config;
    private $db_name;

    public function __construct($setting)
    {
        $this->db_config = $setting['db_config'];
        $this->db_name = $setting['db']['db_name'];
    }

    public function connect()
    {
        $connect = null;
        try {
            $connect = new \PDO(
                "mysql:host={$this->db_config['servername']};
                dbname=",
                $this->db_config['username'],
                $this->db_config['password']
            );
        } catch (PDOException $e) {
            return ['error' => "Could not connect to the database"];
        }
        return $connect;
    }

    public function setConnection()
    {
        if (empty($this->connect)) {
            try {
                $this->connect = new \PDO(
                    "mysql:host={$this->db_config['servername']};
                dbname={$this->db_name}",
                    $this->db_config['username'],
                    $this->db_config['password']
                );
            } catch (PDOException $e) {
                return ['error' => "Could not connect to the database"];
            }
        }
        return true;
    }

    public function prepare($sql)
    {
        if (($this->statement = $this->connect->prepare($sql))) {
            return true;
        }

        return ['error' => 'Error in sql request'];
    }

    public function execute($args = [])
    {
        return $this->statement->execute($args) ? true : ['error' => 'Request failed'];
    }

    public function fetchAll()
    {
        $result = $this->statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function lastInsertId($name)
    {
        return $this->connect->lastInsertId($name);
    }
}