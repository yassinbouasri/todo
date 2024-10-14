<?php
require_once __DIR__ . "/../models/categories.php";


class categoryController
{
    public function index(){
        $categoryModel = new categories();
        $categories = $categoryModel->getAllCategories();

        require_once __DIR__ . "/../views/categories/showCategory.php";
    }
}