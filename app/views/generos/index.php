<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<style>

.generos-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 12px;
}

.generos-header h1 {
    margin: 0;
    color: var(--text-primary);
    font-size: 1.8rem;
}

.generos-header .subtitle {
    color: var(--text-secondary);
    font-size: 0.95rem;
    margin: 4px 0 0 0;
}

.generos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 16px;
}

.genero-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 24px 16px;
    text-align: center;
    text-decoration: none;
    color: var(--text-primary);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 120px;
}

.genero-card:hover {
    border-color: #1db954;
    transform: translateY(-4px);
    box-shadow: 0 8px 24px var(--shadow-color);
}

.genero-card .genero-icon {
    font-size: 2.5rem;
    color: #1db954;
    margin-bottom: 8px;
    line-height: 1;
}

.genero-card .genero-nome {
    font-weight: 600;
    font-size: 1rem;
    margin: 0;
}

.genero-card .genero-count {
    font-size: 0.75rem;
    color: var(--text-muted);
    margin: 4px 0 0 0;
}

.generos-empty {
    text-align: center;
    padding: 60px 20px;
    background: var(--bg-card);
    border-radius: 12px;
    border: 1px solid var(--border-color);
    grid-column: 1 / -1;
}

.generos-empty i {
    font-size: 3rem;
    color: var(--text-muted);
    margin-bottom: 16px;
}

.generos-empty h3 {
    color: var(--text-primary);
    margin-bottom: 8px;
}

.generos-empty p {
    color: var(--text-muted);
}

[data-theme="light"] .genero-card {
    background: var(--bg-card, #ffffff);
    border-color: var(--border-color, #dddddd);
}

[data-theme="light"] .genero-card .genero-nome {
    color: var(--text-primary, #121212);
}

[data-theme="light"] .generos-empty {
    background: var(--bg-card, #ffffff);
    border-color: var(--border-color, #dddddd);
}

@media (max-width: 576px) {
    .generos-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .genero-card {
        padding: 16px 12px;
        min-height: 100px;
    }

    .genero-card .genero-icon {
        font-size: 2rem;
    }

    .genero-card .genero-nome {
        font-size: 0.85rem;
    }
}
</style>

<div class="generos-header">
    <div>
        <h1><i class="bi bi-tags" style="color: #1db954;"></i> Gêneros</h1>
        <p class="subtitle">Explore músicas por gênero musical</p>
    </div>
</div>

<div class="generos-grid">
    <?php if (empty($generos)): ?>
        <div class="generos-empty">
            <i class="bi bi-tags"></i>
            <h3>Nenhum gênero cadastrado</h3>
            <p>Adicione gêneros às músicas na área administrativa.</p>
        </div>
    <?php else: ?>
        <?php foreach ($generos as $genero): ?>
            <a href="<?= BASE_URL ?>/genero/<?= urlencode($genero) ?>" class="genero-card">
                <div class="genero-icon"><i class="bi bi-music-note-beamed"></i></div>
                <div class="genero-nome"><?= htmlspecialchars($genero) ?></div>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>