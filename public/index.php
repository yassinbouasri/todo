<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ .  '/../app/controllers/taskController.php';
require_once __DIR__ .  '/../app/controllers/categoryController.php';
require_once __DIR__ .  '/../app/infrastructure/infrastructure.php';
require_once __DIR__ .  '/../app/controllers/userController.php';
$user = new UserController();

$routes = require_once __DIR__ .  '/../app/infrastructure/routes.php';





run($_SERVER['REQUEST_URI'], $routes);
