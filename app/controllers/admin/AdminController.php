<?php

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