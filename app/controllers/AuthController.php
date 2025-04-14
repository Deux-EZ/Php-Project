<?php
class AuthController extends BaseController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['txtusuario'] ?? '';
            $password = $_POST['txtpassword'] ?? '';

            if (empty($username) || empty($password)) {
                return $this->render('auth/login', [
                    'error' => 'Por favor complete todos los campos'
                ]);
            }

            $user = $this->userModel->authenticate($username, $password);
            
            if ($user) {
                $_SESSION['usuario'] = $username;
                $_SESSION['user_id'] = $user['id'];
                header('Location: ' . Config::get('APP_URL') . '/public/index.php?route=users/list');
                exit();
            }

            return $this->render('auth/login', [
                'error' => 'Usuario o contraseña incorrectos'
            ]);
        }

        return $this->render('auth/login');
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['txtusuario'] ?? '';
            $password = $_POST['txtpassword'] ?? '';

            if (empty($username) || empty($password)) {
                return $this->render('auth/register', [
                    'error' => 'Por favor complete todos los campos'
                ]);
            }

            if (strlen($password) < 8) {
                return $this->render('auth/register', [
                    'error' => 'La contraseña debe tener al menos 8 caracteres'
                ]);
            }

            if ($this->userModel->userExists($username)) {
                return $this->render('auth/register', [
                    'error' => 'El usuario ya existe'
                ]);
            }

            if ($this->userModel->create($username, $password)) {
                header('Location: ' . Config::get('APP_URL') . '/public/index.php?route=auth/login');
                exit();
            }

            return $this->render('auth/register', [
                'error' => 'Error al crear el usuario'
            ]);
        }

        return $this->render('auth/register');
    }

    public function logout() {
        session_destroy();
        header('Location: ' . Config::get('APP_URL') . '/public/index.php?route=auth/login');
        exit();
    }
}