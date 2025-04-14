<?php
session_start();

// Forzar no caché
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Cargar las clases necesarias
require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/../app/controllers/BaseController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/UserController.php';
require_once __DIR__ . '/../app/models/User.php';
require_once __DIR__ . '/../app/controllers/HomeController.php';

// Obtener la ruta solicitada
$route = $_GET['route'] ?? 'home';

// Definir rutas públicas que no requieren autenticación
$publicRoutes = ['home', 'auth/login', 'auth/register'];

// Verificar autenticación para rutas protegidas
if (!isset($_SESSION['usuario']) && !in_array($route, $publicRoutes)) {
    header('Location: ' . Config::get('APP_URL') . '/public/index.php?route=auth/login');
    exit();
}

// Sistema de ruteo
try {
    switch ($route) {
        case '':
        case 'home':
            $controller = new HomeController();
            $controller->index();
            break;

        case 'auth/login':
            $controller = new AuthController();
            $controller->login();
            break;
            
        case 'auth/register':
            $controller = new AuthController();
            $controller->register();
            break;
            
        case 'auth/logout':
            $controller = new AuthController();
            $controller->logout();
            break;
            
        case 'users/list':
            $controller = new UserController();
            $controller->index();
            break;
            
        default:
            header("HTTP/1.0 404 Not Found");
            echo "Página no encontrada";
            break;
    }
} catch (Exception $e) {
    // Manejo de errores
    if (Config::get('APP_DEBUG') === 'true') {
        echo "Error: " . $e->getMessage();
    } else {
        echo "Ha ocurrido un error. Por favor, intente más tarde.";
    }
}