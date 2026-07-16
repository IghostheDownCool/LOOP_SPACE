<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
    <h1>Bem-vindo de volta!</h1>
    <p class="text-muted">Aqui estão algumas sugestões para você.</p>
</div>

<!-- Seção de Recomendações -->
<?php if (!empty($recomendacoes)): ?>
    <h2 class="mt-4 mb-3">
        <i class="bi bi-stars" style="color: #1db954;"></i>
        Recomendadas para você
    </h2>
    <div class="row align-items-stretch">
        <?php foreach ($recomendacoes as $musica): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <?php require __DIR__ . '/../components/music-card.php'; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="alert alert-secondary">
        Você ainda não tem histórico suficiente para recomendações. Comece a ouvir algumas músicas!
    </div>
<?php endif; ?>

<!-- Seção de Top Músicas -->
<?php if (!empty($topMusicas)): ?>
    <h2 class="mt-5 mb-3">
        <i class="bi bi-fire" style="color: #ff6b6b;"></i>
        Mais ouvidas do momento
    </h2>
    <div class="row align-items-stretch">
        <?php foreach ($topMusicas as $musica): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <?php require __DIR__ . '/../components/music-card.php'; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>