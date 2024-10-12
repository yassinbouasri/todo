<?php
class Database
{
    private $pdo;
    public function __construct(){
        $host = "localhost";
        $user = "root";
        $password = "";
        $dbname = "todo";

        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

        try {
            $this->pdo = new PDO($dsn, $user, $password);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getConnection(){
        return $this->pdo;
    }

}


