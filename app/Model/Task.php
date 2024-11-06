<?php
declare(strict_types = 1);

namespace App\Model;
use App\Model\Type\StatusType;
use App\Model\Type\PriorityType;
use DateTime;


class Task extends Model
{
    protected static ?string $table = "tasks";

    public ?int $id;
    public ?string $task_title;
    public ?string $task_description;
    public ?DateTime $due_date;
    public ?PriorityType $priority;
    public ?StatusType $status;
    public ?int $category_id;
    public ?int $user_id;
    public ?int $notification_sent;

    public function __construct(?int $id = null, ?string $task_title = "", ?string $task_description = "", ?string $due_date = null, ?PriorityType $priority = PriorityType::NONE, $status = StatusType::NONE, int $category_id = null, int $user_id = null)
    {
        parent::__construct();
        $this->id = $id ?? null;
        $this->task_title = $task_title ?? "";
        $this->task_description = $task_description ?? "";
        $this->due_date = $due_date ?? null;
        $this->priority = $priority ?? PriorityType::NONE;
        $this->status = $status ?? StatusType::NONE;
        $this->category_id = $category_id ?? 0;
        $this->user_id = $user_id ?? 0;
        $this->notification_sent = $notification_sent ?? 0;
    }


    public function getId(): ?int
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

    public function getPriority(): PriorityType
    {
        return $this->priority;
    }

    public function setPriority(PriorityType $priority): void
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


    public function getNotificationSent(): int
    {
        return $this->notification_sent;
    }

    public function setNotificationSent(int $notification_sent): void
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

    protected static function mapOne( $data)
    {
//        $task = new self();
//        $task->setId($data["id"]);
//        $task->setTaskTitle($data["task_title"]);
//        $task->setTaskDescription($data["task_description"]);
//        $task->setDueDate(DateTime::createFromFormat("Y-m-d H:i:s",$data["due_date"]));
//        $task->setPriority($data["priority"]);
//        $task->setStatus(StatusType::from($data["status"]));
//        $task->setCategoryId($data["category_id"]);
//        $task->setUserId($data["user_id"]);
//        $task->setNotificationSent((bool)$data["notification_sent"]);
//        return $task;
    }
}
