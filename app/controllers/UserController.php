<?php
class UserController extends BaseController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function index() {
        if (!isset($_SESSION['usuario'])) {
            $this->redirect('/auth/login');
        }
        
        $users = $this->userModel->getAllUsers();
        $this->render('users/list', ['users' => $users]);
    }
}