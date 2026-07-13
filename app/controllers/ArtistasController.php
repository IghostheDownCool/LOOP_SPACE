<?php

class ArtistasController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /LOOP_SPACE/public/login');
            exit;
        }

        $artista = new Artista();

        $artistas = $artista->listar();

        $this->view('artistas', [
            'artistas' => $artistas
        ]);
    }
}