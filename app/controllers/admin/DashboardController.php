<?php

class DashboardController extends Controller
{
    public function index(): void
    {
        $this->requireLogin();

        // Instancia os models
        $usuarioModel = new Usuario();
        $musicaModel = new Musica();
        $artistaModel = new Artista();
        $albumModel = new Album();
        $playlistModel = new Playlist();
        $curtidaModel = new Curtida();

        // Estatísticas gerais
        $totalUsuarios = $usuarioModel->contar();
        $totalMusicas = $musicaModel->contar();
        $totalArtistas = $artistaModel->contar();
        $totalAlbuns = $albumModel->contar();
        $totalPlaylists = $playlistModel->contar();
        $totalCurtidas = $curtidaModel->contar();

        // Últimos registros
        $ultimosUsuarios = $usuarioModel->ultimos(5);
        $ultimasMusicas = $musicaModel->ultimas(5);

        // Músicas mais ouvidas (top 5)
        $topMusicas = $musicaModel->topMusicasLimitado(5);

        // Artistas mais seguidos
        $topArtistas = $artistaModel->maisSeguidos(5);

        $this->view('admin/dashboard/index', [
            'totalUsuarios' => $totalUsuarios,
            'totalMusicas' => $totalMusicas,
            'totalArtistas' => $totalArtistas,
            'totalAlbuns' => $totalAlbuns,
            'totalPlaylists' => $totalPlaylists,
            'totalCurtidas' => $totalCurtidas,
            'ultimosUsuarios' => $ultimosUsuarios,
            'ultimasMusicas' => $ultimasMusicas,
            'topMusicas' => $topMusicas,
            'topArtistas' => $topArtistas
        ]);
    }
}