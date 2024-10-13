<?php


require_once __DIR__ .  "/../config/database.php";


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

    public function save($taskTitle, $taskDescription, $status, $priority, $category_id){
        $sql = "INSERT INTO tasks (task_title, task_description, status, priority, category_id) 
                VALUES (:task_title, :task_description, :status, :priority, :category_id)";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(":task_title", $taskTitle);
        $stmt->bindParam(":task_description", $taskDescription);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":priority", $priority);
        $stmt->bindParam(":category_id", $category_id);

        if($stmt->execute()){
            return "success";
        } else {
            return "error";
        }


    }
}