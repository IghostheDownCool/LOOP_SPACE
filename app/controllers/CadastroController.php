<?php

class CadastroController extends Controller
{
    public function index()
    {
        $erros = [];
        $old = [
            'nome' => '',
            'email' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = trim($_POST['nome']);
            $email = trim($_POST['email']);
            $senha = $_POST['senha'];

            $old['nome'] = $nome;
            $old['email'] = $email;

            // Validação do nome
            if (strlen($nome) < 3) {
                $erros[] = "O nome deve possuir pelo menos 3 caracteres.";
            }

            // Validação do e-mail
            if (empty($email)) {
                $erros[] = "O e-mail é obrigatório.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erros[] = "Informe um e-mail válido.";
            }

            // Validação da senha
            if (strlen($senha) < 6) {
                $erros[] = "A senha deve possuir pelo menos 6 caracteres.";
            }

            $usuario = new Usuario();

            // Verifica se o e-mail já existe
            if ($usuario->buscarPorEmail($email)) {
                $erros[] = "Este e-mail já está cadastrado.";
            }

            if (empty($erros)) {

                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

                $usuario->cadastrar($nome, $email, $senhaHash);

                echo "Usuário cadastrado com sucesso!";

                return;
            }
        }

        $this->view('cadastro/index', [
            'erros' => $erros,
            'old' => $old
        ]);
    }
}