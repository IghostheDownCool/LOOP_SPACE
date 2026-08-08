<?php

class HomeController extends Controller
{
    public function index()
{
    // Se NÃO estiver logado, mostra a landing page
    if (!isset($_SESSION['usuario_id'])) {
        $this->view('home/landing');
        return;
    }

    // Se estiver logado, mostra a home com recomendações
    $usuarioId = $_SESSION['usuario_id'];

    $historico = new Historico();
    $artistas = $historico->artistasMaisOuvidos($usuarioId, 5);
    $artistasIds = array_column($artistas, 'id');

    $musicaModel = new Musica();
    $recomendacoes = $musicaModel->recomendarPorArtistas($artistasIds, 10);
    $topMusicas = $musicaModel->topMusicas();

    $this->view('home/index', [
        'recomendacoes' => $recomendacoes,
        'topMusicas' => $topMusicas
    ]);
}
}
