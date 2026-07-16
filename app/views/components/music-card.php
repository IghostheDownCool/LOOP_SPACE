<div class="music-card">

<div class="music-play">

    <button
        class="btn-play-card"
        onclick="event.stopPropagation(); tocarMusica(
            this,
            <?= $musica['id'] ?>,
            '<?= BASE_URL ?>/uploads/musicas/<?= htmlspecialchars($musica['arquivo'], ENT_QUOTES) ?>',
            '<?= htmlspecialchars($musica['titulo'], ENT_QUOTES) ?>',
            '<?= htmlspecialchars($musica['artista'], ENT_QUOTES) ?>',
            '<?= htmlspecialchars($musica['album'], ENT_QUOTES) ?>',
            '<?= BASE_URL ?>/uploads/capas/<?= htmlspecialchars($musica['capa'], ENT_QUOTES) ?>'
        )"
    >
        <i class="bi bi-play-fill"></i>
    </button>

</div>

    <div class="music-cover">

        <img
            src="<?= BASE_URL ?>/uploads/capas/<?= htmlspecialchars($musica['capa']) ?>"
            alt="<?= htmlspecialchars($musica['album']) ?>"
        >

    </div>

    <div class="music-info">

        <h6>

            <?= htmlspecialchars($musica['titulo']) ?>

        </h6>

        <small>

            <?= htmlspecialchars($musica['artista']) ?>

            •

            <?= htmlspecialchars($musica['album']) ?>

        </small>

    </div>

</div>