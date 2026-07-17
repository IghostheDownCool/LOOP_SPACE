<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="row">
    <div class="col-md-3 text-center">
        <img
            src="<?= BASE_URL ?>/uploads/capas/<?= htmlspecialchars($album['capa'] ?? 'default-album.png') ?>"
            alt="<?= htmlspecialchars($album['titulo']) ?>"
            class="img-fluid"
            style="max-width: 200px; border-radius: 8px;"
        >
        <h1 class="mt-3"><?= htmlspecialchars($album['titulo']) ?></h1>
        <p>
            <a href="<?= BASE_URL ?>/artista/ver/<?= $album['artista_id'] ?>" class="text-light">
                <?= htmlspecialchars($album['artista'] ?? 'Artista desconhecido') ?>
            </a>
            <?php if (!empty($album['ano'])): ?>
                • <?= $album['ano'] ?>
            <?php endif; ?>
        </p>
    </div>

    <div class="col-md-9">
        <h2>Músicas</h2>
        <?php if (empty($musicas)): ?>
            <p class="text-muted">Nenhuma música encontrada.</p>
        <?php else: ?>
            <div class="list-group">
                <?php foreach ($musicas as $musica): ?>
                    <?php require __DIR__ . '/../components/music-card.php'; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>