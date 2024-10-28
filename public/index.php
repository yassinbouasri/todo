<?php
declare(strict_types=1);

define('ROOT_DIR',   __DIR__. "/../" );
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../infrastructure/infrastructure.php';
require_once __DIR__ . '/../infrastructure/helpers.php';

$routes = require __DIR__ . '/../infrastructure/routes.php';

run($_SERVER['REQUEST_URI'], $routes);