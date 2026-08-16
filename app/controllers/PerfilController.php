<?php

class PerfilController extends Controller
{
    public function index(): void
{
    $this->requireLogin();

    $usuarioId = $_SESSION['usuario_id'];

    $usuarioModel = new Usuario();
    $usuario = $usuarioModel->buscarPorId($usuarioId);

    // 🔥 Busca todas as estatísticas
    $historicoModel = new Historico();
    $curtidaModel = new Curtida();
    $playlistModel = new Playlist();
    $artistaModel = new Artista();

    $totalSegundos = $historicoModel->tempoTotalOuvido($usuarioId);
    $totalMusicasOuvidas = $historicoModel->contarMusicasOuvidas($usuarioId);
    $totalCurtidas = $curtidaModel->contarPorUsuario($usuarioId);
    $totalPlaylists = $playlistModel->contarPorUsuario($usuarioId);
    $totalArtistasSeguidos = $artistaModel->contarSeguidos($usuarioId);

    // Formata o tempo
    $horas = floor($totalSegundos / 3600);
    $minutos = floor(($totalSegundos % 3600) / 60);
    $tempoFormatado = '';
    if ($horas > 0) {
        $tempoFormatado .= $horas . 'h ';
    }
    $tempoFormatado .= $minutos . 'min';

    $this->view('perfil/index', [
        'usuario' => $usuario,
        'totalSegundos' => $totalSegundos,
        'tempoFormatado' => $tempoFormatado,
        'totalMusicasOuvidas' => $totalMusicasOuvidas,
        'totalCurtidas' => $totalCurtidas,
        'totalPlaylists' => $totalPlaylists,
        'totalArtistasSeguidos' => $totalArtistasSeguidos
    ]);
}

public function atualizarNome(): void
{
    $this->requireLogin();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ' . BASE_URL . '/perfil');
        exit;
    }

    $nome = trim($_POST['nome'] ?? '');

    if (empty($nome)) {
        Flash::set('danger', 'O nome é obrigatório.');
        header('Location: ' . BASE_URL . '/perfil');
        exit;
    }

    $usuarioModel = new Usuario();
    if ($usuarioModel->atualizarNome($_SESSION['usuario_id'], $nome)) {
        $_SESSION['usuario_nome'] = $nome;
        Flash::set('success', 'Nome atualizado com sucesso!');
    } else {
        Flash::set('danger', 'Erro ao atualizar nome.');
    }

    header('Location: ' . BASE_URL . '/perfil');
    exit;
}

public function atualizarSenha(): void
{
    $this->requireLogin();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ' . BASE_URL . '/perfil');
        exit;
    }

    $senhaAtual = $_POST['senha_atual'] ?? '';
    $novaSenha = $_POST['nova_senha'] ?? '';
    $confirmarSenha = $_POST['confirmar_senha'] ?? '';

    if (empty($senhaAtual) || empty($novaSenha) || empty($confirmarSenha)) {
        Flash::set('danger', 'Preencha todos os campos de senha.');
        header('Location: ' . BASE_URL . '/perfil');
        exit;
    }

    if ($novaSenha !== $confirmarSenha) {
        Flash::set('danger', 'As senhas não coincidem.');
        header('Location: ' . BASE_URL . '/perfil');
        exit;
    }

    if (strlen($novaSenha) < 6) {
        Flash::set('danger', 'A nova senha deve ter pelo menos 6 caracteres.');
        header('Location: ' . BASE_URL . '/perfil');
        exit;
    }

    $usuarioModel = new Usuario();
    $usuario = $usuarioModel->buscarPorId($_SESSION['usuario_id']);

    if (!password_verify($senhaAtual, $usuario['senha'])) {
        Flash::set('danger', 'Senha atual incorreta.');
        header('Location: ' . BASE_URL . '/perfil');
        exit;
    }

    $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
    if ($usuarioModel->atualizarSenha($_SESSION['usuario_id'], $novaSenhaHash)) {
        Flash::set('success', 'Senha atualizada com sucesso!');
    } else {
        Flash::set('danger', 'Erro ao atualizar senha.');
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

    public function atualizarAvatar(): void
{
    $this->requireLogin();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ' . BASE_URL . '/perfil');
        exit;
    }

    // Verifica se o arquivo foi enviado
    if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] !== UPLOAD_ERR_OK) {
        Flash::set('danger', 'Nenhum arquivo selecionado ou erro no upload.');
        header('Location: ' . BASE_URL . '/perfil');
        exit;
    }

    $usuarioId = $_SESSION['usuario_id'];
    $usuarioModel = new Usuario();
    $usuario = $usuarioModel->buscarPorId($usuarioId);

    // Upload do avatar
    $uploadHelper = new UploadHelper();
    $avatar = $uploadHelper->uploadAvatar($_FILES['avatar']);

    if (!$avatar) {
        Flash::set('danger', 'Erro ao enviar avatar. Verifique o formato (JPG, PNG, GIF, WEBP) e tamanho (máx 2MB).');
        header('Location: ' . BASE_URL . '/perfil');
        exit;
    }

    // Remove o avatar antigo
    if (!empty($usuario['avatar'])) {
        $avatarPath = __DIR__ . '/../../public/uploads/avatars/' . $usuario['avatar'];
        if (file_exists($avatarPath)) {
            unlink($avatarPath);
        }
    }

    // Salva o novo avatar
    if ($usuarioModel->atualizarAvatar($usuarioId, $avatar)) {
        Flash::set('success', 'Avatar atualizado com sucesso!');
    } else {
        Flash::set('danger', 'Erro ao atualizar avatar.');
    }

    header('Location: ' . BASE_URL . '/perfil');
    exit;
}
}