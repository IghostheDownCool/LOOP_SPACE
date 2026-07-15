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
$idsMusicas = $playlist->listarIdsMusicas($id);

$this->view('playlists/ver', [
    'playlist' => $dadosPlaylist,
    'musicas' => $musicasPlaylist,
    'todasMusicas' => $todasMusicas,
'idsMusicas' => $idsMusicas
]);
}
public function adicionarMusica(int $playlistId)
{
    $this->requireLogin();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $musicaId = (int) $_POST['musica_id'];

        if ($musicaId > 0) {

            $playlist = new Playlist();

            $playlist->adicionarMusica(
                $playlistId,
                $musicaId
            );
        }
    }

    header('Location: ' . BASE_URL . '/playlists/ver/' . $playlistId);
    exit;
}
public function removerMusica(
    int $playlistId,
    int $musicaId
)
{
    $this->requireLogin();

    $playlist = new Playlist();

    $playlist->removerMusica(
        $playlistId,
        $musicaId
    );

    header(
        'Location: ' . BASE_URL . '/playlists/ver/' . $playlistId
    );

    exit;
}
}