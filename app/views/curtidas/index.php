<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<style>
/* ==================================================
   CURTIDAS - LAYOUT DE LISTA
   ================================================== */

/* Container da lista */
.curtidas-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

/* Card de música no estilo lista (horizontal) */
.curtida-item {
    display: flex;
    align-items: center;
    gap: 16px;
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 10px 16px;
    transition: all 0.3s ease;
    cursor: pointer;
    width: 100%;
    box-sizing: border-box;
}

.curtida-item:hover {
    background: var(--bg-card-hover);
    border-color: #1db954;
    transform: translateX(4px);
}

/* Capa pequena (horizontal) */
.curtida-item .curtida-cover {
    width: 56px;
    height: 56px;
    border-radius: 8px;
    object-fit: cover;
    flex-shrink: 0;
    background: var(--bg-secondary);
}

/* Informações da música */
.curtida-item .curtida-info {
    flex: 1;
    min-width: 0;
}

.curtida-item .curtida-info .titulo {
    color: var(--text-primary);
    font-weight: 600;
    font-size: 1rem;
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.curtida-item .curtida-info .artista {
    color: var(--text-secondary);
    font-size: 0.85rem;
    margin: 2px 0 0 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.curtida-item .curtida-info .album {
    color: var(--text-muted);
    font-size: 0.75rem;
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Ações (botões) */
.curtida-item .curtida-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
    margin-left: auto;
}

/* Botão de play pequeno */
.curtida-item .btn-play-small {
    width: 36px;
    height: 36px;
    border-radius: 50% !important;
    background: #1db954;
    border: none;
    color: #fff;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.25s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    padding: 0;
    line-height: 1;
    box-shadow: 0 2px 8px rgba(29, 185, 84, 0.3);
}

.curtida-item .btn-play-small:hover {
    background: #1ed760;
    transform: scale(1.08);
    box-shadow: 0 4px 16px rgba(29, 185, 84, 0.4);
}

.curtida-item .btn-play-small i {
    margin: 0;
    font-size: 0.9rem;
}

/* Botão de descurtir */
.curtida-item .descurtir-btn {
    background: transparent;
    border: none;
    font-size: 1.2rem;
    cursor: pointer;
    transition: all 0.2s;
    padding: 4px;
    line-height: 1;
    color: #ff6b6b;
}

.curtida-item .descurtir-btn:hover {
    transform: scale(1.2);
}

/* Tema claro */
[data-theme="light"] .curtida-item {
    background: var(--bg-card, #ffffff);
    border-color: var(--border-color, #dddddd);
}

[data-theme="light"] .curtida-item:hover {
    background: var(--bg-card-hover, #f0f0f0);
}

[data-theme="light"] .curtida-item .curtida-info .titulo {
    color: var(--text-primary, #121212);
}

[data-theme="light"] .curtida-item .curtida-info .artista {
    color: var(--text-secondary, #666666);
}

[data-theme="light"] .curtida-item .curtida-info .album {
    color: var(--text-muted, #999999);
}

/* Responsividade */
@media (max-width: 576px) {
    .curtida-item {
        padding: 8px 12px;
        gap: 12px;
        flex-wrap: wrap;
    }

    .curtida-item .curtida-cover {
        width: 44px;
        height: 44px;
    }

    .curtida-item .curtida-info .titulo {
        font-size: 0.85rem;
    }

    .curtida-item .curtida-info .artista {
        font-size: 0.75rem;
    }

    .curtida-item .curtida-info .album {
        font-size: 0.65rem;
    }

    .curtida-item .btn-play-small {
        width: 32px;
        height: 32px;
        font-size: 0.8rem;
    }

    .curtida-item .curtida-actions {
        width: 100%;
        justify-content: flex-end;
        padding-top: 6px;
        border-top: 1px solid var(--border-color);
    }
}
</style>

<div class="page-header">
    <h2 class="mb-4">
        ❤️ Músicas Curtidas
    </h2>
</div>

<?php if (empty($musicas)): ?>
    <div class="alert alert-secondary">
        Você ainda não curtiu nenhuma música.
    </div>
<?php else: ?>

<div class="curtidas-list">
    <?php foreach ($musicas as $musica): ?>
        <div class="curtida-item">
            <img
                src="<?= BASE_URL ?>/uploads/capas/<?= htmlspecialchars($musica['capa'] ?? 'default-cover.png') ?>"
                alt="<?= htmlspecialchars($musica['album']) ?>"
                class="curtida-cover"
                onerror="this.src='<?= BASE_URL ?>/assets/images/default-cover.png'"
            >

            <div class="curtida-info">
                <p class="titulo"><?= htmlspecialchars($musica['titulo']) ?></p>
                <p class="artista"><?= htmlspecialchars($musica['artista']) ?></p>
                <p class="album"><?= htmlspecialchars($musica['album']) ?></p>
            </div>

            <div class="curtida-actions">
                <a
                    href="<?= BASE_URL ?>/curtidas/descurtir/<?= $musica['id'] ?>"
                    class="descurtir-btn"
                    title="Remover dos curtidos"
                    onclick="event.stopPropagation();"
                >
                    ❤️
                </a>

                <button
                    class="btn-play-small"
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
        </div>
    <?php endforeach; ?>
</div>

<?php endif; ?>

<script>
    const idsMusicas = <?= json_encode(array_column($musicas, 'id')) ?>;
    definirFila(idsMusicas);
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>