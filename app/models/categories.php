<?php
require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ .  "/../helpers.php";
class Categories
{
    private $db;

    public function __construct(){
        checkSession();
        $this->db = Database::getConnection();
    }

    public function getCategoryById(int $id): mixed
    {
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array("id" => $id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllCategories(): false|array
    {
        $sql = "SELECT * FROM categories";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCategory(string $category): bool
    {
        $sql = "INSERT INTO categories (category_name) VALUES (:category_name)";
        $stm = $this->db->prepare($sql);

        return $stm->execute(array(
            "category_name" => $category,
        ));
    }

    public function deleteCategory(int $id): bool
    {
        $sql = "DELETE FROM categories WHERE id = :id";

        $stm = $this->db->prepare($sql);
        $stm->bindParam(":id", $id, PDO::PARAM_INT);
        $stm->execute();
        return (bool) $stm->rowCount();

    }

    public function updateCategory(string $category_name, int $id): bool
    {

        $sql = "UPDATE categories SET category_name = :category_name WHERE id = :id";

        $stm = $this->db->prepare($sql);
        $stm->execute([
            "category_name" => $category_name,
            "id" => $id,
        ]);
        return (bool) $stm->rowCount();
    }
}