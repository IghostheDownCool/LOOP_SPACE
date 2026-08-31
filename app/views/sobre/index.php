<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<style>

.sobre-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px 0;
}

.sobre-header {
    text-align: center;
    margin-bottom: 40px;
}

.sobre-header h1 {
    color: var(--text-primary);
    font-size: 2.5rem;
    margin: 0;
}

.sobre-header .subtitle {
    color: var(--text-secondary);
    font-size: 1.1rem;
    margin: 8px 0 0 0;
}

.sobre-header .version {
    display: inline-block;
    background: var(--bg-card-hover);
    color: var(--text-muted);
    padding: 4px 16px;
    border-radius: 20px;
    font-size: 0.8rem;
    margin-top: 8px;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
    gap: 16px;
    margin-bottom: 40px;
}

.stat-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 20px 16px;
    text-align: center;
    transition: all 0.3s ease;
}

.stat-card:hover {
    border-color: #1db954;
    transform: translateY(-4px);
    box-shadow: 0 8px 24px var(--shadow-color);
}

.stat-card .stat-icon {
    font-size: 1.8rem;
    color: #1db954;
    margin-bottom: 4px;
}

.stat-card .stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1.2;
}

.stat-card .stat-label {
    font-size: 0.8rem;
    color: var(--text-muted);
}

.sobre-info {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 24px;
}

.sobre-info h2 {
    color: var(--text-primary);
    font-size: 1.3rem;
    margin: 0 0 16px 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.sobre-info h2 i {
    color: #1db954;
}

.sobre-info p {
    color: var(--text-secondary);
    line-height: 1.7;
    margin: 0 0 12px 0;
}

.sobre-info ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
}

.sobre-info ul li {
    color: var(--text-secondary);
    padding: 6px 0;
    display: flex;
    align-items: center;
    gap: 10px;
    border-bottom: 1px solid var(--border-color-light);
}

.sobre-info ul li i {
    color: #1db954;
    font-size: 1rem;
    width: 20px;
}

[data-theme="light"] .stat-card {
    background: var(--bg-card, #ffffff);
    border-color: var(--border-color, #dddddd);
}

[data-theme="light"] .stat-card .stat-number {
    color: var(--text-primary, #121212);
}

[data-theme="light"] .sobre-info {
    background: var(--bg-card, #ffffff);
    border-color: var(--border-color, #dddddd);
}

[data-theme="light"] .sobre-info ul li {
    border-bottom-color: #eeeeee;
}

@media (max-width: 576px) {
    .sobre-header h1 {
        font-size: 1.8rem;
    }

    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .stat-card .stat-number {
        font-size: 1.5rem;
    }

    .sobre-info ul {
        grid-template-columns: 1fr;
    }

    .sobre-info {
        padding: 20px;
    }
}
</style>

<div class="sobre-container">
    <div class="sobre-header">
        <h1>SONORA</h1>
        <p class="subtitle">...</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-music-note"></i></div>
            <div class="stat-number"><?= number_format($totalMusicas, 0, ',', '.') ?></div>
            <div class="stat-label">Músicas</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-person"></i></div>
            <div class="stat-number"><?= number_format($totalArtistas, 0, ',', '.') ?></div>
            <div class="stat-label">Artistas</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-collection"></i></div>
            <div class="stat-number"><?= number_format($totalAlbuns, 0, ',', '.') ?></div>
            <div class="stat-label">Álbuns</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-collection-play"></i></div>
            <div class="stat-number"><?= number_format($totalPlaylists, 0, ',', '.') ?></div>
            <div class="stat-label">Playlists</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-people"></i></div>
            <div class="stat-number"><?= number_format($totalUsuarios, 0, ',', '.') ?></div>
            <div class="stat-label">Usuários</div>
        </div>
    </div>

    <div class="sobre-info">
        <h2><i class="bi bi-info-circle"></i> Sobre o Projeto</h2>
        <p>
            <strong>...</strong> 
        </p>
    </div>

    

    <div class="sobre-info">
        <h2><i class="bi bi-heart-fill" style="color: #ff6b6b;"></i> Créditos</h2>
        <p>
            <strong>Desenvolvido por:</strong> ...<br>
            <strong>Projeto:</strong> ...<br>
            <strong>Inspirado em:</strong> ...
        </p>
        <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 12px;">
             Última atualização: <?= date('d/m/Y') ?>
        </p>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>