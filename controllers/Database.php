<?php

if (file_exists(__DIR__ . '/../config.php')) {
    require_once __DIR__ . '/../config.php';
}

class Database
{
    private static $connection = null;

    public static function getConnection()
    {
        if (self::$connection === null) {
            try {
                $dbType = $_ENV['DB_TYPE'] ?? 'sqlite';
                
                if ($dbType === 'mysql') {
                    $host = $_ENV['DB_HOST'] ?? 'localhost';
                    $dbname = $_ENV['DB_NAME'] ?? 'project_db';
                    $username = $_ENV['DB_USER'] ?? 'root';
                    $password = $_ENV['DB_PASSWORD'] ?? '';
                    
                    self::$connection = new PDO(
                        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                        $username,
                        $password,
                        [
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                        ]
                    );
                } else {
                    if (!extension_loaded('pdo_sqlite')) {
                        die("SQLite драйвер не встановлено. Для використання SQLite відредагуйте php.ini та додайте:<br>extension=pdo_sqlite<br>extension=sqlite3<br><br>Або використовуйте MySQL: створіть базу даних 'project_db' в phpMyAdmin та додайте в .env:<br>DB_TYPE=mysql");
                    }
                    $dbPath = __DIR__ . '/../database.db';
                    $dir = dirname($dbPath);
                    if (!is_dir($dir)) {
                        @mkdir($dir, 0755, true);
                    }
                    self::$connection = new PDO(
                        "sqlite:$dbPath",
                        null,
                        null,
                        [
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                        ]
                    );
                }
            } catch (PDOException $e) {
                $errorMsg = "Помилка підключення до бази даних: " . $e->getMessage();
                $errorMsg .= "<br><br><strong>Доступні PDO драйвери:</strong> " . implode(", ", PDO::getAvailableDrivers());
                $errorMsg .= "<br><br><strong>Рішення:</strong>";
                $errorMsg .= "<br>1. Запустіть: php test_extensions.php - для перевірки розширень";
                $errorMsg .= "<br>2. Перезапустіть Apache в XAMPP після зміни php.ini";
                $errorMsg .= "<br>3. Перевірте правильний php.ini: " . php_ini_loaded_file();
                die($errorMsg);
            }
        }
        
        return self::$connection;
    }

    public static function checkUser($username, $password)
    {
        try {
            $db = self::getConnection();
            
            $stmt = $db->prepare("SELECT id, username, email, password FROM users WHERE username = :username");
            $stmt->execute([
                ':username' => $username
            ]);
            
            $user = $stmt->fetch();
            if ($user && password_verify($password, $user['password'])) {
                unset($user['password']);
                return $user;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Помилка перевірки користувача: " . $e->getMessage());
            return false;
        }
    }

    public static function createUser($username, $email, $password)
    {
        try {
            $db = self::getConnection();
            
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            
            $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $result = $stmt->execute([
                ':username' => $username,
                ':email' => $email,
                ':password' => $hashedPassword
            ]);
            
            if ($result) {
                $dbType = $_ENV['DB_TYPE'] ?? 'sqlite';
                $lastId = $dbType === 'mysql' ? $db->lastInsertId() : $db->lastInsertId();
                return [
                    'id' => $lastId,
                    'username' => $username,
                    'email' => $email
                ];
            }
            
            return false;
        } catch (PDOException $e) {
            error_log("Помилка створення користувача: " . $e->getMessage());
            return false;
        }
    }
}

