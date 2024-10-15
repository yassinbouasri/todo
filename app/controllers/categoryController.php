<?php
require_once __DIR__ . "/../models/categories.php";


class categoryController
{
    public function index(){
        $categoryModel = new categories();
        $categories = $categoryModel->getAllCategories();

        require_once __DIR__ . "/../views/categories/showCategory.php";
    }

    public function saveCategory(){
        $categoryModel = new categories();
        $alertMessage = "";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $result = $categoryModel->addCategory($_POST['category_name']);
            if($result){
                $alertMessage = "<div class='alert alert-success' role='alert'>Category added successfully!</div>";
                //header("Location: /categories");
            } else {
                $alertMessage = "<div class='alert alert-danger' role='alert'>Something went wrong!</div>";
            }

        }
        require_once __DIR__ . "/../views/categories/addCategory.php";
    }
}