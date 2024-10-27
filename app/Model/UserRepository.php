<?php
declare(strict_types=1);
namespace App\Model;

use App\Config\Database;
use PDO;

class UserRepository
{
    private PDO $cnn;
    public function __construct() {
        $this->cnn = Database::getConnection();
    }

    public function registerUser(string $username, string $email, string $password): bool
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";

        $stmt = $this->cnn->prepare($sql);
        return  $stmt->execute([
                "username" => $username,
                "email" => $email,
                "password" => $hashedPassword
            ]);
    }

    public function loginUser(string $email, string $password): mixed
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->cnn->prepare($sql);
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

    public function changePassword(string $email, string $newPassword): bool
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = :password WHERE email = :email";
        $stmt = $this->cnn->prepare($sql);
        $stmt->execute([
            "password" => $hashedPassword,
            "email" => $email,
        ]);

        return (bool) $stmt->rowCount();

    }

    public function getUserByEmail(string $email): mixed
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->cnn->prepare($sql);
        $stmt->execute([
            "email" => $email
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function storeToken(string $email, string $reset_token, string $token_expires_at): bool
    {
        $sql = "UPDATE users SET reset_token = :reset_token, token_expires_at = :token_expires_at WHERE email = :email";
        $stmt = $this->cnn->prepare($sql);
        $stmt->execute([
            "reset_token" => $reset_token,
            "token_expires_at" => $token_expires_at,
            "email" => $email
        ]);
        return (bool) $stmt->rowCount();
    }

    public function getUserByToken(string $token): mixed
    {
        $sql = "SELECT * FROM users WHERE reset_token = :reset_token AND token_expires_at > :now";
        $stmt = $this->cnn->prepare($sql);
        $now = date("U");
        $stmt->bindParam(":reset_token", $token);
        $stmt->bindParam(":now", $now);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteToken(string $token): bool
    {
        $sql = "UPDATE users SET reset_token = null, token_expires_at = null WHERE reset_token = :token";
        $stmt = $this->cnn->prepare($sql);
        return $stmt->execute([
             "token" => $token,
             ]);

    }

    public function getUserByIds(array $ids) : mixed
    {
        if (empty($ids)) {
            return [];
        }
        $placeholders = implode(",", array_fill(0, count($ids), "?"));

        $sql = "SELECT * FROM users WHERE id IN ($placeholders)";
        $stmt = $this->cnn->prepare($sql);

        $stmt->execute($ids);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}