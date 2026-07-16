<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
    <h1>
        <i class="bi bi-fire" style="color: #ff6b6b;"></i>
        Top Músicas
    </h1>
    <p class="text-muted">
        As músicas mais ouvidas por todos os usuários
    </p>
</div>

<?php if (empty($musicas)): ?>
    <div class="alert alert-secondary">
        Nenhuma música encontrada.
    </div>
<?php else: ?>
    <div class="row">
        <?php foreach ($musicas as $musica): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <?php require __DIR__ . '/../components/music-card.php'; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

<script>
    const idsMusicas = <?= json_encode(array_column($musicas, 'id')) ?>;
    definirFila(idsMusicas);
</script>