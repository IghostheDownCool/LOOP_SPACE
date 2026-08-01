<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<style>
/* ==================================================
   TOP MÚSICAS - ESTILOS
   ================================================== */

.top-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 12px;
}

.top-header h1 {
    margin: 0;
    color: var(--text-primary);
    font-size: 1.8rem;
}

.top-header .subtitle {
    color: var(--text-secondary);
    font-size: 0.95rem;
}

.top-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 12px;
}

.top-item {
    display: flex;
    align-items: center;
    gap: 16px;
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 12px 16px;
    transition: all 0.3s ease;
    cursor: pointer;
    width: 100%;
    box-sizing: border-box;
}

.top-item:hover {
    background: var(--bg-card-hover);
    border-color: #1db954;
    transform: translateX(4px);
}

.top-item .top-position {
    font-size: 1.5rem;
    font-weight: 700;
    min-width: 40px;
    text-align: center;
    color: var(--text-secondary);
    flex-shrink: 0;
}

.top-item .top-position.gold {
    color: #ffd700;
}

.top-item .top-position.silver {
    color: #c0c0c0;
}

.top-item .top-position.bronze {
    color: #cd7f32;
}

.top-item .top-cover {
    width: 56px;
    height: 56px;
    border-radius: 8px;
    object-fit: cover;
    flex-shrink: 0;
    background: var(--bg-secondary);
}

.top-item .top-info {
    flex: 1;
    min-width: 0;
}

.top-item .top-info .titulo {
    color: var(--text-primary);
    font-weight: 600;
    font-size: 1rem;
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.top-item .top-info .artista {
    color: var(--text-secondary);
    font-size: 0.85rem;
    margin: 2px 0 0 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.top-item .top-info .album {
    color: var(--text-muted);
    font-size: 0.75rem;
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.top-item .top-stats {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
}

.top-item .top-stats .reproducoes {
    color: var(--text-muted);
    font-size: 0.8rem;
    font-weight: 500;
    background: var(--bg-secondary);
    padding: 4px 12px;
    border-radius: 20px;
    white-space: nowrap;
}

.top-item .btn-play-small {
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

.top-item .btn-play-small:hover {
    background: #1ed760;
    transform: scale(1.08);
    box-shadow: 0 4px 16px rgba(29, 185, 84, 0.4);
}

.top-item .btn-play-small i {
    margin: 0;
    font-size: 0.9rem;
}

/* Tema claro */
[data-theme="light"] .top-item {
    background: var(--bg-card, #ffffff);
    border-color: var(--border-color, #dddddd);
}

[data-theme="light"] .top-item:hover {
    background: var(--bg-card-hover, #f0f0f0);
}

[data-theme="light"] .top-item .top-info .titulo {
    color: var(--text-primary, #121212);
}

[data-theme="light"] .top-item .top-info .artista {
    color: var(--text-secondary, #666666);
}

[data-theme="light"] .top-item .top-info .album {
    color: var(--text-muted, #999999);
}

[data-theme="light"] .top-item .top-stats .reproducoes {
    background: var(--bg-card-hover, #f0f0f0);
    color: var(--text-secondary, #666666);
}

/* Vazio */
.top-empty {
    text-align: center;
    padding: 60px 20px;
    background: var(--bg-card);
    border-radius: 12px;
    border: 1px solid var(--border-color);
}

.top-empty i {
    font-size: 3rem;
    color: var(--text-muted);
    margin-bottom: 16px;
}

.top-empty h3 {
    color: var(--text-primary);
    margin-bottom: 8px;
}

.top-empty p {
    color: var(--text-muted);
}

/* Responsividade */
@media (max-width: 576px) {
    .top-item {
        padding: 10px 12px;
        gap: 12px;
        flex-wrap: wrap;
    }

    .top-item .top-cover {
        width: 44px;
        height: 44px;
    }

    .top-item .top-info .titulo {
        font-size: 0.85rem;
    }

    .top-item .top-info .artista {
        font-size: 0.75rem;
    }

    .top-item .top-info .album {
        font-size: 0.65rem;
    }

    .top-item .top-position {
        font-size: 1.2rem;
        min-width: 30px;
    }

    .top-item .top-stats .reproducoes {
        font-size: 0.65rem;
        padding: 2px 8px;
    }

    .top-item .btn-play-small {
        width: 32px;
        height: 32px;
        font-size: 0.8rem;
    }

    .top-item .top-stats {
        width: 100%;
        justify-content: flex-end;
        padding-top: 6px;
        border-top: 1px solid var(--border-color);
    }
}
</style>

<div class="top-header">
    <div>
        <h1><i class="bi bi-fire" style="color: #ff6b6b;"></i> Top Músicas</h1>
        <p class="subtitle">As músicas mais ouvidas por todos os usuários</p>
    </div>
</div>

<?php if (empty($musicas)): ?>
    <div class="top-empty">
        <i class="bi bi-fire"></i>
        <h3>Nenhuma música encontrada</h3>
        <p>Comece a ouvir músicas para aparecerem aqui!</p>
    </div>
<?php else: ?>

<div class="top-grid">
    <?php foreach ($musicas as $index => $musica): ?>
        <?php
        // Define a badge de posição
        $posicao = $index + 1;
        $badge = '';
        $badgeClass = '';
        if ($posicao === 1) {
            $badge = '🥇';
            $badgeClass = 'gold';
        } elseif ($posicao === 2) {
            $badge = '🥈';
            $badgeClass = 'silver';
        } elseif ($posicao === 3) {
            $badge = '🥉';
            $badgeClass = 'bronze';
        } else {
            $badge = '#' . $posicao;
            $badgeClass = '';
        }
        ?>
        <div class="top-item" data-musica-id="<?= $musica['id'] ?>">
            <div class="top-position <?= $badgeClass ?>">
                <?= $badge ?>
            </div>

            <img
                src="<?= BASE_URL ?>/uploads/capas/<?= htmlspecialchars($musica['capa'] ?? 'default-cover.png') ?>"
                alt="<?= htmlspecialchars($musica['album']) ?>"
                class="top-cover"
                onerror="this.src='<?= BASE_URL ?>/assets/images/default-cover.png'"
            >

            <div class="top-info">
                <p class="titulo">
    <?= htmlspecialchars($musica['titulo']) ?>
    <span class="tocando-indicador">▶</span>
</p>
                <p class="artista"><?= htmlspecialchars($musica['artista']) ?></p>
                <p class="album"><?= htmlspecialchars($musica['album']) ?></p>
            </div>

            <div class="top-stats">
                <span class="reproducoes">
                    <i class="bi bi-play-circle"></i> <?= number_format($musica['reproducoes'], 0, ',', '.') ?>
                </span>

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
    // Define a fila para o player
    const idsMusicas = <?= json_encode(array_column($musicas, 'id')) ?>;
    definirFila(idsMusicas);
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>