<?php

class CadastroController extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = trim($_POST['nome']);
            $email = trim($_POST['email']);
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

            $usuario = new Usuario();

            $usuario->cadastrar($nome, $email, $senha);

            echo "Usuário cadastrado com sucesso!";

            return;
        }

        $this->view('cadastro');
    }
}