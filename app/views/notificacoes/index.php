<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
    <h1><i class="bi bi-bell"></i> Notificações</h1>
    <p class="text-muted">Todas as suas notificações</p>
</div>

<?php if (empty($notificacoes)): ?>
    <div class="alert alert-secondary">
        <i class="bi bi-check-circle"></i> Você não tem notificações.
    </div>
<?php else: ?>
    <div class="list-group">
        <?php foreach ($notificacoes as $notificacao): ?>
            <div class="list-group-item bg-dark text-light <?= $notificacao['lida'] ? 'opacity-50' : 'border-start border-success border-4' ?>">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1"><?= htmlspecialchars($notificacao['mensagem']) ?></p>
                        <small class="text-muted">
                            <?= date('d/m/Y H:i', strtotime($notificacao['criado_em'])) ?>
                        </small>
                    </div>
                    <?php if ($notificacao['link']): ?>
                        <a href="<?= BASE_URL . $notificacao['link'] ?>" class="btn btn-sm btn-verde">
                            Ver
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>