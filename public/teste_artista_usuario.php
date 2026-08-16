<?php
session_start();
require_once '../config/config.php';
require_once '../app/core/Autoload.php';

// 🔥 USE O ID DO ARTISTA (22)
$_SESSION['usuario_id'] = 14; 

echo "<h2>🔍 Diagnóstico - Artista do Usuário</h2>";

echo "Usuário ID: " . $_SESSION['usuario_id'] . "<br><br>";

$usuarioModel = new Usuario();

// Busca o usuário
$usuario = $usuarioModel->buscarPorId($_SESSION['usuario_id']);
echo "<h3>Dados do Usuário:</h3>";
echo "<pre>";
print_r($usuario);
echo "</pre>";

// Verifica se o usuário tem artista_id
if (!empty($usuario['artista_id'])) {
    echo "✅ Usuário tem artista_id: " . $usuario['artista_id'] . "<br>";
    
    // Busca o artista
    $artistaModel = new Artista();
    $artista = $artistaModel->buscarPorId($usuario['artista_id']);
    
    if ($artista) {
        echo "✅ Artista encontrado!<br>";
        echo "<pre>";
        print_r($artista);
        echo "</pre>";
    } else {
        echo "❌ Artista NÃO encontrado com ID: " . $usuario['artista_id'] . "<br>";
    }
} else {
    echo "❌ Usuário NÃO tem artista_id!<br>";
}
?>