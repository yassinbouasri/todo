<?php
function checkSession(): void
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $request = trim($_SERVER['REQUEST_URI'], '/');
    $request = parse_url($request, PHP_URL_PATH);
    $parts = explode('/', $request ?? '');

    $baseRoute = $parts[0] ?? null;
    $function = $parts[1] ?? null;
    if ($baseRoute == 'login' || $baseRoute == 'register' || $baseRoute == 'resetPassword' || $function == 'resetPasswordByToken') {
        return;
    }
    if (!isset($_SESSION['id'])) {
        header('location: /login');
        exit();
    }
}
