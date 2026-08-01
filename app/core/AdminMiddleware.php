<?php

class AdminMiddleware
{
    public static function verificar(): void
    {
        // Verifica se o usuário está logado
        if (!isset($_SESSION['usuario_id'])) {
            Flash::set('danger', 'Faça login para acessar esta área.');
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        // Verifica se o usuário é admin
        $usuarioModel = new Usuario();
        if (!$usuarioModel->isAdmin($_SESSION['usuario_id'])) {
            Flash::set('danger', 'Acesso negado. Você não tem permissão para acessar esta área.');
            header('Location: ' . BASE_URL);
            exit;
        }
    }
}