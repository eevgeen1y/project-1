<?php

if (file_exists(__DIR__ . '/.env') && file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

if (!isset($_ENV['DB_TYPE'])) {
    if (extension_loaded('pdo_sqlite')) {
        $_ENV['DB_TYPE'] = 'sqlite';
    } elseif (extension_loaded('pdo_mysql')) {
        $_ENV['DB_TYPE'] = 'mysql';
        $_ENV['DB_HOST'] = 'localhost';
        $_ENV['DB_NAME'] = 'project_db';
        $_ENV['DB_USER'] = 'root';
        $_ENV['DB_PASSWORD'] = '';
    } else {
        $_ENV['DB_TYPE'] = 'sqlite';
    }
}

