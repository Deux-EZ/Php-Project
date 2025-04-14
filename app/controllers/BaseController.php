<?php
class BaseController {
    protected function render($view, $data = []) {
        extract($data);
        require_once __DIR__ . "/../views/{$view}.php";
    }

    protected function redirect($path) {
        header("Location: " . Config::get('APP_URL') . $path);
        exit();
    }
}