<?php

class AlbunsController extends AdminController
{
    public function index()
    {
        $album = new Album();

        $albuns = $album->listar();

        $this->view('admin/albuns/index', [
            'albuns' => $albuns
        ]);
    }

    public function cadastrar()
    {
        $album = new Album();
        $artista = new Artista();

        $artistas = $artista->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $titulo = trim($_POST['titulo']);
            $artistaId = (int) $_POST['artista_id'];
            $ano = (int) $_POST['ano'];

            if ($titulo !== '') {

                $album->cadastrar($titulo, $artistaId, $ano);

                $this->redirect('/admin/albuns');
            }
        }

        $this->view('admin/albuns/cadastrar', [
            'artistas' => $artistas
        ]);
    }
}