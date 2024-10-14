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

    public function insert($data = array()) {
        $sql = "INSERT INTO tasks (task_title, task_description, due_date, priority, status, category_id) 
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        // Ensure the values are in the correct order
        return $stmt->execute([
            $data['task_title'],
            $data['task_description'],
            $data['due_date'],
            $data['priority'],
            $data['status'],
            $data['category_id']
        ]); // Return true on success, false on failure
    }
}