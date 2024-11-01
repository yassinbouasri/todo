<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Mail\Mailer;
use App\Model\CategoryRepository;
use App\Model\Task;
use App\Model\TaskRepository;
use App\Model\Category;

use App\Model\Type\PriorityType;
use App\Model\Type\StatusType;
use DateTime;


class TaskController extends Controller
{
    private TaskRepository $taskRepository;
    private CategoryRepository $categoryRepository;


    private Mailer $mailer;
    private CategoryController $categoryController;
    private Task $task;
    public Category $category;
    public function __construct() {
        checkSession();
        $this->taskRepository = new TaskRepository();
        $this->categoryRepository = new CategoryRepository();
        $this->mailer = new Mailer();
        $this->categoryController = new CategoryController();
        $this->task = new Task();
        $this->category = new Category();
    }
    public function getCategoryController(): CategoryController
    {
        return $this->categoryController;
    }
    public function badge(string $priorityOrStatus): ?string
    {
        $BadgeClasses = [
            'high' => 'badge badge-high',
            'medium' => 'badge badge-medium',
            'low' => 'badge',
            'in progress' => 'badge badge-medium',
            'completed' => 'badge badge-success',
            'pending' => 'badge',
        ];

        return (isset($BadgeClasses[strtolower($priorityOrStatus)])) ? $BadgeClasses[strtolower($priorityOrStatus)] : null;
    }

    public function create(): void
    {

        $categories = $this->categoryRepository->getAllCategories();


        $alertMessage = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = array(
                'task_title' => $_POST['task_title'],
                'task_description' => $_POST['task_description'],
                'due_date' => DateTime::createFromFormat('Y-m-d H:i', $_POST['due_date'])->format('Y-m-d H:i:s'),
                'priority' => $_POST['priority'],
                'status' => $_POST['status'],
                'category_id' => $_POST['category_id'],
                'user_id' => $_SESSION['id'],
            );
            // Insert task into the database
            $inserted = $this->taskRepository->insert($data);

            $alertMessage = ($inserted) ? "<div class='alert alert-success' role='alert'>Task added successfully!</div>" :
                        "<div class='alert alert-danger' role='alert'>Something went wrong!</div>";

        }
        $this->render('addTask', ["alertMessage" => $alertMessage, "categories" => $categories]);

    }

    /**
     * @throws DateMalformedStringException
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function index(): void
    {
        $notifyTask = $this->sendNotification();

        $tasksPerPage = 6;

        $totalTasks = $this->task::count();
        $totalPages = ceil($totalTasks / $tasksPerPage);

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $currentPage = ($currentPage < 1) ? 1 : $currentPage;

        $offset = ($currentPage - 1) * $tasksPerPage;
        $user_id = $_SESSION['id'];
        //$tasks = $this->taskRepository->getAllTasks($tasksPerPage, $offset,$user_id);
        $tasks = $this->task::findBy([],["due_date" => "ASC"],$currentPage,$tasksPerPage);

        $this->render("home", [
            "tasks" => $tasks,
            "totalPages" => $totalPages,
            "currentPage" => $currentPage,
            "totalTasks" => $totalTasks,
            "notifyTask" => $notifyTask,
        ]);

    }
    public function show(int $id): mixed
    {


        $tasksModel = $this->taskRepository->getTaskById($id);

        $color = '';
        if ($tasksModel) {
            $categoryId = $tasksModel['category_id'];
            $category = $this->categoryRepository->getCategoryById($categoryId);

            $color = ($tasksModel['status'] == 'Completed') ? 'status completed' : $color = 'status in-progress';
            $this->render("tasks/show", [
                "tasksModel" => $tasksModel,
                "category" => $category,
                "color" => $color
            ]);

            return $tasksModel;
        } else {
             echo "No Tasks Found for this ID";
             exit();
        }

    }

    /**
     * @throws DateMalformedStringException
     */
    public function remove(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $this->taskRepository->delete($id);
        }
        $this->index();
    }
    public  function update(int $id): void
    {
        $alertMessage = "";
        $statusOptions = ['In Progress', 'Completed', 'Pending'];
        $priorityOptions = ['High', 'Medium', 'Low'];

        $tasks = $this->taskRepository->getTaskById($id);
        $AllCategories = $this->categoryRepository->getAllCategories();


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = (int)$_POST['id'];
            $task_title = $_POST['task_title'];
            $task_description = $_POST['task_description'];
            $due_date = DateTime::createFromFormat('Y-m-d H:i', $_POST['due_date'])->format('Y-m-d H:i:s');
            $priority = $_POST['priority'];
            $status = $_POST['status'];
            $category_id = (int)$_POST['category_id'];

            $updated = $this->taskRepository->update($id, $task_title, $task_description, $due_date, $priority, $status, $category_id);

            $alertMessage = ($updated) ? "<div class='alert alert-success' role='alert'>Task updated successfully!</div>" :
                            "<div class='alert alert-danger' role='alert'>Something went wrong!</div>";
            $tasks = $this->taskRepository->getTaskById($id);
        }
        $this->render("tasks/updateTask", [
            "statusOptions" => $statusOptions,
            "priorityOptions" => $priorityOptions,
            "tasks" => $tasks,
            "alertMessage" => $alertMessage,
            "AllCategories" => $AllCategories,
        ]);

    }

    /**
     * @throws DateMalformedStringException
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function sendNotification(): false|array
    {

        $emails = [];
        $taskIds = [];
        $selectedTasks = $this->taskRepository->notificationTasks();
        $body = "Hello,<br><br>";
        $body .= "We hope you're doing well! This is a friendly reminder about your upcoming tasks that are due soon.<br><br>";
        $body .= "Here are the tasks approaching their deadlines:<br><br>";

        foreach ($selectedTasks as $task) {
            $body .= "- {$task['task_title']}: Due on {$task['due_date']}<br>";
            $taskIds[] = $task['id'];
            $emails[] = $task['email'];
        }
        $body .= "<br>Please make sure to complete them before the due date. If you have any questions or need assistance, feel free to reach out to us.<br><br>";
        $body .= "Best regards,<br>";
        $body .= "Todo App Team";
        $subject = "Reminder: Upcoming Tasks Due Soon";



        foreach ($emails as $email) {

            if ($this->mailer->sendEmail($email,$subject ,$body)){
                $this->taskRepository->setNotificationSent($taskIds, $email);
            }

        }

        return $selectedTasks;

    }
}
