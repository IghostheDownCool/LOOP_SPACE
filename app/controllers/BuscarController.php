<?php

class BuscarController extends Controller
{
    public function index(): void  // <-- agora é index
    {
        $this->requireLogin();

        $termo = trim($_GET['q'] ?? '');

        if (strlen($termo) < 2) {
            echo json_encode([]);
            return;
        }

        $musica = new Musica();
        $resultados = $musica->buscar($termo);

        header('Content-Type: application/json');
        echo json_encode($resultados);
    }
}