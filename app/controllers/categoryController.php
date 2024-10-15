<?php
require_once __DIR__ . "/../models/categories.php";


class categoryController
{

    public function __construct(){
    }
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

    public function removeCategory(){
        $categories = new categories();
        $alertMessage = "";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $deleted = $categories->deleteCategory($_POST['category_id']);


            if($deleted){
                $alertMessage = "<div class='alert alert-success' role='alert'>Category deleted successfully!</div>";
            } else {
                $alertMessage = "<div class='alert alert-danger' role='alert'>Something went wrong!</div>";
            }
           // header("location: /?controller=categories&method=showCategories");
        }
        require_once __DIR__ . "/../views/categories/showCategory.php";
    }
}