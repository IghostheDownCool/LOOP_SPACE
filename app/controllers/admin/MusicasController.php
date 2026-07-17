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

            $arquivo = $_FILES['arquivo'] ?? null;

            if ($titulo !== '') {

    if (!$arquivo || $arquivo['error'] !== UPLOAD_ERR_OK) {

        die('Erro ao enviar o arquivo.');

    }

    $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));

    if ($extensao !== 'mp3') {

        die('Somente arquivos MP3 são permitidos.');

    }

    $nomeArquivo = uniqid('musica_', true) . '.mp3';

    $destino = __DIR__
        . '/../../../public/uploads/musicas/'
        . $nomeArquivo;

    if (!move_uploaded_file($arquivo['tmp_name'], $destino)) {

        die('Não foi possível salvar o arquivo.');

        // Após salvar a música
if ($musicaModel->cadastrar(...)) {
    // Notificar seguidores do artista
    $artistaModel = new Artista();
    $seguidores = $artistaModel->listarSeguidores($artistaId);

    $notificacaoModel = new Notificacao();
    foreach ($seguidores as $seguidor) {
        $notificacaoModel->criar(
            $seguidor['usuario_id'],
            'nova_musica',
            "O artista {$artistaNome} lançou uma nova música: {$titulo}",
            "/artista/ver/{$artistaId}"
        );
    }
}
    }

    $musica->cadastrar(
        $titulo,
        $albumId,
        $numeroFaixa,
        $duracao,
        $nomeArquivo
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