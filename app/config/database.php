<?php
class Database
{

    private static $instance;
    private const string HOST = '127.0.0.1';
    private const string USER = "root";
    private const string PASSWORD = "";
    private const string DBNAME = "todo";
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


