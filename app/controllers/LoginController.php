<?php

class LoginController extends Controller
{
    public function index(): void
    {
        if (isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL);
            exit;
        }

        $this->view('login/index');
    }

    public function logar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $senha = $_POST['senha'] ?? '';

            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->buscarPorEmailLogin($email);

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_email'] = $usuario['email'];
                $_SESSION['usuario_role'] = $usuario['role'] ?? 'user';

                header('Location: ' . BASE_URL);
                exit;
            } else {
                Flash::set('danger', 'E-mail ou senha incorretos.');
                header('Location: ' . BASE_URL . '/login');
                exit;
            }
        }

        header('Location: ' . BASE_URL . '/login');
        exit;
    }
    
}