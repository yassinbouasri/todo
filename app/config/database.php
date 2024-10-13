<?php
class Database
{

    private static $instance;
    private function __construct(){

    }

    public static function getConnection(){
        if(isset(self::$instance)){
            return self::$instance;
        }
        $host = "127.0.0.1";
        $user = "root";
        $password = "";
        $dbname = "todo";

        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";


        self::$instance = new PDO($dsn, $user, $password);

        return self::$instance;
    }

}


