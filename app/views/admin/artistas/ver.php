<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="admin-header">
    <div>
        <h1><?= htmlspecialchars($artista['nome']) ?></h1>
        <p class="subtitle">Detalhes do artista</p>
    </div>
    <div class="actions">
        <a href="<?= BASE_URL ?>/admin/artistas/editar/<?= $artista['id'] ?>" class="btn btn-secondary">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <a href="<?= BASE_URL ?>/admin/artistas" class="btn btn-cinza">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="admin-card text-center">
            <?php if (!empty($artista['foto'])): ?>
                <img
                    src="<?= BASE_URL ?>/uploads/artistas/<?= htmlspecialchars($artista['foto']) ?>"
                    alt="<?= htmlspecialchars($artista['nome']) ?>"
                    class="detail-cover"
                    style="max-width: 200px; border-radius: 50%;"
                >
            <?php else: ?>
                <div class="bg-secondary p-5 rounded-circle" style="max-width: 200px; margin: 0 auto;">
                    <i class="bi bi-person" style="font-size: 4rem; color: #888;"></i>
                </div>
            <?php endif; ?>
            <h3 class="mt-3"><?= htmlspecialchars($artista['nome']) ?></h3>
            <p class="text-muted">
                <?= $artista['total_albuns'] ?? 0 ?> álbuns •
                <?= $artista['total_musicas'] ?? 0 ?> músicas
            </p>
        </div>
    </div>

    <div class="col-md-8">
        <div class="admin-card">
            <h5 class="card-title">Álbuns</h5>
            <?php if (empty($albuns)): ?>
                <p class="text-muted">Nenhum álbum cadastrado.</p>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($albuns as $album): ?>
                        <div class="col-6 col-md-4 mb-3">
                            <div class="card bg-dark text-light h-100">
                                <img
                                    src="<?= BASE_URL ?>/uploads/capas/<?= htmlspecialchars($album['capa'] ?? 'default-album.png') ?>"
                                    alt="<?= htmlspecialchars($album['titulo']) ?>"
                                    class="card-img-top"
                                    style="aspect-ratio: 1; object-fit: cover;"
                                >
                                <div class="card-body p-2 text-center">
                                    <h6 class="mb-0"><?= htmlspecialchars($album['titulo']) ?></h6>
                                    <small class="text-muted"><?= $album['ano'] ?? '' ?></small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="admin-card mt-3">
            <h5 class="card-title">Músicas</h5>
            <?php if (empty($musicas)): ?>
                <p class="text-muted">Nenhuma música cadastrada.</p>
            <?php else: ?>
                <div class="list-group">
                    <?php foreach ($musicas as $musica): ?>
                        <div class="list-group-item bg-dark text-light d-flex justify-content-between align-items-center">
                            <div>
                                <strong><?= htmlspecialchars($musica['titulo']) ?></strong>
                                <small class="text-muted">• <?= htmlspecialchars($musica['album']) ?></small>
                            </div>
                            <span class="badge bg-secondary">Faixa <?= $musica['numero_faixa'] ?? '-' ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>