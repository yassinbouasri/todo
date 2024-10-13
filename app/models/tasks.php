<?php


require_once "../config/database.php";


class Tasks
{
    private $db;
    function __construct(){
        $this->db = Database::getConnection();
    }
    public function getAllTasks(){
        $sql = "SELECT * FROM tasks";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //changing the badge color for priority and status, according to data fetched from DB.

    public function addTask($id, $taskTitle, $taskDescription, $status, $priority, $category_id){

    }
}