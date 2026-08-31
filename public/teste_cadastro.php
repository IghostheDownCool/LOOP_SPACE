<?php
session_start();
require_once '../config/config.php';
require_once '../app/core/Autoload.php';

echo "<h2>Teste de Cadastro</h2>";

$nome = 'Teste';
$email = 'teste@teste.com';
$senha = '123456';

echo "Nome: " . $nome . "<br>";
echo "Email: " . $email . "<br>";
echo "Senha: " . $senha . "<br>";

$usuarioModel = new Usuario();

if ($usuarioModel->buscarPorEmail($email)) {
    echo "Email já cadastrado!<br>";
    echo "Vamos deletar para testar...<br>";
    
    try {
        $sql = "DELETE FROM usuarios WHERE email = :email";
        $stmt = $usuarioModel->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        echo "✅ Usuário deletado!<br>";
    } catch (PDOException $e) {
        echo "Erro ao deletar: " . $e->getMessage() . "<br>";
    }
}

echo "<h3>1. Testando password_hash()</h3>";
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);
echo "Senha original: '" . $senha . "'<br>";
echo "Hash gerado: '" . $senhaHash . "'<br>";
echo "Tamanho do hash: " . strlen($senhaHash) . " caracteres<br>";

echo "<h3>2. Testando cadastrar()</h3>";
$usuarioId = $usuarioModel->cadastrar($nome, $email, $senhaHash);

if ($usuarioId) {
    echo "Usuário cadastrado com ID: " . $usuarioId . "<br>";
    
    echo "<h3>3. Verificando o usuário salvo</h3>";
    $usuarioSalvo = $usuarioModel->buscarPorEmailLogin($email);
    
    if ($usuarioSalvo) {
        echo "Usuário encontrado no banco!<br>";
        echo "ID: " . $usuarioSalvo['id'] . "<br>";
        echo "Nome: " . $usuarioSalvo['nome'] . "<br>";
        echo "Email: " . $usuarioSalvo['email'] . "<br>";
        echo "Hash salvo: '" . $usuarioSalvo['senha'] . "'<br>";
        echo "Tamanho do hash salvo: " . strlen($usuarioSalvo['senha']) . " caracteres<br>";
        
        echo "<h3>4. Testando password_verify()</h3>";
        if (password_verify($senha, $usuarioSalvo['senha'])) {
            echo "SENHA CORRETA! O cadastro funcionou!<br>";
        } else {
            echo "SENHA INCORRETA! O hash salvo não corresponde à senha.<br>";
            echo "Hash salvo: '" . $usuarioSalvo['senha'] . "'<br>";
            echo "Hash esperado: '" . $senhaHash . "'<br>";
        }
    } else {
        echo "Usuário não encontrado no banco após cadastro!<br>";
    }
} else {
    echo "Erro ao cadastrar usuário!<br>";
}

echo "<h3>5. Listando todos os usuários</h3>";
try {
    $sql = "SELECT id, nome, email FROM usuarios ORDER BY id DESC LIMIT 5";
    $stmt = $usuarioModel->pdo->query($sql);
    $todos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($todos)) {
        echo "Nenhum usuário encontrado!<br>";
    } else {
        echo "Últimos usuários cadastrados:<br>";
        echo "<table border='1' cellpadding='8'>";
        echo "<tr><th>ID</th><th>Nome</th><th>Email</th></tr>";
        foreach ($todos as $u) {
            echo "<tr>";
            echo "<td>" . $u['id'] . "</td>";
            echo "<td>" . $u['nome'] . "</td>";
            echo "<td>" . $u['email'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
} catch (PDOException $e) {
    echo "Erro ao listar usuários: " . $e->getMessage() . "<br>";
}
?>