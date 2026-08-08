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

        // ============================================
        // 1. Buscar histórico de navegação
        // ============================================
        $historicoNavegacaoModel = new HistoricoNavegacao();
        $historicoNavegacao = $historicoNavegacaoModel->listar($usuarioId, 10);

        // ============================================
        // 2. Buscar recomendações baseadas no histórico
        // ============================================
        $historico = new Historico();
        $artistas = $historico->artistasMaisOuvidos($usuarioId, 5);
        $artistasIds = array_column($artistas, 'id');

        $musicaModel = new Musica();
        $recomendacoes = $musicaModel->recomendarPorArtistas($artistasIds, 10);

        // ============================================
        // 3. Buscar top músicas
        // ============================================
        $topMusicas = $musicaModel->topMusicas();

        // ============================================
        // 4. Buscar artistas seguidos e suas músicas
        // ============================================
        $artistaModel = new Artista();
        $seguidos = $artistaModel->listarSeguidos($usuarioId);
        $musicasSeguidos = $artistaModel->getMusicasDosSeguidos($usuarioId, 10);

        // ============================================
        // 5. Enviar TODOS os dados para a view
        // ============================================
        $this->view('home/index', [
            'historicoNavegacao' => $historicoNavegacao,
            'recomendacoes' => $recomendacoes,
            'topMusicas' => $topMusicas,
            'seguidos' => $seguidos,
            'musicasSeguidos' => $musicasSeguidos
        ]);
    }
}