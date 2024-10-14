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

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                'task_title' => $_POST['task_title'],
                'task_description' => $_POST['task_description'],
                'due_date' => $_POST['due_date'],
                'priority' => $_POST['priority'],
                'status' => $_POST['status'],
                'category_id' => $_POST['category_id'],
            );

            // Insert task into the database
            $inserted = $this->task->insert($data);

            if ($inserted) {
                echo "Task added successfully!";
            } else {
                echo "Failed to add task.";
            }
        }
    }

    public function index(){
        require_once __DIR__ . "/../models/tasks.php";
        require_once __DIR__ . "/../models/categories.php";
        require_once __DIR__ . "/../controllers/taskController.php";

        $tasksModel = new Tasks();
        $tasks = $tasksModel->getAllTasks();
        $categoriesModels = new Categories();
        $taskController = new TaskController();

        require_once __DIR__ . "/../views/home.php";
    }

}
