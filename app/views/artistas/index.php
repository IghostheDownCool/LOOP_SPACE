<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<style>
/* ==================================================
   LISTA DE ARTISTAS
   ================================================== */

.artistas-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 12px;
}

.artistas-header h1 {
    margin: 0;
    color: var(--text-primary);
    font-size: 1.8rem;
}

.artistas-header .subtitle {
    color: var(--text-secondary);
    font-size: 0.95rem;
    margin: 4px 0 0 0;
}

.artistas-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 20px;
}

.artista-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    text-align: center;
    padding: 20px 16px 16px;
    text-decoration: none;
    color: var(--text-primary);
    cursor: pointer;
}

.artista-card:hover {
    border-color: #1db954;
    transform: translateY(-4px);
    box-shadow: 0 8px 24px var(--shadow-color);
}

.artista-card .artist-avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    margin: 0 auto 12px;
    border: 3px solid var(--border-color);
    transition: border-color 0.3s;
    display: block;
}

.artista-card:hover .artist-avatar {
    border-color: #1db954;
}

.artista-card .artist-avatar-placeholder {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: var(--bg-secondary);
    border: 3px solid var(--border-color);
    margin: 0 auto 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: var(--text-muted);
    transition: border-color 0.3s;
}

.artista-card:hover .artist-avatar-placeholder {
    border-color: #1db954;
}

.artista-card .artist-name {
    color: var(--text-primary);
    font-weight: 600;
    font-size: 1rem;
    margin: 0 0 4px 0;
}

.artista-card .artist-albuns {
    color: var(--text-muted);
    font-size: 0.8rem;
    margin: 0;
}

/* Tema claro */
[data-theme="light"] .artista-card {
    background: var(--bg-card, #ffffff);
    border-color: var(--border-color, #dddddd);
}

[data-theme="light"] .artista-card .artist-name {
    color: var(--text-primary, #121212);
}

[data-theme="light"] .artista-card .artist-albuns {
    color: var(--text-muted, #999999);
}

/* Responsividade */
@media (max-width: 576px) {
    .artistas-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .artista-card {
        padding: 16px 12px 12px;
    }

    .artista-card .artist-avatar {
        width: 70px;
        height: 70px;
    }

    .artista-card .artist-avatar-placeholder {
        width: 70px;
        height: 70px;
        font-size: 2rem;
    }

    .artista-card .artist-name {
        font-size: 0.85rem;
    }
}
</style>

<div class="artistas-header">
    <div>
        <h1><i class="bi bi-person" style="color: #1db954;"></i> Artistas</h1>
        <p class="subtitle">Todos os artistas disponíveis</p>
    </div>
</div>

<?php if (empty($artistas)): ?>
    <div class="alert alert-secondary">
        Nenhum artista cadastrado ainda.
    </div>
<?php else: ?>

<div class="artistas-grid">
    <?php foreach ($artistas as $artista): ?>
        <a href="<?= BASE_URL ?>/artista/ver/<?= $artista['id'] ?>" class="artista-card">
            <?php if (!empty($artista['foto'])): ?>
                <img
                    src="<?= BASE_URL ?>/uploads/artistas/<?= htmlspecialchars($artista['foto']) ?>"
                    alt="<?= htmlspecialchars($artista['nome']) ?>"
                    class="artist-avatar"
                    onerror="this.src='<?= BASE_URL ?>/assets/images/default-artist.png'"
                >
            <?php else: ?>
                <div class="artist-avatar-placeholder">
                    <i class="bi bi-person-fill"></i>
                </div>
            <?php endif; ?>

            <p class="artist-name"><?= htmlspecialchars($artista['nome']) ?></p>
            <p class="artist-albuns">
                <i class="bi bi-collection"></i> <?= $artista['total_albuns'] ?? 0 ?> álbuns
            </p>
        </a>
    <?php endforeach; ?>
</div>

<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>