<?php


require_once __DIR__ .  "/../config/database.php";


class Tasks
{
    private $db;
    function __construct(){
        $this->db = Database::getConnection();
    }
    public function getAllTasks($limit, $offset){
        $sql = "SELECT * FROM tasks ORDER BY due_date DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //changing the badge color for priority and status, according to data fetched from DB.

    public function insert($data = array()) {
        $sql = "INSERT INTO tasks (task_title, task_description, due_date, priority, status, category_id) 
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        // Ensure the values are in the correct order
        return $stmt->execute([
            $data['task_title'],
            $data['task_description'],
            $data['due_date'],
            $data['priority'],
            $data['status'],
            $data['category_id']
        ]); // Return true on success, false on failure
    }

    public function getTaskById($id){
        $sql = "SELECT * FROM tasks WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id){
        $sql = "DELETE FROM tasks WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        if($stmt->rowCount() > 0){
            return true;
        }
    }

    public function update($id, $task_title, $task_description, $due_date, $priority, $status, $category_id){
        $sql = "UPDATE tasks SET task_title = :task_title , task_description = :task_description, due_date = :due_date, priority = :priority, status = :status, category_id = :category_id WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            'task_title' => $task_title,
            'task_description' => $task_description,
            'due_date' => $due_date,
            'priority' => $priority,
            'status' => $status,
            'category_id' => $category_id,
            'id' => $id
            ]);
        if ($result) {
            return true;
        }
    }

    public function getTotalTasks(){
        $sql = "SELECT COUNT(*) FROM tasks";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function orderBy($column, $sortOrder){
        $sql = "SELECT * FROM tasks ORDER BY :column " . strtoupper($sortOrder);
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':column', $column);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function notification(){

        $sql = "SELECT * FROM tasks WHERE notification_sent = 0 AND due_date <= DATE_ADD(NOW(), INTERVAL 24 HOUR) AND status != 'Completed'";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($result){

            $sql = "UPDATE tasks SET notification_sent = 1 WHERE id = :task_id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['task_id' => $result['id']]);

        }

        return $result;
    }

}