<?php
session_start();

require_once __DIR__ . '/config.php';

$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);
$path = trim($path, '/');

if (empty($path)) {
    $path = 'home';
}

$routes = [
    'home' => 'pages/home.php',
    'login' => 'pages/login.php',
    'aboutme' => 'pages/aboutme.php',
    'logout' => 'pages/logout.php',
    '404' => 'pages/404.php',
];

$page_file = null;
$page_title = 'Wikipedia';
$error_message = null;
$success_message = null;

if (isset($routes[$path])) {
    $page_file = $routes[$path];
    switch ($path) {
        case 'home':
            $page_title = 'Wikipedia - Вільна енциклопедія';
            break;
        case 'login':
            $page_title = 'Авторизація - Wikipedia';
            require_once __DIR__ . '/controllers/Database.php';
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $action = $_POST['action'] ?? '';
                
                if ($action === 'login') {
                    $username = $_POST['username'] ?? '';
                    $password = $_POST['password'] ?? '';
                    
                    if ($username && $password) {
                        $user = Database::checkUser($username, $password);
                        if ($user) {
                            $_SESSION['user_id'] = $user['id'];
                            $_SESSION['username'] = $user['username'];
                            $_SESSION['email'] = $user['email'];
                            $success_message = "Вітаємо, " . htmlspecialchars($user['username']) . "! Ви успішно увійшли.";
                        } else {
                            $error_message = "Невірне ім'я користувача або пароль.";
                        }
                    } else {
                        $error_message = "Будь ласка, заповніть всі поля.";
                    }
                } elseif ($action === 'register') {
                    $username = $_POST['username'] ?? '';
                    $email = $_POST['email'] ?? '';
                    $password = $_POST['password'] ?? '';
                    
                    if ($username && $email && $password) {
                        $newUser = Database::createUser($username, $email, $password);
                        if ($newUser) {
                            $success_message = "Реєстрація успішна! Тепер ви можете увійти.";
                        } else {
                            $error_message = "Помилка реєстрації. Можливо, користувач з таким ім'ям або email вже існує.";
                        }
                    } else {
                        $error_message = "Будь ласка, заповніть всі поля.";
                    }
                }
            }
            break;
        case 'aboutme':
            $page_title = 'Про мене - Wikipedia';
            require_once __DIR__ . '/controllers/AboutMeController.php';
            $controller = new AboutMeController();
            $data = $controller->getData();
            break;
        default:
            $page_title = 'Wikipedia';
    }
} else {
    $page_file = $routes['404'];
    $page_title = '404 - Сторінку не знайдено';
    http_response_code(404);
}

if ($page_file && file_exists($page_file)) {
    include $page_file;
} else {
    http_response_code(404);
    if (file_exists($routes['404'])) {
        $page_title = '404 - Сторінку не знайдено';
        include $routes['404'];
    } else {
        die('Помилка: сторінка 404 не знайдена');
    }
}
?>
