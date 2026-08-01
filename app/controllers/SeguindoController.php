<?php

class SeguindoController extends Controller
{
    public function index(): void
    {
        $this->requireLogin();

        $artistaModel = new Artista();
        $seguidos = $artistaModel->listarSeguidos($_SESSION['usuario_id']);

        $this->view('seguindo/index', [
            'seguidos' => $seguidos
        ]);
    }
}