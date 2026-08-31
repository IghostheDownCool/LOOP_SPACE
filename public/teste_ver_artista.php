<?php
session_start();
require_once '../config/config.php';
require_once '../app/core/Autoload.php';

echo "<h2>Teste Direto - Ver Artista</h2>";

$_SESSION['usuario_id'] = 6;
$_SESSION['usuario_nome'] = 'ADM';
$_SESSION['usuario_role'] = 'admin';

echo "Usuário forçado: " . $_SESSION['usuario_nome'] . " (ID: " . $_SESSION['usuario_id'] . ")<br>";
echo "Role: " . $_SESSION['usuario_role'] . "<br><br>";


$artistaController = new ArtistaController();

$artistaId = 17; 

echo "Tentando ver artista ID: " . $artistaId . "<br><br>";

try {
    echo "Chamando ArtistaController->ver($artistaId)<br>";
    $artistaController->ver($artistaId);
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage() . "<br>";
}
?>