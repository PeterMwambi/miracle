<?php

namespace Models\Core\App\Database\Kernel;

defined("ALLOW_DBCONNECT_ACCESS") or Exit("Connect Warning: You are not allowed to access this script");

use Models\Core\App\Database\Kernel\Config;
use PDO;
use PDOException;

final class Connect
{

    private $conn;

    private $message;

    private static $instance;


    private function __construct()
    {
        try {
            $config = new Config;
            $this->conn = new PDO(
                "mysql:host=" . $config->GetHost() .
                ";dbname=" . $config->GetDBName(),
                $config->GetUsername(),
                $config->GetPassword(),
            );
        } catch (PDOException $e) {
            $this->message = $e->getMessage();
        }

    }

    public function GetLiveConnection()
    {
        return $this->conn;
    }


    public function GetConnectionErrorMessage()
    {
        return $this->message;
    }

    public function CheckConnection()
    {
        if (empty($this->message)) {
            return true;
        }
        return false;
    }

    public static function Start()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Connect;
        }
        return self::$instance;
    }

}