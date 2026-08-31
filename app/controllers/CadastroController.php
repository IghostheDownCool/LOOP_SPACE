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
            $tipo = $_POST['tipo'] ?? 'ouvinte'; 

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

            if (!$usuarioId) {
                Flash::set('danger', 'Erro ao cadastrar. Tente novamente.');
                header('Location: ' . BASE_URL . '/cadastro');
                exit;
            }

            if ($tipo === 'artista') {
                $nomeArtista = $nome;
                
                $artistaCriado = $usuarioModel->vincularArtista($usuarioId, $nomeArtista);
                
                if ($artistaCriado) {
                    Flash::set('success', 'Cadastro realizado com sucesso! Você agora é um artista. Faça login para começar a postar suas músicas.');
                } else {
                    Flash::set('warning', 'Cadastro realizado, mas houve um problema ao criar seu perfil de artista. Entre em contato com o suporte.');
                }
            } else {
                Flash::set('success', 'Cadastro realizado com sucesso! Faça login para começar a ouvir.');
            }

            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        header('Location: ' . BASE_URL . '/cadastro');
        exit;
    }
}