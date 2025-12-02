<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/users.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Symfony\Component\VarDumper\VarDumper;
use Dotenv\Dotenv;

if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

$logger = new Logger('app');
$logger->pushHandler(new StreamHandler(__DIR__ . '/logs/app.log', Logger::DEBUG));

$logger->info('Composer демонстрація запущена');

$student = new Student("Марія Іваненко", "maria.ivanenko@example.com", "КН-24");
$teacher = new Teacher("Петро Сидоренко", "petro.sydorenko@example.com", "PHP та Composer");

$logger->info('Створено користувачів системи');

echo "=== Демонстрація Monolog ===\n";
$logger->info('Інформаційне повідомлення');
$logger->warning('Попередження');
$logger->error('Помилка');

echo "\n=== Демонстрація VarDumper ===\n";
echo "Виведення об'єкта Student:\n";
VarDumper::dump($student);

echo "\nВиведення об'єкта Teacher:\n";
VarDumper::dump($teacher);

echo "\nВиведення масиву:\n";
$data = [
    'name' => 'Composer Demo',
    'packages' => ['monolog', 'var-dumper', 'dotenv'],
    'version' => '1.0.0'
];
VarDumper::dump($data);

echo "\n=== Демонстрація Dotenv ===\n";
echo "APP_NAME: " . ($_ENV['APP_NAME'] ?? 'не встановлено') . "\n";
echo "APP_ENV: " . ($_ENV['APP_ENV'] ?? 'не встановлено') . "\n";

echo "\n=== Інформація про користувачів ===\n";
echo "Ім'я: " . $student->getName() . "\n";
echo "Email: " . $student->getEmail() . "\n";
echo "Роль: " . $student->getRole() . "\n";
echo "Група: " . $student->getGroup() . "\n";
echo "\n";

echo "Ім'я: " . $teacher->getName() . "\n";
echo "Email: " . $teacher->getEmail() . "\n";
echo "Роль: " . $teacher->getRole() . "\n";
echo "Предмет: " . $teacher->getSubject() . "\n";

$logger->info('Composer демонстрація завершена');

echo "\n=== Логування завершено. Перевірте файл logs/app.log ===\n";

?>
