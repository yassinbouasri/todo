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

function dd($data): void
{
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dump and Die</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 20px;
            }
            pre {
                background-color: #fff;
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 10px;
                overflow: auto;
                white-space: pre-wrap; /* Allow wrapping */
                word-wrap: break-word; /* Break long words */
            }
            .title {
                font-size: 1.5em;
                margin-bottom: 10px;
                color: #333;
            }
            .type {
                color: #007BFF;
                font-weight: bold;
            }
            .array-key {
                color: #A52A2A;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class="title">Dump of Data:</div>';

    echo '<pre>';
    echo htmlentities(print_r($data, true));
    echo '</pre></body></html>';

    die();
}
