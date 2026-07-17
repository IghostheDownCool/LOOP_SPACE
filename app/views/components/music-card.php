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
        <h6><?= htmlspecialchars($musica['titulo']) ?></h6>
        <small>
            <a href="<?= BASE_URL ?>/artista/ver/<?= $musica['artista_id'] ?? 0 ?>" class="music-link">
                <?= htmlspecialchars($musica['artista']) ?>
            </a>
            •
            <a href="<?= BASE_URL ?>/album/ver/<?= $musica['album_id'] ?? 0 ?>" class="music-link">
                <?= htmlspecialchars($musica['album']) ?>
            </a>
        </small>
    </div>

    <!-- Botão para abrir o modal de adicionar à playlist -->
    <div class="music-actions">
        <button
            class="btn btn-sm btn-outline-light btn-add-playlist"
            data-musica-id="<?= $musica['id'] ?>"
            data-musica-titulo="<?= htmlspecialchars($musica['titulo'], ENT_QUOTES) ?>"
            data-bs-toggle="modal"
            data-bs-target="#modalPlaylists"
            onclick="event.stopPropagation();"
        >
            <i class="bi bi-plus-circle"></i>
        </button>
    </div>

</div>

<!-- MODAL - Lista de Playlists -->
<div class="modal fade" id="modalPlaylists" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-card text-light">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-collection-play-fill"></i>
                    Adicionar à playlist
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="playlist-list">
                <p class="text-muted">Carregando playlists...</p>
            </div>
        </div>
    </div>
</div>