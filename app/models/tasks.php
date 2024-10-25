<?php


require_once __DIR__ .  "/../config/database.php";


class Tasks
{
    private PDO $db;
    function __construct(){
        $this->db = Database::getConnection();
    }
    public function getAllTasks(int $limit, int $offset, int $user_id): false|array
    {
        $sql = "SELECT tasks.*, users.email FROM tasks 
                    JOIN users on tasks.user_id = users.id 
                            WHERE users.id = :user_id 
                            ORDER BY due_date DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert(array $data = []): bool
    {
        $sql = "INSERT INTO tasks (task_title, task_description, due_date, priority, status, category_id, notification_sent, user_id) 
                VALUES (?, ?, ?, ?, ?, ?, 0,?)";

        $stmt = $this->db->prepare($sql);

        // Ensure the values are in the correct order
        return $stmt->execute([
            $data['task_title'],
            $data['task_description'],
            $data['due_date'],
            $data['priority'],
            $data['status'],
            $data['category_id'],
            $data['user_id'],
        ]); // Return true on success, false on failure
    }

    public function getTaskById(int $id): mixed
    {
        $sql = "SELECT * FROM tasks WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM tasks WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        return (bool) $stmt->rowCount();
    }

    public function update(int $id, string $task_title, string $task_description, string $due_date, string $priority, string $status, int $category_id): bool
    {
        $sql = "UPDATE tasks SET task_title = :task_title , task_description = :task_description, due_date = :due_date, priority = :priority, status = :status, category_id = :category_id WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'task_title' => $task_title,
            'task_description' => $task_description,
            'due_date' => $due_date,
            'priority' => $priority,
            'status' => $status,
            'category_id' => $category_id,
            'id' => $id
            ]);
    }

    public function getTotalTasks(): mixed
    {
        $sql = "SELECT COUNT(*) FROM tasks";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function notification(): false|array
    {

        $sql = "SELECT * FROM tasks WHERE notification_sent = 0 AND due_date <= DATE_ADD(NOW(), INTERVAL 24 HOUR) AND status != 'Completed'";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($result){
            foreach($result as $row){
                $sql = "UPDATE tasks SET notification_sent = 1 WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(['id' => $row['id']]);
            }
        }
        return $result;
    }

}