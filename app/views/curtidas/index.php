<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h2 class="mb-4">
    ❤️ Músicas Curtidas
</h2>

<?php if (empty($musicas)): ?>

    <div class="alert alert-secondary">
        Você ainda não curtiu nenhuma música.
    </div>

<?php else: ?>

    <div class="list-group">

        <?php foreach ($musicas as $musica): ?>
            <?php require __DIR__ . '/../components/music-card.php'; ?>
        <?php endforeach; ?>

    </div>

<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>