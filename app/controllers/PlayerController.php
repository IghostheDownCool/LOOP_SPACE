<?php

class PlayerController extends Controller
{
    public function index()
    {
        $musica = new Musica();

        $musicas = $musica->listar();

        $this->view('player/index', [
            'musicas' => $musicas
        ]);
    }
    public function reproduzir(int $id)
{
    $musica = new Musica();

    $musica->incrementarReproducoes($id);

    http_response_code(200);

    echo json_encode([
        'success' => true
    ]);
}

public function top()
{
    $musica = new Musica();

    $musicas = $musica->topMusicas();

    $this->view('player/top', [
        'musicas' => $musicas
    ]);
}
}