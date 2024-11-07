<?php
declare(strict_types=1);

namespace App\Config;

use PDO;

class Database
{

    private const  HOST = '127.0.0.1';
    private const  USER = "root";
    private const  PASSWORD = "";
    private const  DBNAME = "todo";
    private static ?self $instance = null;
    private static ?PDO $cnn = null;

    private function __construct()
    {
        $dsn = "mysql:host=" . self::HOST . ";dbname=" . self::DBNAME . ";charset=utf8mb4";

        self::$cnn = new PDO($dsn, self::USER, self::PASSWORD);
        self::$cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return self::$cnn;
    }

    private function __clone()
    {
    }

}


