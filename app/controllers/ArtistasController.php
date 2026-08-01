<?php

class ArtistasController extends Controller
{
    public function index(): void
    {
        $this->requireLogin();

        $artistaModel = new Artista();
        $artistas = $artistaModel->listar();

        $this->view('artistas/index', [
            'artistas' => $artistas
        ]);
    }
}