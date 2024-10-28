<?php

namespace App\Controllers;

abstract class Controller
{
    private const string LOCATION = ROOT_DIR . "views/";
    public function render(string $view, array $data = []): void
    {
        extract($data);
        require_once self::LOCATION . $view . ".tmpl.php";
    }
}