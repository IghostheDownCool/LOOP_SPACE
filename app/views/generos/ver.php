<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
    <h1><i class="bi bi-tag" style="color: #1db954;"></i> <?= htmlspecialchars($genero) ?></h1>
    <p class="text-muted"><?= count($musicas) ?> músicas neste gênero</p>
</div>

<?php if (empty($musicas)): ?>
    <div class="alert alert-secondary">
        Nenhuma música encontrada neste gênero.
    </div>
<?php else: ?>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($musicas as $musica): ?>
            <div class="col">
                <?php require __DIR__ . '/../components/music-card.php'; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>