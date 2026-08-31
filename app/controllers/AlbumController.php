<?php

class AlbumController extends Controller
{
    public function ver(int $id): void
    {
        $this->requireLogin();

        $albumModel = new Album();
        $album = $albumModel->buscarCompleto($id);

        if (!$album) {
            die('Álbum não encontrado.');
        }

        $musicas = $albumModel->listarMusicas($id);

        $filaMusicas = array_column($musicas, 'id');

        $historicoNav = new HistoricoNavegacao();
        $historicoNav->salvar(
            $_SESSION['usuario_id'],
            'album',
            $album['id'],
            $album['titulo'],
            '/album/ver/' . $album['id'],
            $album['capa'] ?? null
        );

        $this->view('albuns/ver', [
            'album' => $album,
            'musicas' => $musicas,
            'filaMusicas' => $filaMusicas
        ]);
    }
}