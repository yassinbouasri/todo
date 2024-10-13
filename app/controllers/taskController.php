<?php
require_once __DIR__ .  "/../models/categories.php";
require_once __DIR__ .  "/../models/tasks.php";
class TaskController {
    private $task;
    public function __construct() {
        $this->task = new tasks();
    }
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

    public function create(){
        $categoriesModel = new Categories();
        $categories = $categoriesModel->getAllCategories();

        require_once __DIR__ .  "/../views/addTask.php";

        $tasksModel = new Tasks();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $taskTile = $_POST["taskTile"];
            $taskDescription = $_POST["taskDescription"];
            $dueDate = $_POST["dueDate"];
            $priority = $_POST["priority"];
            $status = $_POST["status"];
            $category_id = $_POST["category_id"];
            $result = $this->task->save($taskTile, $taskDescription, $dueDate, $priority, $status, $category_id);
            if ($result == "success") {
                echo "<div class='alert alert-success alert-dismissible fade in' role='alert'>";
            } else {
                echo "<div class='alert alert-danger alert-dismissible fade in' role='alert'>";
            }
        }

    }

}
