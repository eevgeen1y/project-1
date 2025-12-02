<?php

require_once __DIR__ . '/../controllers/Database.php';
require_once __DIR__ . '/User.php';

class MyModel
{
    public static function getAllUsers(): array
    {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare("SELECT id, username, email, created_at FROM users ORDER BY created_at DESC");
            $stmt->execute();
            $users = $stmt->fetchAll();
            
            $result = [];
            foreach ($users as $userData) {
                $user = User::findById($userData['id']);
                if ($user) {
                    $result[] = $user->toArray();
                }
            }
            return $result;
        } catch (PDOException $e) {
            error_log("Помилка отримання користувачів: " . $e->getMessage());
            return [];
        }
    }

    public static function getUserCount(): int
    {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare("SELECT COUNT(*) as count FROM users");
            $stmt->execute();
            $result = $stmt->fetch();
            return (int)($result['count'] ?? 0);
        } catch (PDOException $e) {
            error_log("Помилка підрахунку користувачів: " . $e->getMessage());
            return 0;
        }
    }

    public static function deleteUser(int $userId): bool
    {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
            return $stmt->execute([':id' => $userId]);
        } catch (PDOException $e) {
            error_log("Помилка видалення користувача: " . $e->getMessage());
            return false;
        }
    }

    public static function authenticateUser(string $username, string $password): ?User
    {
        $user = User::findByUsername($username);
        if ($user && $user->verifyPassword($password)) {
            return $user;
        }
        return null;
    }

    public static function registerUser(string $username, string $email, string $password): ?User
    {
        if (User::findByUsername($username)) {
            return null;
        }

        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($password);
        
        if ($user->save()) {
            return $user;
        }
        return null;
    }

    public static function getUserStatistics(): array
    {
        try {
            $db = Database::getConnection();
            
            $totalUsers = self::getUserCount();
            
            $stmt = $db->prepare("SELECT COUNT(*) as count FROM users WHERE DATE(created_at) = DATE('now')");
            $stmt->execute();
            $todayResult = $stmt->fetch();
            $todayUsers = (int)($todayResult['count'] ?? 0);
            
            return [
                'total_users' => $totalUsers,
                'today_registered' => $todayUsers,
                'average_per_day' => $totalUsers > 0 ? round($totalUsers / max(1, $todayUsers), 2) : 0
            ];
        } catch (PDOException $e) {
            error_log("Помилка отримання статистики: " . $e->getMessage());
            return [
                'total_users' => 0,
                'today_registered' => 0,
                'average_per_day' => 0
            ];
        }
    }
}

