<?php

class UsuariosController extends Controller
{
    public function index(): void
    {
        AdminMiddleware::verificar();

        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->listarTodos();

        $this->view('admin/usuarios/index', [
            'usuarios' => $usuarios
        ]);
    }

    public function definirAdmin(int $id): void
    {
        AdminMiddleware::verificar();

        $usuarioModel = new Usuario();
        $usuarioModel->definirComoAdmin($id);

        Flash::set('success', 'Usuário promovido a administrador!');
        header('Location: ' . BASE_URL . '/admin/usuarios');
        exit;
    }

    public function removerAdmin(int $id): void
    {
        AdminMiddleware::verificar();

        // Não permite remover o próprio admin
        if ($id == $_SESSION['usuario_id']) {
            Flash::set('danger', 'Você não pode remover seu próprio status de admin.');
            header('Location: ' . BASE_URL . '/admin/usuarios');
            exit;
        }

        $usuarioModel = new Usuario();
        $usuarioModel->removerAdmin($id);

        Flash::set('success', 'Admin removido com sucesso!');
        header('Location: ' . BASE_URL . '/admin/usuarios');
        exit;
    }

    public function excluir(int $id): void
    {
        AdminMiddleware::verificar();

        // Não permite excluir o próprio admin
        if ($id == $_SESSION['usuario_id']) {
            Flash::set('danger', 'Você não pode excluir sua própria conta.');
            header('Location: ' . BASE_URL . '/admin/usuarios');
            exit;
        }

        $usuarioModel = new Usuario();
        $usuarioModel->excluir($id);

        Flash::set('success', 'Usuário excluído com sucesso!');
        header('Location: ' . BASE_URL . '/admin/usuarios');
        exit;
    }
}