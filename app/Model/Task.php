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
    private DateTime $due_date;
    private string $priority;
    private StatusType $status;
    private int $category_id;
    private int $user_id;
    protected bool $notification_sent;


    public function __construct() {
        parent::__construct($this->table);
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

    public function setDueDate(DateTime $due_date): void
    {
        $this->due_date = $due_date;
    }

    public function getPriority(): string
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
    public function getNotificationSent(): bool
    {
        return $this->notification_sent;
    }

    public function setNotificationSent(bool $notification_sent): void
    {
        $this->notification_sent = $notification_sent;
    }

    protected static function mapAll(array $data): array
    {
        $tasks = [];
        foreach ($data as $row) {
            $tasks[] =  static::mapOne($row);

        }
        return $tasks;
    }

    protected static function mapOne(array $data): static
    {
        $task = new self();
        $task->setId($data["id"]);
        $task->setTaskTitle($data["task_title"]);
        $task->setTaskDescription($data["task_description"]);
        $task->setDueDate(DateTime::createFromFormat("Y-m-d H:i:s",$data["due_date"]));
        $task->setPriority($data["priority"]);
        $task->setStatus(StatusType::from($data["status"]));
        $task->setCategoryId($data["category_id"]);
        $task->setUserId($data["user_id"]);
        $task->setNotificationSent((bool)$data["notification_sent"]);
        return $task;
    }
}
