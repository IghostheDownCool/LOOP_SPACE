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

            $_SESSION['usuario_id'] = $dadosUsuario['id'];
$_SESSION['usuario_nome'] = $dadosUsuario['nome'];

header('Location: /LOOP_SPACE/public/');
exit;
        }

        $this->view('login');
    }
}