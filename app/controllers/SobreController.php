<?php

class SobreController extends Controller
{
    public function index(): void
    {
        // Busca estatísticas do sistema
        $musicaModel = new Musica();
        $artistaModel = new Artista();
        $albumModel = new Album();
        $usuarioModel = new Usuario();
        $playlistModel = new Playlist();

        $totalMusicas = $musicaModel->contar();
        $totalArtistas = $artistaModel->contar();
        $totalAlbuns = $albumModel->contar();
        $totalUsuarios = $usuarioModel->contar();
        $totalPlaylists = $playlistModel->contar();

        $this->view('sobre/index', [
            'totalMusicas' => $totalMusicas,
            'totalArtistas' => $totalArtistas,
            'totalAlbuns' => $totalAlbuns,
            'totalUsuarios' => $totalUsuarios,
            'totalPlaylists' => $totalPlaylists
        ]);
    }
}