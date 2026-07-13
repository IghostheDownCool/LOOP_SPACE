<?php

class MusicasController extends AdminController
{
    public function index()
    {
        $musica = new Musica();

        $musicas = $musica->listar();

        $this->view('admin/musicas/index', [
            'musicas' => $musicas
        ]);
    }

    public function cadastrar()
    {
        $musica = new Musica();
        $album = new Album();

        $albuns = $album->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $titulo = trim($_POST['titulo']);
            $albumId = (int) $_POST['album_id'];
            $numeroFaixa = (int) $_POST['numero_faixa'];
            $duracao = (int) $_POST['duracao'];

            if ($titulo !== '') {

                $musica->cadastrar(
                    $titulo,
                    $albumId,
                    $numeroFaixa,
                    $duracao
                );

                $this->redirect('/admin/musicas');
            }
        }

        $this->view('admin/musicas/cadastrar', [
            'albuns' => $albuns
        ]);
    }
}