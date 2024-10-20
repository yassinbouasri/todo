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

    public function getUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "email" => $email
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function storeToken($email, $reset_token, $token_expires_at) {

        $sql = "UPDATE users SET reset_token = :reset_token, token_expires_at = :token_expires_at WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "reset_token" => $reset_token,
            "token_expires_at" => $token_expires_at,
            "email" => $email
        ]);
        if ($stmt->rowCount() > 0) {
            return true;
        }
    }

    public function getUserByToken($token) {
        $sql = "SELECT * FROM users WHERE reset_token = :reset_token AND token_expires_at > :now";
        $stmt = $this->db->prepare($sql);
        $now = date("U");
        $stmt->bindParam(":reset_token", $token);
        $stmt->bindParam(":now", $now);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteToken($token){
        $sql = "UPDATE users SET reset_token = null, token_expires_at = null WHERE reset_token = :token";
        $stmt = $this->db->prepare($sql);
         $stmt->execute([
             "token" => $token,
             ]);
    }
}