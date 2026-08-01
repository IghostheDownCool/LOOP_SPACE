<?php

class AlbumController extends Controller
{
    public function ver(int $id): void
    {
        $this->requireLogin();

        $albumModel = new Album();
        $album = $albumModel->buscarCompleto($id);

            // 🔥 SALVAR NO HISTÓRICO DE NAVEGAÇÃO
    $historicoNav = new HistoricoNavegacao();
    $historicoNav->salvar(
        $_SESSION['usuario_id'],
        'album',
        $album['id'],
        $album['titulo'],
        '/album/ver/' . $album['id'],
        $album['capa'] ?? null
    );

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