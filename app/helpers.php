<?php
function checkSession(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['id'])) {
        header('location: /?controller=users&method=login');
        exit();
    }
}