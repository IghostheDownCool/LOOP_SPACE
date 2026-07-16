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

        $this->view('albuns/ver', [
            'album' => $album,
            'musicas' => $musicas
        ]);
    }
}