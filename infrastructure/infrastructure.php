<?php
declare(strict_types = 1);

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
