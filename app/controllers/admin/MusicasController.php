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
    public function editar(int $id)
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

            $musica->atualizar(
                $id,
                $titulo,
                $albumId,
                $numeroFaixa,
                $duracao
            );

            $this->redirect('/admin/musicas');
        }
    }

    $dados = $musica->buscarPorId($id);

    if (!$dados) {
        die('Música não encontrada.');
    }

    $this->view('admin/musicas/editar', [
        'musica' => $dados,
        'albuns' => $albuns
    ]);
}

public function excluir(int $id)
{
    $musica = new Musica();

    $dados = $musica->buscarPorId($id);

    if (!$dados) {
        die('Música não encontrada.');
    }

    $musica->excluir($id);

    $this->redirect('/admin/musicas');
}
}