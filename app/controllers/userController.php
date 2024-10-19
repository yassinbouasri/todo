<?php
require_once __DIR__ . '/../models/users.php';

class userController
{
    private $users;

    public function __construct(){
        $this->users = new Users();
    }

    public function register(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];


            if($password == $confirmPassword){
                try {
                    $registered = $this->users->registerUser($username, $email, $password);
                    if($registered){
                        $alertMessage = "<div class='alert alert-success alert-dismissible fade in' role='alert'> You are registered successfully.</div>";
                    } else {
                        $alertMessage = "<div class='alert alert-danger alert-dismissible fade in' role='alert'> Something went wrong.</div>";
                    }
                } catch (PDOException $e) {
                    $alertMessage = "<div class='alert alert-danger alert-dismissible fade in' role='alert'> User already exists!. Try logging</div>";
                }

            } else {
                $alertMessage = "<div class='alert alert-danger alert-dismissible fade in' role='alert'> Password did not match!</div>";
            }
        }
        require_once __DIR__ . '/../views/login/register.php';
    }

    public function login(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->users->loginUser($email, $password);
            if($user){
                session_regenerate_id(true);
                $_SESSION['id'] = $user->id;
                $_SESSION['username'] = $user->username;
                header('location: /index.php?controller=task&method=index');
            } else {
                $alertMessage = "<div class='alert alert-danger alert-dismissible fade in' role='alert'> Login Error!</div>";
            }
        }
        require_once __DIR__ . '/../views/login/login.php';
    }
}