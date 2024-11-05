<?php
declare(strict_types=1);

namespace App\Config;

use PDO;

class Database
{

    private const string HOST = '127.0.0.1';
    private const string USER = "root";
    private const string PASSWORD = "";
    private const string DBNAME = "todo";
    private static PDO $instance;

    private function __construct()
    {

    }

    public static function getInstance(): PDO
    {
        if (isset(self::$instance)) {
            return self::$instance;
        }
        try {
            $dsn = "mysql:host=" . self::HOST . ";dbname=" . self::DBNAME . ";charset=utf8mb4";

            self::$instance = new PDO($dsn, self::USER, self::PASSWORD);
        } catch (PDOException $e) {
            die ("Database connection failed: " . $e->getMessage());
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return self::$instance;
    }

    public function __clone()
    {
    }

}


