<?php
session_start();
require_once '../config/config.php';
require_once '../app/core/Autoload.php';

// Força login como Celeste
$_SESSION['usuario_id'] = 14;

echo "<h2>🔍 Teste Upload Foto Artista</h2>";

// Busca o artista
$usuarioModel = new Usuario();
$artista = $usuarioModel->getArtistaDoUsuario(14);

if (!$artista) {
    echo "❌ Artista não encontrado!<br>";
    exit;
}

echo "Artista ID: " . $artista['id'] . "<br>";
echo "Artista Nome: " . $artista['nome'] . "<br>";
echo "Foto atual: " . ($artista['foto'] ?? 'Nenhuma') . "<br><br>";

// Pasta de upload
$pasta = __DIR__ . '/../public/uploads/artistas/';
echo "Pasta: " . $pasta . "<br>";
echo "Existe? " . (is_dir($pasta) ? '✅ Sim' : '❌ Não') . "<br>";
echo "Permissão de escrita? " . (is_writable($pasta) ? '✅ Sim' : '❌ Não') . "<br><br>";

// Lista arquivos na pasta
echo "<h3>Arquivos na pasta:</h3>";
if (is_dir($pasta)) {
    $arquivos = scandir($pasta);
    foreach ($arquivos as $arquivo) {
        if ($arquivo !== '.' && $arquivo !== '..') {
            echo "📁 " . $arquivo . "<br>";
        }
    }
} else {
    echo "❌ Pasta não existe!<br>";
}

// Tenta criar um arquivo de teste
$testeFile = $pasta . 'teste.txt';
if (file_put_contents($testeFile, 'teste')) {
    echo "<br>✅ Conseguiu escrever na pasta!<br>";
    unlink($testeFile);
} else {
    echo "<br>❌ NÃO conseguiu escrever na pasta!<br>";
}

// Verifica se o método uploadAvatar existe
$uploadHelper = new UploadHelper();
if (method_exists($uploadHelper, 'uploadAvatar')) {
    echo "<br>✅ Método uploadAvatar() existe!<br>";
} else {
    echo "<br>❌ Método uploadAvatar() NÃO existe!<br>";
}
?>