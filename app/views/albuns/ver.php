<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
    <h1><?= htmlspecialchars($album['titulo']) ?></h1>
    <p class="text-muted">
        <?= htmlspecialchars($album['artista']) ?> • <?= $album['ano'] ?? 'Ano desconhecido' ?>
    </p>
</div>

<div class="row">
    <div class="col-md-3">
        <img
            src="<?= BASE_URL ?>/uploads/capas/<?= htmlspecialchars($album['capa'] ?? 'default-album.png') ?>"
            alt="<?= htmlspecialchars($album['titulo']) ?>"
            class="img-fluid rounded"
        >
    </div>
    <div class="col-md-9">
        <h2>Músicas</h2>
        <?php if (empty($musicas)): ?>
            <p class="text-muted">Nenhuma música encontrada neste álbum.</p>
        <?php else: ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php foreach ($musicas as $musica): ?>
                    <div class="col">
                        <div class="card bg-card h-100">
                            <?php 
                            $filaMusicas = $filaMusicas;
                            require __DIR__ . '/../components/music-card.php'; 
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>