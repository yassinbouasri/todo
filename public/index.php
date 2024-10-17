<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ .  '/../app/controllers/taskController.php';


$controller = $_GET["controller"] ?? null;
$method = $_GET["method"] ?? null;

if($controller == "task"){
    $controller = new TaskController();

    if($method == "create"){
        $controller->create();
    } else if($method == "show"){
        $controller->show();
    } else{
        $controller->index();
    }

} else if($controller == "categories"){
    require_once __DIR__ .  '/../app/controllers/categoryController.php';
    $catController = new CategoryController();

    if($method == "showCategories"){
        $catController->index();
    }else if ($method == "saveCategory"){
        $catController->saveCategory();
    } else if($method == "removeCategory"){
        $catController->removeCategory();
    } else if($method == "updateCategory"){
        $catController->edit();
    }
}
