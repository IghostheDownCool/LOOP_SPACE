<?php
session_start();
require_once '../config/config.php';
require_once '../app/core/Autoload.php';

echo "<h2>Diagnóstico da Sessão</h2>";

if (!isset($_SESSION['usuario_id'])) {
    echo "Nenhum usuário logado!<br>";
    echo "<a href='" . BASE_URL . "/login'>Faça login</a>";
    exit;
}

echo "Usuário logado!<br><br>";

echo "<h3>Dados da Sessão:</h3>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

$usuarioModel = new Usuario();
$usuario = $usuarioModel->buscarPorId($_SESSION['usuario_id']);

if ($usuario) {
    echo "<h3>Dados do Usuário no Banco:</h3>";
    echo "<pre>";
    print_r($usuario);
    echo "</pre>";
    
    echo "<h3>Role do usuário: <strong>" . ($usuario['role'] ?? 'user') . "</strong></h3>";
    
    if (($usuario['role'] ?? 'user') === 'admin') {
        echo "<h3 style='color: red;'>USUÁRIO É ADMIN!</h3>";
    } else {
        echo "<h3 style='color: blue;'>USUÁRIO É COMUM</h3>";
    }
} else {
    echo "Usuário não encontrado no banco!";
}

echo "<h3>Verificando atributo no HTML:</h3>";
echo "O atributo deve estar na tag <html>: data-user-role=\"" . ($_SESSION['usuario_role'] ?? 'user') . "\"<br>";
echo "Valor atual na sessão: '" . ($_SESSION['usuario_role'] ?? 'user') . "'<br>";
?>

