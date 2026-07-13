<?php

// 1. Primeiro definimos a classe base (Pai)
class AdminController extends Controller
{
    protected string $titulo = 'Painel Administrativo';

    public function __construct()
    {
        $this->requireLogin();
    }

    protected function redirect(string $rota): void
    {
        header('Location: ' . BASE_URL . $rota);
        exit;
    }
}

// 2. Depois definimos a classe filha que herda da classe base
