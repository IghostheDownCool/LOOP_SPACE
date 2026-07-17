<?php

class SeguidorController extends Controller
{
    public function seguir(int $artistaId)
    {
        $this->requireLogin();

        $usuarioId = $_SESSION['usuario_id'];

        $seguidor = new Seguidor();
        $seguidor->seguir($usuarioId, $artistaId);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'seguindo' => true]);
        exit;
    }

    public function deixarSeguir(int $artistaId)
    {
        $this->requireLogin();

        $usuarioId = $_SESSION['usuario_id'];

        $seguidor = new Seguidor();
        $seguidor->deixarSeguir($usuarioId, $artistaId);

        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'seguindo' => false]);
        exit;
    }

    public function status(int $artistaId)
    {
        $this->requireLogin();

        $usuarioId = $_SESSION['usuario_id'];

        $seguidor = new Seguidor();
        $estaSeguindo = $seguidor->estaSeguindo($usuarioId, $artistaId);

        header('Content-Type: application/json');
        echo json_encode(['seguindo' => $estaSeguindo]);
        exit;
    }
}