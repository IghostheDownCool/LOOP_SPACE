<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
    <h1>Seguidores</h1>
    <p class="text-muted">Pessoas que seguem seu perfil de artista.</p>
</div>

<?php if (empty($seguidores)): ?>
    <div class="alert alert-secondary">
        <p class="mb-0">Nenhum seguidor ainda. Continue criando músicas incríveis!</p>
    </div>
<?php else: ?>
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        <?php foreach ($seguidores as $seguidor): ?>
            <div class="col">
                <div class="card bg-card text-center p-3">
                    <div class="user-avatar mx-auto mb-2">
                        <?php if (!empty($seguidor['avatar'])): ?>
                            <img src="<?= BASE_URL ?>/uploads/avatars/<?= htmlspecialchars($seguidor['avatar']) ?>" alt="<?= htmlspecialchars($seguidor['nome']) ?>" class="rounded-circle" style="width: 64px; height: 64px; object-fit: cover;">
                        <?php else: ?>
                            <div class="avatar-placeholder rounded-circle d-flex align-items-center justify-content-center" style="width: 64px; height: 64px; background: var(--bg-secondary);">
                                <i class="bi bi-person-fill" style="font-size: 2rem; color: var(--text-muted);"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <h6 class="mb-0"><?= htmlspecialchars($seguidor['nome']) ?></h6>
                    <small class="text-muted"><?= htmlspecialchars($seguidor['email']) ?></small>
                    <small class="text-muted">Segue desde <?= date('d/m/Y', strtotime($seguidor['data_cadastro'])) ?></small>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>