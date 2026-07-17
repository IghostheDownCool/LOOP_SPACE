<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<style>
/* ==================================================
   PLAYLISTS - LAYOUT MODERNO
   ================================================== */

.playlists-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 12px;
}

.playlists-header h1 {
    margin: 0;
    color: var(--text-primary);
    font-size: 1.8rem;
}

.playlists-header .btn-criar {
    background: #1db954;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.playlists-header .btn-criar:hover {
    background: #1ed760;
    transform: scale(1.02);
    color: #fff;
}

/* Grid de playlists */
.playlists-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
}

/* Card de playlist */
.playlist-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 16px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    position: relative;
}

.playlist-card:hover {
    background: var(--bg-card-hover);
    border-color: #1db954;
    transform: translateY(-4px);
    box-shadow: 0 8px 24px var(--shadow-color);
}

.playlist-card .playlist-icon {
    font-size: 3rem;
    color: #1db954;
    margin-bottom: 12px;
    background: var(--bg-secondary);
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
}

.playlist-card .playlist-nome {
    color: var(--text-primary);
    font-weight: 600;
    font-size: 1rem;
    margin: 0 0 4px 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 100%;
}

.playlist-card .playlist-info {
    color: var(--text-muted);
    font-size: 0.75rem;
    margin: 0;
}

.playlist-card .playlist-badge {
    display: inline-block;
    padding: 2px 10px;
    border-radius: 12px;
    font-size: 0.65rem;
    font-weight: 600;
    margin-top: 8px;
}

.playlist-card .playlist-badge.publica {
    background: rgba(29, 185, 84, 0.15);
    color: #1db954;
}

.playlist-card .playlist-badge.privada {
    background: rgba(255, 255, 255, 0.08);
    color: var(--text-muted);
}

.playlist-card .playlist-actions {
    display: flex;
    gap: 6px;
    margin-top: 12px;
    width: 100%;
    justify-content: center;
}

.playlist-card .playlist-actions .btn {
    padding: 4px 12px;
    font-size: 0.75rem;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
}

.playlist-card .playlist-actions .btn-ver {
    background: #1db954;
    color: #fff;
}

.playlist-card .playlist-actions .btn-ver:hover {
    background: #1ed760;
}

.playlist-card .playlist-actions .btn-editar {
    background: var(--bg-card-hover);
    color: var(--text-primary);
}

.playlist-card .playlist-actions .btn-editar:hover {
    background: var(--border-color);
}

.playlist-card .playlist-actions .btn-excluir {
    background: rgba(220, 53, 69, 0.15);
    color: #dc3545;
}

.playlist-card .playlist-actions .btn-excluir:hover {
    background: rgba(220, 53, 69, 0.25);
}

/* Tema claro */
[data-theme="light"] .playlist-card {
    background: var(--bg-card, #ffffff);
    border-color: var(--border-color, #dddddd);
}

[data-theme="light"] .playlist-card:hover {
    background: var(--bg-card-hover, #f0f0f0);
}

[data-theme="light"] .playlist-card .playlist-nome {
    color: var(--text-primary, #121212);
}

[data-theme="light"] .playlist-card .playlist-info {
    color: var(--text-muted, #999999);
}

[data-theme="light"] .playlist-card .playlist-badge.privada {
    background: rgba(0, 0, 0, 0.05);
    color: #666;
}

/* Vazio */
.playlists-empty {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
    background: var(--bg-card);
    border-radius: 12px;
    border: 1px solid var(--border-color);
}

.playlists-empty i {
    font-size: 3rem;
    color: var(--text-muted);
    margin-bottom: 16px;
}

.playlists-empty h3 {
    color: var(--text-primary);
    margin-bottom: 8px;
}

.playlists-empty p {
    color: var(--text-muted);
    margin-bottom: 20px;
}

/* Responsividade */
@media (max-width: 576px) {
    .playlists-grid {
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .playlist-card .playlist-icon {
        width: 60px;
        height: 60px;
        font-size: 2rem;
    }

    .playlist-card .playlist-nome {
        font-size: 0.85rem;
    }

    .playlists-header h1 {
        font-size: 1.4rem;
    }

    .playlists-header .btn-criar {
        padding: 8px 16px;
        font-size: 0.8rem;
    }
}

@media (max-width: 400px) {
    .playlists-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="playlists-header">
    <h1>📂 Minhas Playlists</h1>
    <a href="<?= BASE_URL ?>/playlists/cadastrar" class="btn-criar">
        <i class="bi bi-plus-circle"></i> Nova Playlist
    </a>
</div>

<?php if (empty($playlists)): ?>
    <div class="playlists-grid">
        <div class="playlists-empty">
            <i class="bi bi-collection-play"></i>
            <h3>Nenhuma playlist criada</h3>
            <p>Crie sua primeira playlist e organize suas músicas favoritas!</p>
            <a href="<?= BASE_URL ?>/playlists/cadastrar" class="btn-criar" style="display:inline-flex;">
                <i class="bi bi-plus-circle"></i> Criar Playlist
            </a>
        </div>
    </div>
<?php else: ?>

<div class="playlists-grid">
    <?php foreach ($playlists as $playlist): ?>
        <div class="playlist-card">
            <div class="playlist-icon">
                <i class="bi bi-collection-play-fill"></i>
            </div>

            <h4 class="playlist-nome" title="<?= htmlspecialchars($playlist['nome']) ?>">
                <?= htmlspecialchars($playlist['nome']) ?>
            </h4>

            <p class="playlist-info">
                <?= $playlist['publica'] ? '🌍 Pública' : '🔒 Privada' ?>
            </p>

            <span class="playlist-badge <?= $playlist['publica'] ? 'publica' : 'privada' ?>">
                <?= $playlist['publica'] ? 'Pública' : 'Privada' ?>
            </span>

            <div class="playlist-actions">
                <a href="<?= BASE_URL ?>/playlists/ver/<?= $playlist['id'] ?>" class="btn btn-ver">
                    <i class="bi bi-eye"></i> Ver
                </a>
                <a href="<?= BASE_URL ?>/playlists/editar/<?= $playlist['id'] ?>" class="btn btn-editar">
                    <i class="bi bi-pencil"></i>
                </a>
                <a
                    href="<?= BASE_URL ?>/playlists/excluir/<?= $playlist['id'] ?>"
                    class="btn btn-excluir"
                    onclick="return confirm('Deseja realmente excluir esta playlist?')"
                >
                    <i class="bi bi-trash"></i>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>