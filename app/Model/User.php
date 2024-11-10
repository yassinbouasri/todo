<?php
declare(strict_types=1);

namespace App\Model;

use DateTime;

class User extends Model
{
    protected static ?string $table = 'user';
    public ?int $id;
    public ?string $username;
    public ?string $email;
    public ?string $password;
    public ?DateTime $created_at;
    public ?string $reset_token;
    public ?DateTime $token_created_at;
    public ?DateTime $token_expires_at;

    /**
     * @param int|null $id
     * @param string|null $username
     * @param string|null $email
     * @param string|null $password
     * @param DateTime|null $created_at
     * @param string|null $reset_token
     * @param DateTime|null $token_created_at
     * @param DateTime|null $token_expires_at
     */
    public function __construct(?int $id = null, ?string $username = "", ?string $email = "", ?string $password = "", ?DateTime $created_at = null, ?string $reset_token = "", ?DateTime $token_created_at = null, ?DateTime $token_expires_at = null)
    {
        parent::__construct();
        $this->id = $id ?? null;
        $this->username = $username ?? null;
        $this->email = $email ?? null;
        $this->password = $password ?? null;
        $this->created_at = $created_at ?? null;
        $this->reset_token = $reset_token ?? null;
        $this->token_created_at = $token_created_at ?? null;
        $this->token_expires_at = $token_expires_at ?? null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(?DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getResetToken(): ?string
    {
        return $this->reset_token;
    }

    public function setResetToken(?string $reset_token): void
    {
        $this->reset_token = $reset_token;
    }

    public function getTokenCreatedAt(): ?DateTime
    {
        return $this->token_created_at;
    }

    public function setTokenCreatedAt(?DateTime $token_created_at): void
    {
        $this->token_created_at = $token_created_at;
    }

    public function getTokenExpiresAt(): ?DateTime
    {
        return $this->token_expires_at;
    }

    public function setTokenExpiresAt(?DateTime $token_expires_at): void
    {
        $this->token_expires_at = $token_expires_at;
    }

    protected static function mapAll(array $data): array
    {
        // TODO: Implement mapAll() method.
        return [];
    }
    protected static function mapOne( $data): array
    {
        return [];
    }

    protected static function getTable(): string
    {
        if (static::$table !== null) {
            return static::$table;
        }
        return 'Table not defined!';
    }

}