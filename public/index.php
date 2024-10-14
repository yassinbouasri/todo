<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ .  '/../app/controllers/taskController.php';
require_once __DIR__ .  '/../app/controllers/categoryController.php';

$controller = $_GET["controller"] ?? null;
$method = $_GET["method"] ?? null;

if($controller == "task"){
    $controller = new TaskController();

    if($method == "create"){
        $controller->create();
    } else{
        $controller->index();
    }

} else if($controller == "categories"){
    $catController = new CategoryController();

    if($method == "index"){
        $catController->index();
    }
}
