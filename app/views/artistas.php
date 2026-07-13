<?php require_once __DIR__ . '/layouts/header.php'; ?>

<h1>Artistas</h1>

<?php if (empty($artistas)): ?>

    <p>Nenhum artista cadastrado.</p>

<?php else: ?>

    <ul>

        <?php foreach ($artistas as $artista): ?>

            <li>

                <?= htmlspecialchars($artista['nome']) ?>

            </li>

        <?php endforeach; ?>

    </ul>

<?php endif; ?>

<p>

    <a href="/LOOP_SPACE/public/">

        Voltar para Home

    </a>

</p>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>