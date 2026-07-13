<?php require_once __DIR__ . '/layouts/header.php'; ?>

<h1>Loop Space</h1>

<?php if (isset($_SESSION['usuario_nome'])): ?>

    <p>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</p>

<?php endif; ?>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>