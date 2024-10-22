<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ .  '/../app/controllers/taskController.php';
require_once __DIR__ .  '/../app/controllers/categoryController.php';


$controller = $_GET["controller"] ?? null;
$method = $_GET["method"] ?? null;

//new router
$request = trim($_SERVER['REQUEST_URI'], '/');
$request = parse_url($request, PHP_URL_PATH);
$parts = explode('/', $request);

$baseRoute = $parts[0] ?? null;
$function = $parts[1] ?? null;
$param = $parts[2] ?? null;

require_once __DIR__ .  '/../app/controllers/userController.php';
$user = new UserController();
// array for methods
$functionsWithId = [
    "show",
    "update"
];

$functionsWithoutId = [
    "index",
    "create",
    "remove",
];


    //user
switch ($baseRoute) {
    case "/user/login":

        $user->login();
        break;
    case "/user/register":
        $user->register();
        break;
    case "index":
        $task = new TaskController();
        $task->index();
        break;
    case "task":

        if (in_array($function, $functionsWithId) && $param) {
            $task = new TaskController();
            $task->{$function}($param);
        } elseif (in_array($function,$functionsWithoutId) && !$param) {
            $task = new TaskController();
            $task->{$function}();
        } else {
            echo "Invalid function or missing parameter.";
        }
        break;
    case "user":
        if (in_array($function, $functionsWithId) && $param) {
            $user = new userController();
            $user->{$function}($param);
        } elseif (in_array($function,$functionsWithoutId) && !$param) {
            $user = new userController();
            $user->{$function}($param);
        } else {
            echo "Invalid function or missing parameter.";
        }
        break;
    case "category":
        if (in_array($function, $functionsWithId) && $param) {
            $category = new CategoryController();
            $category->{$function}($param);
        } elseif (in_array($function,$functionsWithoutId) && !$param) {
            $category = new CategoryController();
            $category->{$function}();
        } else {
            echo "Invalid function or missing parameter.";
        }
        break;
    default:
        http_response_code(404);
        echo "404 - Page not found.";
}



/*
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
*/