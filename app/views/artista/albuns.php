<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Meus Álbuns</h1>
    <a href="<?= BASE_URL ?>/artista/novo-album" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Novo Álbum
    </a>
</div>

<?php if (empty($albuns)): ?>
    <div class="alert alert-secondary">
        <p class="mb-0">Você ainda não tem álbuns. <a href="<?= BASE_URL ?>/artista/novo-album" class="text-primary">Crie seu primeiro álbum</a></p>
    </div>
<?php else: ?>
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        <?php foreach ($albuns as $album): ?>
            <div class="col">
                <div class="card bg-card h-100">
                    <?php if ($album['capa']): ?>
                        <img src="<?= BASE_URL ?>/uploads/capas/<?= htmlspecialchars($album['capa']) ?>" alt="<?= htmlspecialchars($album['titulo']) ?>" class="card-img-top" style="aspect-ratio: 1; object-fit: cover;">
                    <?php else: ?>
                        <div class="card-img-top d-flex align-items-center justify-content-center" style="aspect-ratio: 1; background: var(--bg-secondary);">
                            <i class="bi bi-collection-play" style="font-size: 3rem; color: var(--text-muted);"></i>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($album['titulo']) ?></h5>
                        <p class="card-text text-muted">
                            <i class="bi bi-calendar"></i> <?= $album['ano'] ?>
                            <br>
                            <i class="bi bi-music-note"></i> <?= $album['total_musicas'] ?? 0 ?> músicas
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>