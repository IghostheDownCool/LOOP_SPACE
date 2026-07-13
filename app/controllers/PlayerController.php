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
}