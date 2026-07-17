<?php

class HomeController extends Controller
{
    public function index()
{
    $this->requireLogin();

    $usuarioId = $_SESSION['usuario_id'];

    // Busca artistas mais ouvidos do usuário
    $historico = new Historico();
    $artistas = $historico->artistasMaisOuvidos($usuarioId, 5);
    $artistasIds = array_column($artistas, 'id');

    // Busca recomendações baseadas nos artistas mais ouvidos
    $musicaModel = new Musica();
    $recomendacoes = $musicaModel->recomendarPorArtistas($artistasIds, 10);

    // Busca as músicas mais ouvidas do momento
    $topMusicas = $musicaModel->topMusicas();

    $this->view('home/index', [
        'recomendacoes' => $recomendacoes,
        'topMusicas' => $topMusicas
    ]);
}

}