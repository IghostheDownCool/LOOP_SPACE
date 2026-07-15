<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1><?= htmlspecialchars($playlist['nome']) ?></h1>

<p>

<strong>Pública:</strong>

<?= $playlist['publica'] ? 'Sim' : 'Não' ?>

</p>

<hr>

<h2>Músicas</h2>

<?php if (empty($musicas)): ?>

    <p>Esta playlist ainda não possui músicas.</p>

<?php else: ?>

<ul>

<?php foreach ($musicas as $musica): ?>

    <li>

        <?= htmlspecialchars($musica['titulo']) ?>

        -

        <?= htmlspecialchars($musica['artista']) ?>

    </li>

<?php endforeach; ?>

</ul>

<?php endif; ?>

<p>

<a href="<?= BASE_URL ?>/playlists">

Voltar

</a>

</p>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>