<?php
session_start();
require_once '../config/config.php';
require_once '../app/core/Autoload.php';

echo "<h2>🔍 Teste de POST para Login</h2>";

// Verifica se é uma requisição POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<h3>✅ Requisição POST recebida!</h3>";
    echo "<pre>";
    echo "Dados recebidos:\n";
    print_r($_POST);
    echo "</pre>";
    
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    
    echo "<h3>Dados processados:</h3>";
    echo "Email: '" . $email . "'<br>";
    echo "Senha: '" . $senha . "'<br>";
    echo "Tamanho da senha: " . strlen($senha) . " caracteres<br>";
    
    $usuarioModel = new Usuario();
    $usuario = $usuarioModel->buscarPorEmailLogin($email);
    
    if ($usuario) {
        echo "<h3>✅ Usuário encontrado!</h3>";
        echo "ID: " . $usuario['id'] . "<br>";
        echo "Nome: " . $usuario['nome'] . "<br>";
        
        if (password_verify($senha, $usuario['senha'])) {
            echo "<h3 style='color: green;'>✅ SENHA CORRETA! Login funcionaria!</h3>";
            
            // Simula o login
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email'] = $usuario['email'];
            
            echo "<p>✅ Sessão criada! <a href='" . BASE_URL . "'>Ir para a home</a></p>";
        } else {
            echo "<h3 style='color: red;'>❌ SENHA INCORRETA!</h3>";
        }
    } else {
        echo "<h3 style='color: red;'>❌ Usuário NÃO encontrado!</h3>";
    }
} else {
    echo "<h3>📝 Envie um POST para este arquivo</h3>";
    ?>
    <form method="POST" action="">
        <div>
            <label>Email:</label><br>
            <input type="email" name="email" value="admin@loopspace.com" style="width: 300px; padding: 8px;">
        </div>
        <div style="margin-top: 10px;">
            <label>Senha:</label><br>
            <input type="password" name="senha" value="123456" style="width: 300px; padding: 8px;">
        </div>
        <button type="submit" style="margin-top: 10px; padding: 10px 30px;">Testar Login</button>
    </form>
    <?php
}
?>