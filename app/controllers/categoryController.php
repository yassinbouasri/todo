<?php
require_once __DIR__ . "/../models/categories.php";


class categoryController
{

    private $categoriesModel;
    public function __construct(){
        $this->categoriesModel = new Categories();
    }
    public function index(){
        $categories = $this->categoriesModel->getAllCategories();

        require_once __DIR__ . "/../views/categories/showCategory.php";
    }

    public function create(){
        $alertMessage = "";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $result = $this->categoriesModel->addCategory($_POST['category_name']);
            if($result){
                $alertMessage = "<div class='alert alert-success' role='alert'>Category added successfully!</div>";
                //header("Location: /categories");
            } else {
                $alertMessage = "<div class='alert alert-danger' role='alert'>Something went wrong!</div>";
            }

        }
        require_once __DIR__ . "/../views/categories/addCategory.php";
    }

    public function remove(){
        $alertMessage = "";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $deleted = $this->categoriesModel->deleteCategory($_POST['category_id']);


            if($deleted){
                header("location: /category/show");
                //$alertMessage = "<div class='alert alert-success' role='alert'>Category deleted successfully!</div>";
            } else {
                $alertMessage = "<div class='alert alert-danger' role='alert'>Something went wrong!</div>";
            }

        }
        require_once __DIR__ . "/../views/categories/showCategory.php";
    }

    public function getCategoryById(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $category_id = $_POST['category_id'];
            $result = $this->categoriesModel->getCategoryById($category_id);

        } else {
            $category_id = $_GET['category_id'];
            $result = $this->categoriesModel->getCategoryById($category_id);
        }
        if($result){
            return $result;
        }
    }

    public function update($id){
        $category = $this->categoriesModel->getCategoryById($id);
        $categoryId = $category['id'];
        $categoryName = $category['category_name'];
        $alertMessage = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $id = $_POST['category_id'];
            $name = $_POST['category_name'];

            $updated = $this->categoriesModel->updateCategory($name, $id);
            $category = $this->getCategoryById();
            $categoryId = $category['id'];
            $categoryName = $category['category_name'];
                if($updated){
                    $alertMessage = "<div class='alert alert-success' role='alert'>Category updated successfully!</div>";

                } else {
                    $alertMessage = "<div class='alert alert-danger' role='alert'>Something went wrong!</div>";
                }

        }

        require_once __DIR__ . "/../views/categories/editCategory.php";
    }


}