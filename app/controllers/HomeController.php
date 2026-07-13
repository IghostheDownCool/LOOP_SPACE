<?php

class HomeController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['usuario_id'])) {

            header('Location: /LOOP_SPACE/public/login');
            exit;
        }

        $this->view('home');
    }
}