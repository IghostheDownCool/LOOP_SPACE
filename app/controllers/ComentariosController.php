<?php

class ComentariosController extends Controller
{
    public function adicionar(): void
    {
        $this->requireLogin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . $_SERVER['HTTP_REFERER'] ?? BASE_URL);
            exit;
        }

        $musicaId = (int) ($_POST['musica_id'] ?? 0);
        $comentario = trim($_POST['comentario'] ?? '');

        if ($musicaId <= 0 || empty($comentario)) {
            Flash::set('danger', 'Comentário inválido.');
            header('Location: ' . $_SERVER['HTTP_REFERER'] ?? BASE_URL);
            exit;
        }

        $comentarioModel = new Comentario();
        if ($comentarioModel->criar($_SESSION['usuario_id'], $musicaId, $comentario)) {
            Flash::set('success', 'Comentário adicionado com sucesso!');
        } else {
            Flash::set('danger', 'Erro ao adicionar comentário.');
        }

        header('Location: ' . $_SERVER['HTTP_REFERER'] ?? BASE_URL);
        exit;
    }

    public function excluir(int $id): void
    {
        $this->requireLogin();

        $comentarioModel = new Comentario();
        if ($comentarioModel->excluir($id, $_SESSION['usuario_id'])) {
            Flash::set('success', 'Comentário removido com sucesso!');
        } else {
            Flash::set('danger', 'Erro ao remover comentário.');
        }

        header('Location: ' . $_SERVER['HTTP_REFERER'] ?? BASE_URL);
        exit;
    }
}