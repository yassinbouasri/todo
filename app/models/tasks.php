<?php


require_once "../config/database.php";


class Tasks
{
    private $db;
    function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
    }
    public function getAllTasks(){
        $sql = "SELECT * FROM tasks";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}