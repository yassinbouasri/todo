<?php

require_once __DIR__ . "/../config/database.php";
class Users
{
    private $db;
    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function registerUser($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";

        $stmt = $this->db->prepare($sql);
        return  $stmt->execute([
                "username" => $username,
                "email" => $email,
                "password" => $hashedPassword
            ]);
    }

    public function loginUser($email, $password) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "email" => $email,
        ]);

        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }

    }

    public function changePassword($email, $newPassword){
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = :password WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "password" => $hashedPassword,
            "email" => $email,
        ]);

        if ($stmt->rowCount() > 0) {
            return true;
        }

    }
}