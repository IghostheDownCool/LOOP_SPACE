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

        // Busca as músicas do álbum
        $musicas = $albumModel->listarMusicas($id);

        // 🔥 DEFINE A FILA DE MÚSICAS
        $filaMusicas = array_column($musicas, 'id');

        // Salvar no histórico de navegação
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
            'filaMusicas' => $filaMusicas // 🔥 ADICIONADO
        ]);
    }
}