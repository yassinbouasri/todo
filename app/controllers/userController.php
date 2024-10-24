<?php
require_once __DIR__ . '/../models/users.php';
require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Random\RandomException;

require_once __DIR__ . '/../mail/Mailer.php';

class userController extends Mailer
{
    private $users;

    public function __construct(){
        $this->users = new Users();
    }

    public function register(): void
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $username = $_POST['username'] ?? null;
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;
            $confirmPassword = $_POST['confirm_password'] ?? null;

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

    public function login(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            $user = $this->users->loginUser($email, $password);

            if($user){
                session_regenerate_id(true);
                $_SESSION['id'] = $user['id'] ?? null;
                $_SESSION['email'] = $user['email'] ?? null;
                header('location: /');
                exit();
            } else {
                $alertMessage = "<div class='alert alert-danger alert-dismissible fade in' role='alert'> Login Error!</div>";
            }
        }
        require_once __DIR__ . '/../views/login/login.php';
    }
    public function logout(): void
    {
        session_start();

        $_SESSION = array();

        session_destroy();

        header('location: /user/login');
        exit();
    }

    public function changePassword(): void
    {
        checkSession();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $newPassword = $_POST['new_password'] ?? null;
            $confirmPassword = $_POST['confirm_password'] ?? null;
            $email = $_SESSION['email'] ?? null;
            if($newPassword == $confirmPassword){
                $this->users->changePassword($email, $newPassword);
                $this->logout();
            }
        }
        require_once __DIR__ . '/../views/login/changePassword.php';
    }

    /**
     * @throws Exception
     * @throws RandomException
     */
    public function resetPassword(): void
    {
        $alertMessage = "";
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $_POST['email'] ?? null;
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $alertMessage = "<div class='alert alert-danger alert-dismissible fade in' role='alert'> Invalid Email!</div>";
            } else {
                $user = $this->users->getUserByEmail($email);

                if($user){
                    $token = bin2hex(random_bytes(32));
                    $expires = date("U") + 1800;
                    $expiresDate = date("Y-m-d H:i:s", $expires);
                    $this->users->storeToken($email, $token, $expiresDate);

                    $resetLink = "http://127.0.0.1:8080/user/resetPasswordByToken/".$token;

                    $subject = "Password Reset";
                    $message = "Click on the following link to reset your password: <a href='".$resetLink."'>".$resetLink."</a>";

                    parent::sendEmail($email, $subject, $message);

                    $alertMessage = "<div class='alert alert-success'>Check your email for the password reset link!</div>";

                } else {
                    $alertMessage = "<div class='alert alert-danger alert-dismissible fade in' role='alert'> Invalid Email!</div>";
                }
            }

        }
        require_once __DIR__ . '/../views/login/forgot.php';
    }

    public function resetPasswordByToken($token){
        $alertMessage = "";
            $user = $this->users->getUserByToken($token);
            if($user){
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $newPassword = $_POST['new_password'];
                    $confirmPassword = $_POST['confirm_password'];
                    if($newPassword == $confirmPassword){
                        $this->users->changePassword($user['email'],  $newPassword);
                        $this->users->deleteToken($token);

                        $alertMessage = "<div class='alert alert-success'>Password reset successfully!</div>";
                    } else {
                        $alertMessage = "<div class='alert alert-danger'>Password reset failed!</div>";
                    }
                }
            } else {
                $alertMessage = "<div class='alert alert-danger'>Invalid reset token!</div>";
            }
        require_once __DIR__ . '/../views/login/newPassword.php';
    }
}
