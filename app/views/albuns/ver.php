<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="row">
    <div class="col-md-3 text-center">
        <img
            src="<?= BASE_URL ?>/uploads/capas/<?= htmlspecialchars($album['capa'] ?? 'default-album.png') ?>"
            alt="<?= htmlspecialchars($album['titulo']) ?>"
            class="img-fluid"
            style="max-width: 200px;"
        >
        <h1 class="mt-3"><?= htmlspecialchars($album['titulo']) ?></h1>
        <p>
            <a href="<?= BASE_URL ?>/artista/ver/<?= $album['artista_id'] ?>">
                <?= htmlspecialchars($album['artista'] ?? 'Artista desconhecido') ?>
            </a>
            •
            <?= $album['ano'] ?? '' ?>
        </p>
    </div>

    <div class="col-md-9">
        <h2>Músicas</h2>
        <?php if (!empty($musicas)): ?>
            <div class="list-group">
                <?php foreach ($musicas as $musica): ?>
                    <?php require __DIR__ . '/../components/music-card.php'; ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-muted">Nenhuma música encontrada.</p>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>