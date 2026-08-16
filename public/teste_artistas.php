<?php
session_start();
require_once '../config/config.php';
require_once '../app/core/Autoload.php';

echo "<h2>📋 Lista de Artistas</h2>";

$artistaModel = new Artista();
$artistas = $artistaModel->listar();

if (empty($artistas)) {
    echo "❌ Nenhum artista cadastrado!<br>";
    echo "Crie um artista primeiro no admin ou faça um cadastro como artista.";
} else {
    echo "✅ " . count($artistas) . " artistas encontrados:<br><br>";
    echo "<table border='1' cellpadding='8'>";
    echo "<tr><th>ID</th><th>Nome</th><th>Foto</th></tr>";
    foreach ($artistas as $artista) {
        echo "<tr>";
        echo "<td>" . $artista['id'] . "</td>";
        echo "<td>" . $artista['nome'] . "</td>";
        echo "<td>" . ($artista['foto'] ? '✅' : '❌ Sem foto') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<br><br>👉 Use um dos IDs acima para testar o perfil do artista.";
}
?>