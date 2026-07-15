<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1>Player de Música</h1>

<?php if (empty($musicas)): ?>

    <p>Nenhuma música cadastrada.</p>

<?php else: ?>

<div class="player-container">

    <div class="player-playlist">

        <h3>Músicas</h3>

        <input
            type="text"
            id="busca"
            placeholder="🔍 Buscar música..."
        >

        <ul>

            <?php foreach ($musicas as $musica): ?>

                <li>

                    <button
                        class="musica-item"
                        data-search="<?= strtolower(
                            $musica['titulo'] . ' ' .
                            $musica['artista'] . ' ' .
                            $musica['album']
                        ) ?>"
                        onclick="tocarMusica(
                            this,
                            <?= $musica['id'] ?>,
                            '<?= BASE_URL ?>/uploads/musicas/<?= htmlspecialchars($musica['arquivo'], ENT_QUOTES) ?>',
                            '<?= htmlspecialchars($musica['titulo'], ENT_QUOTES) ?>',
                            '<?= htmlspecialchars($musica['artista'], ENT_QUOTES) ?>',
                            '<?= htmlspecialchars($musica['album'], ENT_QUOTES) ?>',
                            '<?= BASE_URL ?>/uploads/capas/<?= htmlspecialchars($musica['capa'], ENT_QUOTES) ?>'
                        )"
                    >

                        <div class="musica-topo">

    <strong>
        ▶ <?= htmlspecialchars($musica['titulo']) ?>
    </strong>

    <span class="favorito">
        🤍
    </span>

</div>

<span>
    <?= htmlspecialchars($musica['artista']) ?>
</span>

                    </button>

                </li>

            <?php endforeach; ?>

        </ul>

    </div>

</div>

<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>