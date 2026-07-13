<?php

class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);

        require_once __DIR__ . '/../views/' . $view . '.php';
    }

    protected function requireLogin(): void
    {
        if (!isset($_SESSION['usuario_id'])) {

            header('Location: ' . BASE_URL . '/login');
            exit;

        }
    }
}