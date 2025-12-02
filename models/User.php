<?php

require_once __DIR__ . '/../controllers/Database.php';

class User
{
    private ?int $id;
    private string $username;
    private string $email;
    private string $password;
    private ?string $created_at;

    public function __construct(?int $id = null, string $username = '', string $email = '', string $password = '', ?string $created_at = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->created_at = $created_at;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function save(): bool
    {
        if ($this->id === null) {
            return $this->create();
        } else {
            return $this->update();
        }
    }

    private function create(): bool
    {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $result = $stmt->execute([
                ':username' => $this->username,
                ':email' => $this->email,
                ':password' => $this->password
            ]);
            
            if ($result) {
                $this->id = (int)$db->lastInsertId();
                $stmt = $db->prepare("SELECT created_at FROM users WHERE id = :id");
                $stmt->execute([':id' => $this->id]);
                $data = $stmt->fetch();
                if ($data) {
                    $this->created_at = $data['created_at'];
                }
                return true;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Помилка створення користувача: " . $e->getMessage());
            return false;
        }
    }

    private function update(): bool
    {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare("UPDATE users SET username = :username, email = :email, password = :password WHERE id = :id");
            return $stmt->execute([
                ':id' => $this->id,
                ':username' => $this->username,
                ':email' => $this->email,
                ':password' => $this->password
            ]);
        } catch (PDOException $e) {
            error_log("Помилка оновлення користувача: " . $e->getMessage());
            return false;
        }
    }

    public static function findById(int $id): ?User
    {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $data = $stmt->fetch();
            
            if ($data) {
                return new User(
                    $data['id'],
                    $data['username'],
                    $data['email'],
                    $data['password'],
                    $data['created_at'] ?? null
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("Помилка пошуку користувача: " . $e->getMessage());
            return null;
        }
    }

    public static function findByUsername(string $username): ?User
    {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute([':username' => $username]);
            $data = $stmt->fetch();
            
            if ($data) {
                return new User(
                    $data['id'],
                    $data['username'],
                    $data['email'],
                    $data['password'],
                    $data['created_at'] ?? null
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("Помилка пошуку користувача: " . $e->getMessage());
            return null;
        }
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'created_at' => $this->created_at
        ];
    }
}

