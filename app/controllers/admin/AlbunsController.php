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
            $capa = $_FILES['capa'] ?? null;

            if ($titulo !== '') {

    $nomeCapa = null;

    if ($capa && $capa['error'] === UPLOAD_ERR_OK) {

        $extensao = strtolower(pathinfo($capa['name'], PATHINFO_EXTENSION));

        $permitidas = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($extensao, $permitidas)) {

            die('Formato de imagem inválido.');

        }

        $nomeCapa = uniqid('capa_', true) . '.' . $extensao;

        $destino = __DIR__
            . '/../../../public/uploads/capas/'
            . $nomeCapa;

        if (!move_uploaded_file($capa['tmp_name'], $destino)) {

            die('Erro ao salvar a imagem.');

        }
    }

    $album->cadastrar(
        $titulo,
        $artistaId,
        $ano,
        $nomeCapa
    );

    $this->redirect('/admin/albuns');
}
        }

        $this->view('admin/albuns/cadastrar', [
            'artistas' => $artistas
        ]);
    }

    public function editar(int $id)
{
    $album = new Album();
    $artista = new Artista();

    $artistas = $artista->listar();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $titulo = trim($_POST['titulo']);
        $artistaId = (int) $_POST['artista_id'];
        $ano = (int) $_POST['ano'];

        if ($titulo !== '') {

            $album->atualizar(
                $id,
                $titulo,
                $artistaId,
                $ano
            );

            $this->redirect('/admin/albuns');
        }
    }

    $dados = $album->buscarPorId($id);

    if (!$dados) {
        die('Álbum não encontrado.');
    }

    $this->view('admin/albuns/editar', [
        'album' => $dados,
        'artistas' => $artistas
    ]);
}

public function excluir(int $id)
{
    $album = new Album();

    $dados = $album->buscarPorId($id);

    if (!$dados) {
        die('Álbum não encontrado.');
    }

    $album->excluir($id);

    $this->redirect('/admin/albuns');
}

}