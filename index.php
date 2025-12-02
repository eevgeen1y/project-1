<?php
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
    '404' => 'pages/404.php',
];

$page_file = null;
$page_title = 'Wikipedia';

if (isset($routes[$path])) {
    $page_file = $routes[$path];
    switch ($path) {
        case 'home':
            $page_title = 'Wikipedia - Вільна енциклопедія';
            break;
        case 'login':
            $page_title = 'Авторизація - Wikipedia';
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
