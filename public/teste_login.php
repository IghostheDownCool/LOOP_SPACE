<?php
session_start();
require_once '../config/config.php';
require_once '../app/core/Autoload.php';

$email = 'admin@loopspace.com';
$senha = '123456'; 

echo "<h2>Diagnóstico de Login</h2>";

$usuarioModel = new Usuario();

echo "<h3>1. Testando buscarPorEmailLogin()</h3>";
$usuario = $usuarioModel->buscarPorEmailLogin($email);

if ($usuario) {
    echo "Usuário encontrado!<br>";
    echo "<pre>";
    print_r($usuario);
    echo "</pre>";
    
    echo "<h3>2. Testando password_verify()</h3>";
    echo "Senha digitada: '" . $senha . "'<br>";
    echo "Hash no banco: '" . $usuario['senha'] . "'<br>";
    echo "Tamanho do hash: " . strlen($usuario['senha']) . " caracteres<br>";
    
    if (password_verify($senha, $usuario['senha'])) {
        echo "SENHA CORRETA!<br>";
    } else {
        echo "SENHA INCORRETA!<br>";
        
        echo "<h3>3. Verificando se o hash é válido</h3>";
        $info = password_get_info($usuario['senha']);
        echo "Algoritmo: " . $info['algoName'] . "<br>";
        echo "É válido? " . ($info['algo'] ? 'Sim' : 'Não') . "<br>";
    }
} else {
    echo "Usuário NÃO encontrado com o email: " . $email . "<br>";
}

echo "<h3>4. Verificando método buscarPorEmailLogin</h3>";
if (method_exists($usuarioModel, 'buscarPorEmailLogin')) {
    echo "Método buscarPorEmailLogin existe!<br>";
} else {
    echo "Método buscarPorEmailLogin NÃO existe!<br>";
}

echo "<h3>5. Listando todos os usuários cadastrados</h3>";
try {
    $sql = "SELECT id, nome, email, artista_id FROM usuarios";
    $stmt = $usuarioModel->pdo->query($sql);
    $todos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($todos)) {
        echo "Nenhum usuário encontrado no banco!<br>";
    } else {
        echo "(V)" . count($todos) . " usuários encontrados:<br>";
        echo "<table border='1' cellpadding='8'>";
        echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Artista ID</th></tr>";
        foreach ($todos as $u) {
            echo "<tr>";
            echo "<td>" . $u['id'] . "</td>";
            echo "<td>" . $u['nome'] . "</td>";
            echo "<td>" . $u['email'] . "</td>";
            echo "<td>" . ($u['artista_id'] ?? 'NULL') . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
} catch (PDOException $e) {
    echo "Erro ao listar usuários: " . $e->getMessage();
}
?>