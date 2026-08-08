<?php

class CadastroController extends Controller
{
    public function index(): void
    {
        if (isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL);
            exit;
        }

        $this->view('cadastro/index');
    }

    public function cadastrar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $senha = $_POST['senha'] ?? '';

            if (empty($nome) || empty($email) || empty($senha)) {
                Flash::set('danger', 'Preencha todos os campos.');
                header('Location: ' . BASE_URL . '/cadastro');
                exit;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Flash::set('danger', 'E-mail inválido.');
                header('Location: ' . BASE_URL . '/cadastro');
                exit;
            }

            if (strlen($senha) < 6) {
                Flash::set('danger', 'A senha deve ter pelo menos 6 caracteres.');
                header('Location: ' . BASE_URL . '/cadastro');
                exit;
            }

            $usuarioModel = new Usuario();

            if ($usuarioModel->buscarPorEmail($email)) {
                Flash::set('danger', 'Este e-mail já está cadastrado.');
                header('Location: ' . BASE_URL . '/cadastro');
                exit;
            }

            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $usuarioId = $usuarioModel->cadastrar($nome, $email, $senhaHash);

            if ($usuarioId) {
                Flash::set('success', 'Cadastro realizado com sucesso! Faça login.');
                header('Location: ' . BASE_URL . '/login');
                exit;
            } else {
                Flash::set('danger', 'Erro ao cadastrar. Tente novamente.');
                header('Location: ' . BASE_URL . '/cadastro');
                exit;
            }
        }

        header('Location: ' . BASE_URL . '/cadastro');
        exit;
    }
}