<?php

class PerfilController extends Controller
{
    public function index(): void
    {
        $this->requireLogin();

        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->buscarPorId($_SESSION['usuario_id']);

        $this->view('perfil/index', [
            'usuario' => $usuario
        ]);
    }

    public function atualizarAvatar(): void
{
    $this->requireLogin();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ' . BASE_URL . '/perfil');
        exit;
    }

    $usuarioId = $_SESSION['usuario_id'];

    // Verifica se o arquivo foi enviado
    if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] !== UPLOAD_ERR_OK) {
        Flash::set('danger', 'Nenhum arquivo foi enviado ou ocorreu um erro.');
        header('Location: ' . BASE_URL . '/perfil');
        exit;
    }

    // Upload do avatar
    $avatar = UploadHelper::upload(
        $_FILES['avatar'],
        __DIR__ . '/../../public/uploads/avatars/',
        ['jpg', 'jpeg', 'png', 'gif', 'webp'],
        2097152 // 2MB
    );

    if (!$avatar) {
        Flash::set('danger', 'Erro ao enviar avatar. Verifique o formato (JPG, PNG, GIF, WEBP) e o tamanho (máx. 2MB).');
        header('Location: ' . BASE_URL . '/perfil');
        exit;
    }

    // Remove avatar antigo se existir
    $usuarioModel = new Usuario();
    $usuario = $usuarioModel->buscarPorId($usuarioId);
    if ($usuario['avatar'] && file_exists(__DIR__ . '/../../public/uploads/avatars/' . $usuario['avatar'])) {
        unlink(__DIR__ . '/../../public/uploads/avatars/' . $usuario['avatar']);
    }

    // Atualiza o banco
    if ($usuarioModel->atualizarAvatar($usuarioId, $avatar)) {
        Flash::set('success', 'Avatar atualizado com sucesso!');
    } else {
        Flash::set('danger', 'Erro ao atualizar avatar.');
    }

    header('Location: ' . BASE_URL . '/perfil');
    exit;
}

    public function removerAvatar(): void
    {
        $this->requireLogin();

        $usuarioId = $_SESSION['usuario_id'];
        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->buscarPorId($usuarioId);

        if ($usuario['avatar'] && file_exists(__DIR__ . '/../../public/uploads/avatars/' . $usuario['avatar'])) {
            unlink(__DIR__ . '/../../public/uploads/avatars/' . $usuario['avatar']);
        }

        if ($usuarioModel->atualizarAvatar($usuarioId, null)) {
            Flash::set('success', 'Avatar removido com sucesso!');
        } else {
            Flash::set('danger', 'Erro ao remover avatar.');
        }

        header('Location: ' . BASE_URL . '/perfil');
        exit;
    }
}