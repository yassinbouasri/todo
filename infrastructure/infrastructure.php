<?php
declare(strict_types = 1);

function run(string $url, array $routes):void
{
    $request = trim($url, '/');
    $request = parse_url($request, PHP_URL_PATH);
    $parts = explode('/', $request ?? '');

    $baseRoute = $parts[0] ?? null;
    $function = $parts[1] ?? null;

    $path = $baseRoute;
    if ($function) {
        $path = $baseRoute . "/" . $function;
    }

    if (false === array_key_exists($path, $routes)) {
        return;
    }
    $callback = $routes[$path];

    $params = $parts[2] ?? null;

    if (is_callable($callback)) {
        $params ? $callback($params) : $callback();
    }
}
