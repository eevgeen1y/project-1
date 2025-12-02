<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/controllers/Database.php';

try {
    $db = Database::getConnection();
    
    $dbType = $_ENV['DB_TYPE'] ?? 'sqlite';
    
    if ($dbType === 'mysql') {
        $db->exec("CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) UNIQUE NOT NULL,
            email VARCHAR(100) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");
    } else {
        $db->exec("CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username VARCHAR(50) UNIQUE NOT NULL,
            email VARCHAR(100) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");
    }
    
    echo "Таблиця users успішно створена!\n";
} catch (PDOException $e) {
    echo "Помилка створення таблиці: " . $e->getMessage() . "\n";
    echo "\nЯкщо використовуєте XAMPP, краще використати MySQL:\n";
    echo "1. Створіть базу даних 'project_db' в phpMyAdmin\n";
    echo "2. Додайте в .env файл:\n";
    echo "DB_TYPE=mysql\n";
    echo "DB_HOST=localhost\n";
    echo "DB_NAME=project_db\n";
    echo "DB_USER=root\n";
    echo "DB_PASSWORD=\n";
}

?>
