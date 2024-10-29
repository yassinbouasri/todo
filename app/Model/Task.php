<?php
declare(strict_types = 1);

namespace App\Model;
use App\Model\Type\StatusType;
use App\Model\Type\PriorityType;
use DateTime;


class Task extends Model
{
    protected string $table = "tasks";
    protected int $id;
    private string $task_title;
    private string $task_description;
    private string $due_date;
    private string $priority;
    private StatusType $status;
    private int $category_id;
    private int $user_id;
    protected $notification_sent;



    public function __construct() {
        parent::__construct($this->table);
    }
    public function select()
    {

       $tasks =  parent::all();
        $this->setStatus(StatusType::COMPLETED);

        return $tasks;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTaskTitle(): string
    {
        return $this->task_title;
    }

    public function setTaskTitle(string $task_title): void
    {
        $this->task_title = $task_title;
    }

    public function getTaskDescription(): string
    {
        return $this->task_description;
    }

    public function setTaskDescription(string $task_description): void
    {
        $this->task_description = $task_description;
    }

    public function getDueDate(): DateTime
    {
        return $this->due_date;
    }

    public function setDueDate($due_date): void
    {
        $this->due_date = $due_date;
    }

    public function getPriority(): PriorityType
    {
        return $this->priority;
    }

    public function setPriority( $priority): void
    {
        $this->priority = $priority;
    }

    public function getStatus(): StatusType
    {
        return $this->status;
    }

    public function setStatus(StatusType $status): void
    {
        $this->status = $status;
    }


    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): void
    {
        $this->category_id = $category_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function setTable(string $table): void
    {
        $this->table = $table;
    }
    public function getNotificationSent()
    {
        return $this->notification_sent;
    }

    public function setNotificationSent( $notification_sent): void
    {
        $this->notification_sent = $notification_sent;
    }
}
