<?php

class ArtistaController extends Controller
{
    public function ver(int $id): void
    {
        $this->requireLogin();

        $artistaModel = new Artista();
        $artista = $artistaModel->buscarCompleto($id);

        if (!$artista) {
            die('Artista não encontrado.');
        }

        $musicas = $artistaModel->listarMusicas($id);
        $albuns = $artistaModel->listarAlbuns($id);

        $this->view('artistas/ver', [
            'artista' => $artista,
            'musicas' => $musicas,
            'albuns' => $albuns
        ]);
    }
}