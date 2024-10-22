<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ .  '/../app/controllers/taskController.php';


$controller = $_GET["controller"] ?? null;
$method = $_GET["method"] ?? null;

//new router
$request = $_SERVER['REQUEST_URI'];
require_once __DIR__ .  '/../app/controllers/userController.php';
$user = new UserController();
var_dump($request);

    //user
switch ($request) {
    case "/user/login":

        $user->login();
        break;
    case "/user/register":
        $user->register();
        break;
    case "/index":
        $task = new TaskController();
        $task->index();
        break;
    case "/task/create":
        $task = new TaskController();
        $task->create();
        break;

}




// tasks routers
if($controller == "task"){
    $controller = new TaskController();

    $tasksMethods = [
        "create",
        "show",
        "remove",
        "update"
    ];
    if(in_array($method, $tasksMethods) && method_exists($controller, $method)){
        $controller->{$method}();
    } else {
        $controller->index();
    }


//categories routers
} else if($controller == "categories"){
    require_once __DIR__ .  '/../app/controllers/categoryController.php';
    $catController = new CategoryController();

    $catMethods = [
        "showCategories" => "index",
        "saveCategory" => "saveCategory",
        "removeCategory" => "removeCategory",
        "updateCategory" => "edit"
    ];

    $toCall = $catMethods[$method] ?? "index";
    $catController->{$toCall}();

    //users routers
} else if($controller == "users"){
    require_once __DIR__ .  '/../app/controllers/userController.php';
    $controller = new UserController();
    $usersMethods = [
        "register" => "register",
        "logout" => "logout",
        "changePassword" => "changePassword",
        "forgotPassword" => "resetPassword",
        "resetPassword" => "resetPasswordByToken",
    ];

    $toCall = $usersMethods[$method] ?? "login";
    $controller->{$toCall}();

}
