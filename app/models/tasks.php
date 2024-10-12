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
    //changing the badge color for priority and status, according to data fetched from DB.
    public function badge($priorityOrStatus)
    {
        $BadgeClasses = [
            'high' => 'badge badge-high',
            'medium' => 'badge badge-medium',
            'low' => 'badge',
            'in progress' => 'badge badge-medium',
            'completed' => 'badge badge-success',
            'pending' => 'badge',
        ];
        if (isset($BadgeClasses[strtolower($priorityOrStatus)])) {
            return $BadgeClasses[strtolower($priorityOrStatus)];
        }
    }
}