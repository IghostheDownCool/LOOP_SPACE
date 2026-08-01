<?php

class GeneroController extends Controller
{
    public function index(): void
    {
        $this->requireLogin();

        $musicaModel = new Musica();
        $generos = $musicaModel->listarGeneros();

        $this->view('generos/index', [
            'generos' => $generos
        ]);
    }

    public function ver(string $genero): void
    {
        $this->requireLogin();

        $musicaModel = new Musica();
        $musicas = $musicaModel->listarPorGenero($genero);

            // 🔥 SALVAR NO HISTÓRICO DE NAVEGAÇÃO
    $historicoNav = new HistoricoNavegacao();
    $historicoNav->salvar(
        $_SESSION['usuario_id'],
        'genero',
        0,
        $genero,
        '/genero/' . urlencode($genero),
        null
    );

        $this->view('generos/ver', [
            'genero' => $genero,
            'musicas' => $musicas
        ]);
    }
}