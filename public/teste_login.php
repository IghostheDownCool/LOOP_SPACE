<?php
require_once '../config/config.php';
require_once '../app/core/Autoload.php';

$email = 'admin@loopspace.com'; // ← Coloque o email que você usou
$senha = '123456'; // ← Coloque a senha que você usou

$usuarioModel = new Usuario();
$usuario = $usuarioModel->buscarPorEmail($email);

echo "<pre>";
echo "Email buscado: " . $email . "\n\n";

if ($usuario) {
    echo "✅ USUÁRIO ENCONTRADO!\n";
    echo "ID: " . $usuario['id'] . "\n";
    echo "Nome: " . $usuario['nome'] . "\n";
    echo "Email: " . $usuario['email'] . "\n";
    echo "Senha hash: " . $usuario['senha'] . "\n";
    echo "Tamanho do hash: " . strlen($usuario['senha']) . " caracteres\n\n";
    
    if (password_verify($senha, $usuario['senha'])) {
        echo "✅ SENHA CORRETA! Password_verify passou.\n";
    } else {
        echo "❌ SENHA INCORRETA! Password_verify falhou.\n";
        echo "Tentando comparar: '" . $senha . "' com hash '" . $usuario['senha'] . "'\n";
    }
} else {
    echo "❌ USUÁRIO NÃO ENCONTRADO! Verifique se o email existe no banco.\n";
}
echo "</pre>";
?>