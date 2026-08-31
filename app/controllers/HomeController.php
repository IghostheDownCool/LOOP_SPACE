<?php

class HomeController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['usuario_id'])) {
            $this->view('home/landing');
            return;
        }

        $usuarioId = $_SESSION['usuario_id'];

        $usuarioModel = new Usuario();
        $isAdmin = $usuarioModel->isAdmin($usuarioId);

        $historicoNavegacao = [];
        if (!$isAdmin) {
            $historicoNavegacaoModel = new HistoricoNavegacao();
            $historicoNavegacao = $historicoNavegacaoModel->listar($usuarioId, 10);
        }

        $historico = new Historico();
        $artistas = $historico->artistasMaisOuvidos($usuarioId, 5);
        $artistasIds = array_column($artistas, 'id');

        $musicaModel = new Musica();
        $recomendacoes = $musicaModel->recomendarPorArtistas($artistasIds, 10);

        $topMusicas = $musicaModel->topMusicas();

        $artistaModel = new Artista();
        $seguidos = $artistaModel->listarSeguidos($usuarioId);
        $musicasSeguidos = $artistaModel->getMusicasDosSeguidos($usuarioId, 10);

        $filaRecomendacoes = array_column($recomendacoes, 'id');
        $filaTop = array_column($topMusicas, 'id');
        $filaSeguidos = array_column($musicasSeguidos, 'id');

        $this->view('home/index', [
            'historicoNavegacao' => $historicoNavegacao,
            'recomendacoes' => $recomendacoes,
            'topMusicas' => $topMusicas,
            'seguidos' => $seguidos,
            'musicasSeguidos' => $musicasSeguidos,
            'filaRecomendacoes' => $filaRecomendacoes,
            'filaTop' => $filaTop,
            'filaSeguidos' => $filaSeguidos
        ]);
    }
}