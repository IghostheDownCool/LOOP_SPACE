<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<style>

.seguindo-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 12px;
}

.seguindo-header h1 {
    margin: 0;
    color: var(--text-primary);
    font-size: 1.8rem;
}

.seguindo-header .subtitle {
    color: var(--text-secondary);
    font-size: 0.95rem;
    margin: 4px 0 0 0;
}

.seguindo-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 20px;
}

.seguindo-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    text-align: center;
    padding: 20px 16px 16px;
}

.seguindo-card:hover {
    border-color: #1db954;
    transform: translateY(-4px);
    box-shadow: 0 8px 24px var(--shadow-color);
}

.seguindo-card .artist-avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    margin: 0 auto 12px;
    border: 3px solid var(--border-color);
    transition: border-color 0.3s;
    display: block;
}

.seguindo-card:hover .artist-avatar {
    border-color: #1db954;
}

.seguindo-card .artist-avatar-placeholder {
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

.seguindo-card:hover .artist-avatar-placeholder {
    border-color: #1db954;
}

.seguindo-card .artist-name {
    color: var(--text-primary);
    font-weight: 600;
    font-size: 1rem;
    margin: 0 0 4px 0;
}

.seguindo-card .artist-followers {
    color: var(--text-muted);
    font-size: 0.8rem;
    margin: 0 0 12px 0;
}

.seguindo-card .btn-unfollow {
    background: transparent;
    color: var(--text-secondary);
    border: 1px solid var(--border-color);
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.8rem;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-block;
}

.seguindo-card .btn-unfollow:hover {
    background: #dc3545;
    color: #fff;
    border-color: #dc3545;
}

.seguindo-empty {
    text-align: center;
    padding: 60px 20px;
    background: var(--bg-card);
    border-radius: 12px;
    border: 1px solid var(--border-color);
    grid-column: 1 / -1;
}

.seguindo-empty i {
    font-size: 3rem;
    color: var(--text-muted);
    margin-bottom: 16px;
}

.seguindo-empty h3 {
    color: var(--text-primary);
    margin-bottom: 8px;
}

.seguindo-empty p {
    color: var(--text-muted);
    margin-bottom: 20px;
}

.seguindo-empty .btn-descobrir {
    background: #1db954;
    color: #fff;
    border: none;
    padding: 10px 24px;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    transition: all 0.2s;
}

.seguindo-empty .btn-descobrir:hover {
    background: #1ed760;
    transform: scale(1.02);
}

[data-theme="light"] .seguindo-card {
    background: var(--bg-card, #ffffff);
    border-color: var(--border-color, #dddddd);
}

[data-theme="light"] .seguindo-card .artist-name {
    color: var(--text-primary, #121212);
}

[data-theme="light"] .seguindo-card .artist-followers {
    color: var(--text-muted, #999999);
}

[data-theme="light"] .seguindo-empty {
    background: var(--bg-card, #ffffff);
    border-color: var(--border-color, #dddddd);
}

@media (max-width: 576px) {
    .seguindo-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .seguindo-card {
        padding: 16px 12px 12px;
    }

    .seguindo-card .artist-avatar {
        width: 70px;
        height: 70px;
    }

    .seguindo-card .artist-avatar-placeholder {
        width: 70px;
        height: 70px;
        font-size: 2rem;
    }

    .seguindo-card .artist-name {
        font-size: 0.85rem;
    }

    .seguindo-card .btn-unfollow {
        font-size: 0.7rem;
        padding: 4px 12px;
    }
}
</style>

<div class="seguindo-header">
    <div>
        <h1><i class="bi bi-people" style="color: #1db954;"></i> Artistas Seguidos</h1>
        <p class="subtitle">Todos os artistas que você está acompanhando</p>
    </div>
</div>

<?php if (empty($seguidos)): ?>
    <div class="seguindo-empty">
        <i class="bi bi-person-plus"></i>
        <h3>Você ainda não segue nenhum artista</h3>
        <p>Descubra novos artistas e comece a segui-los!</p>
        <a href="<?= BASE_URL ?>/player" class="btn-descobrir" style="display: inline-flex; align-items: center; gap: 8px; background: #1db954; color: #fff; border: none; padding: 10px 24px; border-radius: 50px; font-weight: 600; text-decoration: none; transition: all 0.2s; font-size: 0.95rem;">
    <i class="bi bi-music-note" style="font-size: 1rem;"></i>
    Descobrir artistas
</a>
    </div>
<?php else: ?>

<div class="seguindo-grid">
    <?php foreach ($seguidos as $artista): ?>
        <div class="seguindo-card">
            <a href="<?= BASE_URL ?>/artista/ver/<?= $artista['id'] ?>">
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
            </a>

            <a href="<?= BASE_URL ?>/artista/ver/<?= $artista['id'] ?>" style="text-decoration: none;">
                <p class="artist-name"><?= htmlspecialchars($artista['nome']) ?></p>
            </a>

            <p class="artist-followers">
                <i class="bi bi-person"></i> <?= $artista['total_seguidores'] ?? 0 ?> seguidores
            </p>

            <a
                href="<?= BASE_URL ?>/artista/deixarSeguir/<?= $artista['id'] ?>"
                class="btn-unfollow"
                onclick="return confirm('Deseja deixar de seguir <?= htmlspecialchars($artista['nome']) ?>?')"
            >
                <i class="bi bi-person-dash"></i> Deixar de seguir
            </a>
        </div>
    <?php endforeach; ?>
</div>

<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>