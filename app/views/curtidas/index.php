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

            <a
                href="<?= BASE_URL ?>/player"
                class="list-group-item list-group-item-action"
            >

                <h5 class="mb-1">

                    <?= htmlspecialchars($musica['titulo']) ?>

                </h5>

                <small>

                    <?= htmlspecialchars($musica['artista']) ?>

                    •

                    <?= htmlspecialchars($musica['album']) ?>

                </small>

            </a>

        <?php endforeach; ?>

    </div>

<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>