<?php
require_once __DIR__ .  "/../helpers.php";
require_once __DIR__ .  "/../models/categories.php";
require_once __DIR__ .  "/../models/tasks.php";
class TaskController {
    private $task;
    private $categories;
    public function __construct() {
        checkSession();
        $this->task = new tasks();
        $this->categories = new Categories();
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


        $alertMessage = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = array(
                'task_title' => $_POST['task_title'],
                'task_description' => $_POST['task_description'],
                'due_date' => DateTime::createFromFormat('Y-m-d H:i', $_POST['due_date'])->format('Y-m-d H:i:s'),
                'priority' => $_POST['priority'],
                'status' => $_POST['status'],
                'category_id' => $_POST['category_id'],
            );
            // Insert task into the database
            $inserted = $this->task->insert($data);

            if ($inserted) {
                $alertMessage = "<div class='alert alert-success' role='alert'>Task added successfully!</div>";
            } else {
                $alertMessage = "<div class='alert alert-danger' role='alert'>Something went wrong!</div>";
            }

        }
        require_once __DIR__ .  "/../views/addTask.php";
    }

    public function index(){

        require_once __DIR__ . "/../models/tasks.php";
        require_once __DIR__ . "/../models/categories.php";
        require_once __DIR__ . "/../controllers/taskController.php";

        $tasksPerPage = 6;
        $totalTasks = $this->task->getTotalTasks();

        $totalPages = ceil($totalTasks / $tasksPerPage);

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($currentPage < 1) {
            $currentPage = 1;
        }

        $offset = ($currentPage - 1) * $tasksPerPage;

        $tasksModel = new Tasks();
        $tasks = $this->task->getAllTasks($tasksPerPage, $offset);
        $categoriesModels = new Categories();
        $taskController = new TaskController();


        require_once __DIR__ . "/../views/home.php";
    }
    public function show(){
        require_once __DIR__ . "/../models/tasks.php";
        require_once __DIR__ . "/../models/categories.php";

        $id = $_GET['id'];

        $tasksModels = new Tasks();

        $tasksModel = $tasksModels->getTaskById($id);
        $categoryId = $tasksModel['category_id'];
        $color = '';
        if (isset($tasksModel)) {
            $categoriesModels = new Categories();
            $category = $categoriesModels->getCategoryById($categoryId);

            if ($tasksModel['status'] == 'Completed') {
                $color = 'status completed';
            } else if ($tasksModel['status'] == 'In Progress') {
                $color = 'status in-progress';
            }
            require_once __DIR__ . "/../views/tasks/show.php";
            return $tasksModel;
        }

    }

    public function remove(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $result = $this->task->delete($id);
            if ($result) {
                $alertMessage = "<div class='alert alert-success' role='alert'>Task deleted successfully!</div>";
            } else {
                $alertMessage = "<div class='alert alert-danger' role='alert'>Something went wrong!</div>";
            }
        }
        $this->index();
    }
    public  function update(){
        $statusOptions = ['In Progress', 'Completed', 'Pending'];
        $priorityOptions = ['High', 'Medium', 'Low'];



        $tasks = $this->task->getTaskById($_GET['id']);
        $AllCategories = $this->categories->getAllCategories();



        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $task_title = $_POST['task_title'];
            $task_description = $_POST['task_description'];
            $due_date = DateTime::createFromFormat('Y-m-d H:i', $_POST['due_date'])->format('Y-m-d H:i:s');
            $priority = $_POST['priority'];
            $status = $_POST['status'];
            $category_id = $_POST['category_id'];

            $updated = $this->task->update($id, $task_title, $task_description, $due_date, $priority, $status, $category_id);

            if ($updated) {
                $alertMessage = "<div class='alert alert-success' role='alert'>Task updated successfully!</div>";

            } else {
                $alertMessage = "<div class='alert alert-danger' role='alert'>Something went wrong!</div>";
            }
            $tasks = $this->task->getTaskById($id);
        }

        require_once __DIR__ . "/../views/tasks/updateTask.php";
    }

}
