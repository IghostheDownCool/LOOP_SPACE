<?php

class ArtistasController extends Controller
{
    public function index()
    {
        $this->requireLogin();

        $artista = new Artista();

        $artistas = $artista->listar();

        $this->view('artistas/index', [
            'artistas' => $artistas
        ]);
    }

    public function cadastrar()
    {
        $this->requireLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = trim($_POST['nome']);

            if ($nome !== '') {

                $artista = new Artista();

                $artista->cadastrar($nome);

                header('Location: ' . BASE_URL . '/artistas');
                exit;
            }
        }

        $this->view('artistas/cadastrar');
    }
}