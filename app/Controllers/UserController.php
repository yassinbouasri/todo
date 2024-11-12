<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Mail\Mailer;
use App\Model\User;
use App\Model\UserRepository;
use PHPMailer\PHPMailer\Exception;
use Random\RandomException;

class UserController extends Controller
{
    private UserRepository $userRepository;
    private Mailer $mailer;
    private User $user;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->mailer = new Mailer();
        $this->user = new User();
    }

    public function register(): void
    {
        $alertMessage = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $this->extracted();
            if ($_POST['username'] == $_POST['confirm_password']) {

                $registered = $this->user->save();
                $alertMessage = ($registered) ? "<div class='alert alert-success alert-dismissible fade in' role='alert'> You are registered successfully.</div>" : "<div class='alert alert-danger alert-dismissible fade in' role='alert'> Something went wrong.</div>";
            } else {
                $alertMessage = "<div class='alert alert-danger alert-dismissible fade in' role='alert'> Password did not match!</div>";
            }
        }
        $this->render("login/register", ["alertMessage" => $alertMessage]);
    }

    public function login(): void
    {
        $alertMessage = null;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            $user = $this->userRepository->loginUser($email, $password);

            if ($user) {
                session_regenerate_id(true);
                $_SESSION['id'] = $user['id'] ?? null;
                $_SESSION['email'] = $user['email'] ?? null;
                header('location: /');
                exit();
            } else {
                $alertMessage = "<div class='alert alert-danger alert-dismissible fade in' role='alert'> Login Error!</div>";
            }
        }
        $this->render("login/login", ["alertMessage" => $alertMessage]);
    }

    /**
     * @throws Exception
     * @throws RandomException
     */
    public function resetPassword(): void
    {
        $alertMessage = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? null;
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $alertMessage = "<div class='alert alert-danger alert-dismissible fade in' role='alert'> Invalid Email!</div>";
            } else {
                $user = $this->userRepository->getUserByEmail($email);

                if ($user) {
                    $token = bin2hex(random_bytes(32));
                    $expires = date("U") + 1800;
                    $expiresDate = date("Y-m-d H:i:s", $expires);
                    $this->userRepository->storeToken($email, $token, $expiresDate);

                    $resetLink = "http://127.0.0.1:8080/user/resetPasswordByToken/" . $token;

                    $subject = "Password Reset";
                    $message = "Click on the following link to reset your password: <a href='" . $resetLink . "'>" . $resetLink . "</a>";

                    $this->mailer->sendEmail($email, $subject, $message);

                    $alertMessage = "<div class='alert alert-success'>Check your email for the password reset link!</div>";

                } else {
                    $alertMessage = "<div class='alert alert-danger alert-dismissible fade in' role='alert'> Invalid Email!</div>";
                }
            }

        }
        $this->render("login/forgot", ["alertMessage" => $alertMessage]);
    }

    public function resetPasswordByToken(string $token): void
    {
        $alertMessage = "";
        $user = $this->userRepository->getUserByToken($token);
        if ($user) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $newPassword = $_POST['new_password'] ?? null;
                $confirmPassword = $_POST['confirm_password'] ?? null;
                if ($newPassword == $confirmPassword) {
                    $this->userRepository->changePassword($user['email'], $newPassword);
                    $this->userRepository->deleteToken($token);

                    $alertMessage = "<div class='alert alert-success'>Password reset successfully!</div>";
                } else {
                    $alertMessage = "<div class='alert alert-danger'>Password reset failed!</div>";
                }
            }
        } else {
            $alertMessage = "<div class='alert alert-danger'>Invalid reset token!</div>";
        }
        $this->render("login/newPassword", ["alertMessage" => $alertMessage, "email" => $user['email']]);
    }

    public function changePassword(): void
    {
        checkSession();
        $email = $_SESSION['email'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['new_password'] ==! null && $_POST['new_password'] === $_POST['confirm_password']) {
                $this->user->setPassword($_POST['password']);
                $this->user->save();
                $this->logout();
            }
        }
        $this->render("login/changePassword", ["email" => $email]);
    }

    public function logout(): void
    {
        session_start();

        $_SESSION = array();

        session_destroy();

        header('location: /user/login');
        exit();
    }
    /**
     * @return void
     */
    public function extracted(): void
    {
        $this->user->setUsername($_POST['username']);
        $this->user->setEmail($_POST['email']);
        $this->user->setPassword($_POST['password']);
    }
}
