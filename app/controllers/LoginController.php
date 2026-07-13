<?php

class LoginController extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email']);
            $senha = $_POST['senha'];

            $usuario = new Usuario();

            $dadosUsuario = $usuario->buscarPorEmailLogin($email);

            if (!$dadosUsuario) {

                echo "Usuário não encontrado.";

                return;
            }

            if (!password_verify($senha, $dadosUsuario['senha'])) {

                echo "Senha incorreta.";

                return;
            }

            echo "Login realizado com sucesso!";
            return;
        }

        $this->view('login');
    }
}