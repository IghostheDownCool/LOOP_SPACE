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

    public function excluir(int $id)
{
    AdminMiddleware::verificar();
    
    $usuarioModel = new Usuario();
    $usuario = $usuarioModel->buscarPorId($id);
    
    if (!$usuario) {
        Flash::set('danger', 'Usuário não encontrado.');
        header('Location: ' . BASE_URL . '/admin/usuarios');
        exit;
    }
    
    if ($usuarioModel->excluir($id)) {
        Flash::set('success', 'Usuário excluído com sucesso!');
    } else {
        Flash::set('danger', 'Erro ao excluir usuário.');
    }
    
    header('Location: ' . BASE_URL . '/admin/usuarios');
    exit;
}

public function lixeira()
{
    AdminMiddleware::verificar();
    
    $usuarioModel = new Usuario();
    $usuarios = $usuarioModel->listDeleted('usuarios');
    
    $this->view('admin/usuarios/lixeira', [
        'usuarios' => $usuarios
    ]);
}

public function restaurar(int $id)
{
    AdminMiddleware::verificar();
    
    $usuarioModel = new Usuario();
    if ($usuarioModel->restore($id, 'usuarios')) {
        Flash::set('success', 'Usuário restaurado com sucesso!');
    } else {
        Flash::set('danger', 'Erro ao restaurar usuário.');
    }
    
    header('Location: ' . BASE_URL . '/admin/usuarios/lixeira');
    exit;
}
}