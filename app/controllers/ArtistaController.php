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

    // TESTE: require direto (pula a função view)
    require_once __DIR__ . '/../views/artistas/ver.php';
    exit;
}
}