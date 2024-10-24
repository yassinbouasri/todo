<?php
class Database
{

    private static $instance;
    const HOST = '127.0.0.1';
    const USER = "root";
    const PASSWORD = "";
    const DBNAME = "todo";
    private function __construct(){

    }

    public static function getConnection(){
        if(isset(self::$instance)){
            return self::$instance;
        }
        try {
            $dsn = "mysql:host=". self::HOST .";dbname=". self::DBNAME .";charset=utf8mb4";

            self::$instance = new PDO($dsn, self::USER, self::PASSWORD);
        } catch (PDOException $e) {
            die ("Database connection failed: " . $e->getMessage());
        }
        return self::$instance;
    }

}


