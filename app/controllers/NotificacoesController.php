<?php

class NotificacoesController extends Controller
{
    public function index(): void
    {
        $this->requireLogin();

        $notificacaoModel = new Notificacao();
        $notificacoes = $notificacaoModel->listar($_SESSION['usuario_id']);

        // Marca todas como lidas ao visualizar a página
        $notificacaoModel->marcarTodasComoLidas($_SESSION['usuario_id']);

        $this->view('notificacoes/index', [
            'notificacoes' => $notificacoes
        ]);
    }

    public function contar(): void
    {
        $this->requireLogin();

        $notificacaoModel = new Notificacao();
        $total = $notificacaoModel->contarNaoLidas($_SESSION['usuario_id']);

        header('Content-Type: application/json');
        echo json_encode(['total' => $total]);
    }

    public function marcarLida(int $id): void
    {
        $this->requireLogin();

        $notificacaoModel = new Notificacao();
        $notificacaoModel->marcarComoLida($id, $_SESSION['usuario_id']);

        header('Location: ' . BASE_URL . '/notificacoes');
        exit;
    }
}