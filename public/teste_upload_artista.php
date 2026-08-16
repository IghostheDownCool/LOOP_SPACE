<?php
session_start();
require_once '../config/config.php';
require_once '../app/core/Autoload.php';

// Força login como artista (use um ID de artista que existe)
$_SESSION['usuario_id'] = 4; // Coloque o ID do seu artista

echo "<h2>🔍 Teste Upload Foto Artista</h2>";

$usuarioModel = new Usuario();
$artista = $usuarioModel->getArtistaDoUsuario($_SESSION['usuario_id']);

if (!$artista) {
    echo "❌ Usuário não é artista!<br>";
    exit;
}

echo "Artista ID: " . $artista['id'] . "<br>";
echo "Artista Nome: " . $artista['nome'] . "<br>";
echo "Foto atual: " . ($artista['foto'] ?: 'Nenhuma') . "<br><br>";

// Verifica se a pasta existe
$pasta = __DIR__ . '/../public/uploads/artistas/';
echo "Pasta de upload: " . $pasta . "<br>";
echo "Pasta existe? " . (is_dir($pasta) ? '✅ Sim' : '❌ Não') . "<br>";
echo "Pasta tem permissão de escrita? " . (is_writable($pasta) ? '✅ Sim' : '❌ Não') . "<br><br>";

// Verifica se o método atualizar existe
$artistaModel = new Artista();
if (method_exists($artistaModel, 'atualizar')) {
    echo "✅ Método atualizar() existe!<br>";
} else {
    echo "❌ Método atualizar() NÃO existe!<br>";
}

// Lista os arquivos na pasta
echo "<h3>Arquivos na pasta de artistas:</h3>";
$arquivos = scandir($pasta);
foreach ($arquivos as $arquivo) {
    if ($arquivo !== '.' && $arquivo !== '..') {
        echo "📁 " . $arquivo . "<br>";
    }
}
?>