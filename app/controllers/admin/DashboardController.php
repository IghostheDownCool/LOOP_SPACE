<?php

class DashboardController extends Controller
{
    public function index(): void
    {
        AdminMiddleware::verificar();

        $usuarioModel = new Usuario();
        $musicaModel = new Musica();
        $artistaModel = new Artista();
        $albumModel = new Album();
        $playlistModel = new Playlist();
        $curtidaModel = new Curtida();

        $totalUsuarios = $usuarioModel->contar();
        $totalMusicas = $musicaModel->contar();
        $totalArtistas = $artistaModel->contar();
        $totalAlbuns = $albumModel->contar();
        $totalPlaylists = $playlistModel->contar();
        $totalCurtidas = $curtidaModel->contar();

        $ultimosUsuarios = $usuarioModel->ultimos(5);
        $ultimasMusicas = $musicaModel->ultimas(5);

        $topMusicas = $musicaModel->topMusicasLimitado(5);

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