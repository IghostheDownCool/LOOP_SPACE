<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php
$curtidaModel = new Curtida();
?>

<style>
/* ==================================================
   PLAYER - LAYOUT MODERNO CORRIGIDO (COM TEMA CLARO)
   ================================================== */

/* 1. CORREÇÃO DA SCROLLBAR - ESCURA E DISCRETA */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: var(--bg-primary, #0a0a0a);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: var(--border-color, #333333);
    border-radius: 4px;
    transition: background 0.3s;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--text-secondary, #555555);
}

/* Firefox scrollbar */
* {
    scrollbar-width: thin;
    scrollbar-color: var(--border-color, #333333) var(--bg-primary, #0a0a0a);
}

/* 2. CORREÇÃO DE CONTRASTE - TEXTOS MAIS CLAROS */
.menu .nav-link {
    color: var(--text-secondary, #b3b3b3) !important;
}

.menu .nav-link:hover {
    color: var(--text-primary, #ffffff) !important;
}

.menu .nav-link.active {
    color: #ffffff !important;
    background: #1db954 !important;
}

.search-input::placeholder {
    color: var(--text-muted, #888888) !important;
}

/* 3. IDENTIDADE VISUAL - SEPARAÇÃO DE CAMADAS */
.sidebar {
    background: var(--bg-sidebar, #0a0a0a) !important;
    border-right: 1px solid var(--border-color, #1a1a1a) !important;
}

.conteudo {
    background: var(--bg-primary, #121212) !important;
}

/* 4. LAYOUT EXPANDIDO */
.player-page {
    padding-top: 20px;
    width: 100%;
}

.player-wrapper {
    max-width: 100%;
    padding: 0 24px;
    margin: 0;
}

.player-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 12px;
}

.player-header h1 {
    margin: 0;
    color: var(--text-primary, #ffffff);
    font-size: 1.8rem;
}

/* 5. CORREÇÃO DO ALERT (tema claro) */
.alert-secondary {
    background: var(--bg-card, #181818) !important;
    color: var(--text-primary, #ffffff) !important;
    border-color: var(--border-color, #2a2a2a) !important;
}

/* ==================================================
   GRID DE MÚSICAS EXPANDIDO
   ================================================== */

.musicas-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    max-width: 100%;
}

@media (max-width: 992px) {
    .musicas-grid {
        grid-template-columns: 1fr;
    }
}

/* ==================================================
   CARD DE MÚSICA MODERNO
   ================================================== */

.musica-card-modern {
    display: flex;
    align-items: center;
    gap: 16px;
    background: var(--bg-card, #181818);
    border: 1px solid var(--border-color, #2a2a2a);
    border-radius: 12px;
    padding: 14px 18px;
    transition: all 0.3s ease;
    cursor: pointer;
    width: 100%;
    box-sizing: border-box;
}

.musica-card-modern:hover {
    background: var(--bg-card-hover, #282828);
    border-color: #1db954;
    transform: translateX(4px);
}

.musica-card-modern .musica-cover {
    width: 56px;
    height: 56px;
    border-radius: 8px;
    object-fit: cover;
    flex-shrink: 0;
    background: var(--bg-secondary, #1a1a1a);
}

.musica-card-modern .musica-info .titulo {
    color: var(--text-primary, #ffffff);
    font-weight: 600;
    font-size: 1rem;
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.musica-card-modern .musica-info .artista {
    color: var(--text-secondary, #b3b3b3);
    font-size: 0.85rem;
    margin: 2px 0 0 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.musica-card-modern .musica-info .album {
    color: var(--text-muted, #888888);
    font-size: 0.75rem;
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.musica-card-modern .musica-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
    margin-left: auto;
}

.musica-card-modern .btn-play-small {
    width: 44px;
    height: 44px;
    border-radius: 50% !important;
    background: #1db954;
    border: none;
    color: #fff;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.25s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    padding: 0;
    line-height: 1;
    box-shadow: 0 4px 12px rgba(29, 185, 84, 0.3);
}

.musica-card-modern .btn-play-small:hover {
    background: #1ed760;
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(29, 185, 84, 0.4);
}

.musica-card-modern .btn-play-small:active {
    transform: scale(0.95);
}

.musica-card-modern .btn-play-small i {
    margin: 0;
    font-size: 1.1rem;
}

.musica-card-modern .favorito-btn {
    background: transparent;
    border: none;
    font-size: 1.3rem;
    cursor: pointer;
    transition: all 0.2s;
    padding: 4px;
    line-height: 1;
    color: var(--text-secondary, #b3b3b3);
}

.musica-card-modern .favorito-btn:hover {
    transform: scale(1.2);
}

.musica-card-modern .favorito-btn.curtido {
    color: #ff6b6b;
}

/* ==================================================
   COMENTÁRIOS - ESTILOS
   ================================================== */

.comentarios-section {
    margin-top: 40px;
    padding-top: 20px;
    border-top: 1px solid var(--border-color);
}

.comentarios-section h3 {
    color: var(--text-primary);
}

.comentario-item {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    transition: background 0.2s;
    border-radius: 8px;
}

.comentario-item:hover {
    background: var(--bg-card-hover);
}

.comentario-item .text-primary {
    color: var(--link-color) !important;
}

.comentario-item .text-light {
    color: var(--text-primary) !important;
}

/* Tema claro */
[data-theme="light"] .comentario-item {
    background: var(--bg-card, #ffffff);
    border-color: var(--border-color, #dddddd);
}

[data-theme="light"] .comentario-item:hover {
    background: var(--bg-card-hover, #f0f0f0);
}

[data-theme="light"] .comentario-item .text-light {
    color: var(--text-primary, #121212) !important;
}

[data-theme="light"] .comentario-item .text-primary {
    color: #1db954 !important;
}

/* ==================================================
   TEMA CLARO - AJUSTES ESPECÍFICOS
   ================================================== */

[data-theme="light"] .sidebar {
    background: var(--bg-sidebar, #ffffff) !important;
    border-right: 1px solid var(--border-color, #dddddd) !important;
}

[data-theme="light"] .conteudo {
    background: var(--bg-primary, #f5f5f5) !important;
}

[data-theme="light"] .musica-card-modern {
    background: var(--bg-card, #ffffff) !important;
    border-color: var(--border-color, #dddddd) !important;
}

[data-theme="light"] .musica-card-modern:hover {
    background: var(--bg-card-hover, #f0f0f0) !important;
    border-color: #1db954 !important;
}

[data-theme="light"] .musica-card-modern .musica-info .titulo {
    color: var(--text-primary, #121212) !important;
}

[data-theme="light"] .musica-card-modern .musica-info .artista {
    color: var(--text-secondary, #666666) !important;
}

[data-theme="light"] .musica-card-modern .musica-info .album {
    color: var(--text-muted, #999999) !important;
}

[data-theme="light"] .musica-card-modern .favorito-btn {
    color: var(--text-secondary, #666666) !important;
}

[data-theme="light"] .player-header h1 {
    color: var(--text-primary, #121212) !important;
}

[data-theme="light"] .alert-secondary {
    background: var(--bg-card, #ffffff) !important;
    color: var(--text-primary, #121212) !important;
    border-color: var(--border-color, #dddddd) !important;
}

/* Scrollbar para tema claro */
[data-theme="light"] ::-webkit-scrollbar-track {
    background: var(--bg-primary, #f5f5f5) !important;
}

[data-theme="light"] ::-webkit-scrollbar-thumb {
    background: var(--border-color, #dddddd) !important;
}

[data-theme="light"] ::-webkit-scrollbar-thumb:hover {
    background: var(--text-secondary, #999999) !important;
}

[data-theme="light"] * {
    scrollbar-color: var(--border-color, #dddddd) var(--bg-primary, #f5f5f5) !important;
}

/* ==================================================
   RESPONSIVIDADE
   ================================================== */

@media (max-width: 768px) {
    .player-page {
        padding-top: 16px;
    }

    .player-wrapper {
        padding: 0 12px;
    }

    .player-header {
        flex-direction: column;
        align-items: stretch;
    }
    
    .musica-card-modern {
        padding: 10px 12px;
        gap: 12px;
    }
    
    .musica-card-modern .musica-cover {
        width: 44px;
        height: 44px;
    }
    
    .musica-card-modern .musica-info .titulo {
        font-size: 0.85rem;
    }
    
    .musica-card-modern .musica-info .artista {
        font-size: 0.75rem;
    }
    
    .musica-card-modern .btn-play-small {
        width: 34px;
        height: 34px;
        font-size: 0.8rem;
    }
}

@media (max-width: 480px) {
    .player-wrapper {
        padding: 0 8px;
    }

    .musica-card-modern {
        flex-wrap: wrap;
        gap: 10px;
        padding: 10px;
    }
    
    .musica-card-modern .musica-info {
        flex: 1 1 100%;
        order: 2;
    }
    
    .musica-card-modern .musica-cover {
        order: 1;
    }
    
    .musica-card-modern .musica-actions {
        order: 3;
        width: 100%;
        justify-content: flex-end;
        padding-top: 8px;
        border-top: 1px solid var(--border-color, #2a2a2a);
    }
}
</style>

<div class="player-page">
    <div class="player-wrapper">
        <div class="player-header">
            <h1>🎵 Player</h1>
        </div>

        <?php if (empty($musicas)): ?>
            <div class="alert alert-secondary">
                Nenhuma música cadastrada.
            </div>
        <?php else: ?>

        <div class="musicas-grid" id="player-list">
            <?php foreach ($musicas as $musica): ?>
                <div
                    class="musica-card-modern"
                    data-search="<?= strtolower(
                        $musica['titulo'] . ' ' .
                        $musica['artista'] . ' ' .
                        $musica['album']
                    ) ?>"
                >
                    <img
                        src="<?= BASE_URL ?>/uploads/capas/<?= htmlspecialchars($musica['capa'] ?? 'default-cover.png') ?>"
                        alt="<?= htmlspecialchars($musica['album']) ?>"
                        class="musica-cover"
                        onerror="this.src='<?= BASE_URL ?>/assets/images/default-cover.png'"
                    >

                    <div class="musica-info">
                        <p class="titulo"><?= htmlspecialchars($musica['titulo']) ?></p>
                        <p class="artista"><?= htmlspecialchars($musica['artista']) ?></p>
                        <p class="album"><?= htmlspecialchars($musica['album']) ?></p>
                    </div>

                    <div class="musica-actions">
                        <button
                            class="favorito-btn <?= $curtidaModel->usuarioCurtiu($_SESSION['usuario_id'], $musica['id']) ? 'curtido' : '' ?>"
                            onclick="event.stopPropagation(); window.location.href='<?= BASE_URL ?>/curtidas/<?= $curtidaModel->usuarioCurtiu($_SESSION['usuario_id'], $musica['id']) ? 'descurtir' : 'curtir' ?>/<?= $musica['id'] ?>'"
                            title="<?= $curtidaModel->usuarioCurtiu($_SESSION['usuario_id'], $musica['id']) ? 'Descurtir' : 'Curtir' ?>"
                        >
                            <?= $curtidaModel->usuarioCurtiu($_SESSION['usuario_id'], $musica['id']) ? '❤️' : '🤍' ?>
                        </button>

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

        <!-- ==================================================
             SEÇÃO DE COMENTÁRIOS (ABAIXO DA LISTA DE MÚSICAS)
             ================================================== -->
        <div class="comentarios-section mt-5 pt-4">
            <h3 class="mb-3">
                <i class="bi bi-chat-dots" style="color: #1db954;"></i> 
                Comentários
            </h3>

            <?php
            // Busca comentários para a primeira música da lista
            $musicaId = $musicas[0]['id'] ?? 0;
            $comentarioModel = new Comentario();
            $comentarios = $comentarioModel->listarPorMusica($musicaId);
            $totalComentarios = $comentarioModel->contarPorMusica($musicaId);
            ?>

            <p class="text-muted mb-3">
                <?= $totalComentarios ?> comentários
            </p>

            <!-- Formulário para adicionar comentário -->
            <form method="POST" action="<?= BASE_URL ?>/comentarios/adicionar" class="mb-4">
                <input type="hidden" name="musica_id" value="<?= $musicaId ?>">
                <div class="d-flex gap-2">
                    <input
                        type="text"
                        name="comentario"
                        class="form-control bg-dark text-light border-secondary"
                        placeholder="Deixe um comentário sobre a música..."
                        required
                        maxlength="500"
                    >
                    <button type="submit" class="btn btn-verde">
                        <i class="bi bi-send"></i>
                    </button>
                </div>
                <small class="text-muted">Máximo 500 caracteres</small>
            </form>

            <!-- Lista de comentários -->
            <?php if (empty($comentarios)): ?>
                <div class="alert alert-secondary">
                    Nenhum comentário ainda. Seja o primeiro a comentar!
                </div>
            <?php else: ?>
                <div class="comentarios-list">
                    <?php foreach ($comentarios as $comentario): ?>
                        <div class="comentario-item d-flex gap-3 p-3 mb-2">
                            <div class="comentario-avatar flex-shrink-0">
                                <?php if (!empty($comentario['usuario_avatar'])): ?>
                                    <img
                                        src="<?= BASE_URL ?>/uploads/avatars/<?= htmlspecialchars($comentario['usuario_avatar']) ?>"
                                        alt="<?= htmlspecialchars($comentario['usuario_nome']) ?>"
                                        style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;"
                                    >
                                <?php else: ?>
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--bg-secondary); display: flex; align-items: center; justify-content: center; color: var(--text-muted);">
                                        <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="comentario-content flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <strong class="text-primary"><?= htmlspecialchars($comentario['usuario_nome']) ?></strong>
                                        <small class="text-muted ms-2">
                                            <?= date('d/m/Y H:i', strtotime($comentario['criado_em'])) ?>
                                        </small>
                                    </div>
                                    <?php if ($comentario['usuario_id'] == $_SESSION['usuario_id']): ?>
                                        <a
                                            href="<?= BASE_URL ?>/comentarios/excluir/<?= $comentario['id'] ?>"
                                            class="text-danger text-decoration-none"
                                            onclick="return confirm('Deseja excluir este comentário?')"
                                            style="font-size: 0.8rem;"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <p class="mb-0 mt-1 text-light">
                                    <?= nl2br(htmlspecialchars($comentario['comentario'])) ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php endif; ?>
    </div>
</div>

<script>
    // 🔍 Usa a barra de pesquisa principal do header para filtrar
    const searchInput = document.getElementById('search-input');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const termo = this.value.toLowerCase().trim();
            const items = document.querySelectorAll('.musica-card-modern');
            items.forEach(item => {
                const search = item.getAttribute('data-search') || '';
                if (search.includes(termo) || termo === '') {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }

    // Define a fila para o player
    const idsMusicas = <?= json_encode(array_column($musicas, 'id')) ?>;
    definirFila(idsMusicas);
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>