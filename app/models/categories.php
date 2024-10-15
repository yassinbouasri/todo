<?php
require_once __DIR__ .  "/../config/database.php";
class Categories
{
    private $db;

    public function __construct(){

        $this->db = Database::getConnection();
    }

    public function getCategoryById($id){
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array("id" => $id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllCategories(){
        $sql = "SELECT * FROM categories";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCategory($category){
        $sql = "INSERT INTO categories (category_name) VALUES (:category_name)";
        $stm = $this->db->prepare($sql);

        return $stm->execute(array(
            "category_name" => $category,
        ));
    }
}