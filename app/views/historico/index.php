<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h2 class="mb-4">
    🕒 Recentemente reproduzidas
</h2>

<?php if (empty($musicas)): ?>

    <div class="alert alert-secondary">
        Você ainda não reproduziu nenhuma música.
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

                <br>

                <small class="text-secondary">

                    Ouvida em:

                    <?= date(
                        'd/m/Y H:i',
                        strtotime($musica['data_reproducao'])
                    ) ?>

                </small>

            </a>

        <?php endforeach; ?>

    </div>

<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>