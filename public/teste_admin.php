<?php
session_start();
require_once '../config/config.php';
require_once '../app/core/Autoload.php';

echo "<h2>🔍 Diagnóstico do Admin</h2>";

if (!isset($_SESSION['usuario_id'])) {
    echo "❌ Nenhum usuário logado!<br>";
    echo "<a href='" . BASE_URL . "/login'>Faça login</a>";
    exit;
}

echo "✅ Usuário logado: " . $_SESSION['usuario_nome'] . " (ID: " . $_SESSION['usuario_id'] . ")<br>";
echo "Role: " . ($_SESSION['usuario_role'] ?? 'user') . "<br><br>";

// Verifica se é admin
$usuarioModel = new Usuario();
$isAdmin = $usuarioModel->isAdmin($_SESSION['usuario_id']);

echo "É admin? " . ($isAdmin ? '✅ SIM' : '❌ NÃO') . "<br><br>";

// Testa o método ver do ArtistaController
echo "<h3>Testando ArtistaController::ver()</h3>";

$artistaController = new ArtistaController();

// Tenta chamar o método ver com um ID válido (ex: 17)
$artistaId = 17; // Coloque um ID de artista que existe
echo "Tentando ver artista ID: " . $artistaId . "<br>";

// Simula a chamada
try {
    // Não vamos executar o método diretamente porque ele faz redirect
    // Vamos apenas verificar se o método existe
    if (method_exists($artistaController, 'ver')) {
        echo "✅ Método ver() existe!<br>";
    } else {
        echo "❌ Método ver() NÃO existe!<br>";
    }
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "<br>";
}

// Verifica o arquivo da view
$viewFile = __DIR__ . '/../app/views/artistas/ver.php';
if (file_exists($viewFile)) {
    echo "✅ View existe: " . $viewFile . "<br>";
} else {
    echo "❌ View NÃO existe: " . $viewFile . "<br>";
}
?>