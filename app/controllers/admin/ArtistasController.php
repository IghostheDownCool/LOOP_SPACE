<?php

class ArtistasController extends AdminController
{
    public function index()
    {


        $artista = new Artista();

        $artistas = $artista->listar();

        $this->view('admin/artistas/index', [
            'artistas' => $artistas
        ]);
    }

    public function cadastrar()
    {


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = trim($_POST['nome']);

            if ($nome !== '') {

                $artista = new Artista();

                $artista->cadastrar($nome);

                header('Location: ' . BASE_URL . '/admin/artistas');
                exit;
            }
        }

        $this->view('admin/artistas/cadastrar');
    }

    public function editar(int $id)
    {


        $artista = new Artista();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = trim($_POST['nome']);

            if ($nome !== '') {

                $artista->atualizar($id, $nome);

                header('Location: ' . BASE_URL . '/admin/artistas');
                exit;
            }
        }

        $dados = $artista->buscarPorId($id);

        if (!$dados) {
            die('Artista não encontrado.');
        }

        $this->view('admin/artistas/editar', [
            'artista' => $dados
        ]);
    }

    public function excluir(int $id)
    {


        $artista = new Artista();

        $dados = $artista->buscarPorId($id);

        if (!$dados) {
            die('Artista não encontrado.');
        }

        $artista->excluir($id);

        header('Location: ' . BASE_URL . '/admin/artistas');
        exit;
    }
}