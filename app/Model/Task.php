<?php
declare(strict_types = 1);

namespace App\Model;
use App\Type\PriorityType;
use App\Type\StatusType;
use DateTime;


class Task
{
    private int $id;
    private string $task_title;
    private string $task_description;
    private DateTime $due_date;
    private PriorityType $priority;
    private StatusType $status;
    private int $category_id;
    private int $user_id;

    public function __construct(int $id, string $task_title, string $task_description, DateTime $due_date, PriorityType $priority, StatusType $status, int $category_id, int $user_id) {
        $this->id = $id;
        $this->task_title = $task_title;
        $this->task_description = $task_description;
        $this->due_date = $due_date;
        $this->priority = $priority;
        $this->status = $status;
        $this->category_id = $category_id;
        $this->user_id = $user_id;
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

}