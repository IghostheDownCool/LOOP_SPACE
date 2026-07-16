<?php

class HistoricoController extends Controller
{
    public function index()
    {
        $this->requireLogin();

        $historico = new Historico();

        $musicas = $historico->listar(
            $_SESSION['usuario_id']
        );

        $this->view('historico/index', [
            'musicas' => $musicas
        ]);
    }
}