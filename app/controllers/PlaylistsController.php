<?php

class PlaylistsController extends Controller
{
    public function index()
{
    $this->requireLogin();

    $playlist = new Playlist();

    $playlists = $playlist->listar(
        $_SESSION['usuario_id']
    );

    $this->view('playlists/index', [
        'playlists' => $playlists
    ]);
}
public function cadastrar()
{
    $this->requireLogin();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nome = trim($_POST['nome']);

        $publica = isset($_POST['publica']) ? 1 : 0;

        if ($nome !== '') {

            $playlist = new Playlist();

            $playlist->cadastrar(
                $_SESSION['usuario_id'],
                $nome,
                $publica
            );

            header('Location: ' . BASE_URL . '/playlists');
            exit;
        }
    }

    $this->view('playlists/cadastrar');
}
public function ver(int $id)
{
    $this->requireLogin();

    $playlist = new Playlist();

    $dadosPlaylist = $playlist->buscarPorId($id);

    if (!$dadosPlaylist) {

        die('Playlist não encontrada.');

    }

    $musicasPlaylist = $playlist->listarMusicas($id);

$musica = new Musica();

$todasMusicas = $musica->listar();

$this->view('playlists/ver', [
    'playlist' => $dadosPlaylist,
    'musicas' => $musicasPlaylist,
    'todasMusicas' => $todasMusicas
]);
}
}