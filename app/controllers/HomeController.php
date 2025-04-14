<?php
class HomeController extends BaseController {
    public function index() {
        $this->render('home/home', [    
            'title' => 'Bienvenido a AnimePink Store'
        ]);
    }
}