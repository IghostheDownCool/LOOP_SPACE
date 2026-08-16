<?php
session_start();
require_once '../config/config.php';
require_once '../app/core/Autoload.php';

// Força login como Celeste
$_SESSION['usuario_id'] = 14;

echo "<h2>🔍 Teste Upload Simples</h2>";

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

// Verifica se a foto existe no banco (usando Database diretamente)
echo "<h3>Verificando no banco:</h3>";
$db = Database::connect();
$sql = "SELECT id, nome, foto FROM artistas WHERE id = " . $artista['id'];
$stmt = $db->query($sql);
$dados = $stmt->fetch(PDO::FETCH_ASSOC);
echo "Foto no banco: " . ($dados['foto'] ?? 'NULL') . "<br>";

// Verifica se o arquivo existe na pasta
if (!empty($dados['foto'])) {
    $caminho = __DIR__ . '/../public/uploads/artistas/' . $dados['foto'];
    echo "Caminho do arquivo: " . $caminho . "<br>";
    echo "Arquivo existe? " . (file_exists($caminho) ? '✅ Sim' : '❌ Não') . "<br>";
    
    if (file_exists($caminho)) {
        echo "Tamanho: " . filesize($caminho) . " bytes<br>";
        echo "URL: " . BASE_URL . "/uploads/artistas/" . $dados['foto'] . "<br>";
        echo '<img src="' . BASE_URL . '/uploads/artistas/' . $dados['foto'] . '" style="max-width: 200px; border-radius: 50%;">';
    }
} else {
    echo "❌ Nenhuma foto salva no banco!<br>";
}

// Verifica o caminho completo da view
echo "<br><br><h3>Como a view está tentando mostrar:</h3>";
echo "src=\"" . BASE_URL . "/uploads/artistas/" . ($artista['foto'] ?? 'default-artist.png') . "\"<br>";

// Verifica se a pasta existe e tem arquivos
echo "<br><h3>Arquivos na pasta uploads/artistas/:</h3>";
$pasta = __DIR__ . '/../public/uploads/artistas/';
if (is_dir($pasta)) {
    $arquivos = scandir($pasta);
    foreach ($arquivos as $arquivo) {
        if ($arquivo !== '.' && $arquivo !== '..') {
            echo "📁 " . $arquivo . "<br>";
        }
    }
}
?>