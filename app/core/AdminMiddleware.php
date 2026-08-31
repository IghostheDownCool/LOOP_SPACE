<?php

class AdminMiddleware
{
    public static function verificar(): void
    {
        if (!isset($_SESSION['usuario_id'])) {
            Flash::set('danger', 'Faça login para acessar esta área.');
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $usuarioModel = new Usuario();
        if (!$usuarioModel->isAdmin($_SESSION['usuario_id'])) {
            Flash::set('danger', 'Acesso negado. Você não tem permissão para acessar esta área.');
            header('Location: ' . BASE_URL);
            exit;
        }
    }
}