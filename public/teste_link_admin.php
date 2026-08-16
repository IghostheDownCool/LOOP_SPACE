<?php
session_start();
require_once '../config/config.php';
require_once '../app/core/Autoload.php';

// Força o login como admin
$_SESSION['usuario_id'] = 6;
$_SESSION['usuario_nome'] = 'ADM';
$_SESSION['usuario_role'] = 'admin';

echo "<h2>🔍 Teste de Link - Admin</h2>";

echo "Usuário: " . $_SESSION['usuario_nome'] . " (ID: " . $_SESSION['usuario_id'] . ")<br>";
echo "Role: " . $_SESSION['usuario_role'] . "<br><br>";

// Lista artistas
$artistaModel = new Artista();
$artistas = $artistaModel->listar();

echo "<h3>Artistas cadastrados:</h3>";
foreach ($artistas as $artista) {
    echo "ID: " . $artista['id'] . " - Nome: " . $artista['nome'] . "<br>";
}

echo "<br><h3>Testando link para ver artista:</h3>";
echo 'Link: <a href="' . BASE_URL . '/artista/ver/22" target="_blank">' . BASE_URL . '/artista/ver/22</a><br>';

echo "<br><h3>Testando o método ver() diretamente:</h3>";

// Tenta chamar o método ver diretamente com o ID 22
try {
    $controller = new ArtistaController();
    echo "Chamando ArtistaController->ver(22)<br>";
    $controller->ver(22);
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "<br>";
}
?>