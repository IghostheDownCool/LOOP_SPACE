<?php

class PlayerController extends Controller
{
    public function index()
{
    // Verifica se o usuário NÃO está logado
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: /LOOP_SPACE/public/login');
        exit;
    }

    // 1° PASSO: Buscar as músicas do banco
    $musica = new Musica();
    $musicas = $musica->listar(); // aqui você define a variável

    // 2° PASSO: Só agora passa para a view
    $this->view('player/index', ['musicas' => $musicas]);
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
}