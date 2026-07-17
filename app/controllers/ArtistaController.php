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

    public function seguir(int $id): void
    {
        $this->requireLogin();

        $artistaModel = new Artista();
        $artistaModel->seguir($_SESSION['usuario_id'], $id);

        Flash::set('success', 'Você agora segue este artista!');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function deixarSeguir(int $id): void
    {
        $this->requireLogin();

        $artistaModel = new Artista();
        $artistaModel->deixarSeguir($_SESSION['usuario_id'], $id);

        Flash::set('success', 'Você deixou de seguir este artista.');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}