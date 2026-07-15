<?php

require_once __DIR__ . '/../models/Curtida.php';

class CurtidasController extends Controller
{
    public function curtir(int $musicaId): void
    {
        $this->requireLogin();

        $curtida = new Curtida();

        $curtida->curtir(
            $_SESSION['usuario_id'],
            $musicaId
        );

        header('Location: ' . $_SERVER['HTTP_REFERER']);

        exit;
    }

    public function descurtir(int $musicaId): void
    {
        $this->requireLogin();

        $curtida = new Curtida();

        $curtida->descurtir(
            $_SESSION['usuario_id'],
            $musicaId
        );

        header('Location: ' . $_SERVER['HTTP_REFERER']);

        exit;
    }
}