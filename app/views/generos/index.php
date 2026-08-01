<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<style>
.generos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 16px;
    margin-top: 20px;
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
}

.genero-card .genero-nome {
    font-weight: 600;
    font-size: 1.1rem;
}
</style>

<div class="page-header">
    <h1><i class="bi bi-tags" style="color: #1db954;"></i> Gêneros</h1>
    <p class="text-muted">Explore músicas por gênero</p>
</div>

<?php if (empty($generos)): ?>
    <div class="alert alert-secondary">
        Nenhum gênero cadastrado ainda.
    </div>
<?php else: ?>

<div class="generos-grid">
    <?php foreach ($generos as $genero): ?>
        <a href="<?= BASE_URL ?>/genero/<?= urlencode($genero) ?>" class="genero-card">
            <div class="genero-icon"><i class="bi bi-music-note-beamed"></i></div>
            <div class="genero-nome"><?= htmlspecialchars($genero) ?></div>
        </a>
    <?php endforeach; ?>
</div>

<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>