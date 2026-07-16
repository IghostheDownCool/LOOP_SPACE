<?php

class HomeController extends Controller
{
    public function index()
{
    $this->requireLogin();

    $usuarioId = $_SESSION['usuario_id'];

    // Busca artistas mais ouvidos
    $historico = new Historico();
    $artistas = $historico->artistasMaisOuvidos($usuarioId, 5);

    // Busca recomendações com base nesses artistas
    $musicaModel = new Musica();
    $artistasIds = array_column($artistas, 'id');
    $recomendacoes = $musicaModel->recomendarPorArtistas($artistasIds, 10);

    // Busca as mais tocadas do momento
    $topMusicas = $musicaModel->topMusicas();

    $this->view('home/index', [
        'recomendacoes' => $recomendacoes,
        'topMusicas' => $topMusicas
    ]);
}
}