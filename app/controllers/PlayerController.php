<?php

class PlayerController extends Controller
{
    public function index(?string $genero = null): void
{
    $this->requireLogin();

    $musicaModel = new Musica();

    if ($genero) {
        $musicas = $musicaModel->listarPorGenero($genero);
    } else {
        $musicas = $musicaModel->listar();
    }

    $generos = $musicaModel->listarGeneros();

    $this->view('player/index', [
        'musicas' => $musicas,
        'generos' => $generos,
        'generoAtual' => $genero
    ]);
}

public function reproduzir(int $id)
{
    $this->requireLogin();

    $musica = new Musica();

    $musica->incrementarReproducoes($id);

    $historico = new Historico();

    $historico->registrar(
        $_SESSION['usuario_id'],
        $id
    );

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

public function dados(int $id): void
{
    $this->requireLogin();

    $musica = new Musica();
    $dados = $musica->buscarPorId($id);

    if (!$dados) {
        http_response_code(404);
        echo json_encode(['error' => 'Música não encontrada']);
        return;
    }

    echo json_encode($dados);
}
}