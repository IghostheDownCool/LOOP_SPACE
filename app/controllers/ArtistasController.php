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
    
    public function cadastrar()
{
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: ' . BASE_URL . '/login');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nome = trim($_POST['nome']);

        if ($nome !== '') {

            $artista = new Artista();

            $artista->cadastrar($nome);

            header('Location: ' . BASE_URL . '/artistas');
            exit;
        }
    }

    $this->view('artistas_cadastrar');
}
}