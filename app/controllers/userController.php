<?php
require_once __DIR__ . '/../models/users.php';
require_once __DIR__ . '/../helpers.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->users->loginUser($email, $password);

            if($user){
                session_regenerate_id(true);
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                header('location: ?controller=task&method=index');
                exit();
            } else {
                $alertMessage = "<div class='alert alert-danger alert-dismissible fade in' role='alert'> Login Error!</div>";
            }
        }
        require_once __DIR__ . '/../views/login/login.php';
    }
    public function logout(){
        session_start();

        $_SESSION = array();

        session_destroy();

        header('location: ?controller=users&method=login');
        exit();
    }

    public function changePassword(){
        checkSession();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];
            if($newPassword == $confirmPassword){
                $this->users->changePassword($_SESSION['email'], $newPassword);
                $this->logout();
            }
        }
        require_once __DIR__ . '/../views/login/changePassword.php';
    }

    public function sendEmail($to, $subject, $message){
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->Host = 'smtp-mail.outlook.com'; //htestit@hotmail.com **pmol2110
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->Username = 'htestit@hotmail.com';
        $mail->Password = '**pmol2110';

        $mail->setFrom('htestit@hotmail.com', 'Todo - Tasks Manager');
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        //$mail->AltBody = $message;
        try {
            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

    }

    public function resetPassword(){

    }
}
