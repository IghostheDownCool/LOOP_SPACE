<?php

class HistoricoController extends Controller
{
    public function index()
{
    $this->requireLogin();

    $historico = new Historico();
    $historicoData = $historico->listar($_SESSION['usuario_id']);
    
    error_log("📝 Controller: " . count($historicoData) . " registros encontrados");

    $this->view('historico/index', [
        'historico' => $historicoData
    ]);
}

public function registrar(int $musicaId): void
{
    $this->requireLogin();

    error_log("📝 Controller registrar: usuario_id={$_SESSION['usuario_id']}, musica_id={$musicaId}");

    $historico = new Historico();
    $result = $historico->registrar($_SESSION['usuario_id'], $musicaId);

    http_response_code($result ? 200 : 500);
    echo json_encode(['success' => $result]);
}
}
