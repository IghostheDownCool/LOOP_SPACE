<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<style>
/* ==================================================
   DASHBOARD ADMIN - ESTILOS
   ================================================== */

.admin-dashboard {
    max-width: 1200px;
    margin: 0 auto;
}

.admin-dashboard .admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    flex-wrap: wrap;
    gap: 12px;
}

.admin-dashboard .admin-header h1 {
    color: var(--text-primary);
    font-size: 1.8rem;
    margin: 0;
}

.admin-dashboard .admin-header .subtitle {
    color: var(--text-secondary);
    font-size: 0.95rem;
    margin: 4px 0 0 0;
}

.admin-dashboard .admin-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.admin-dashboard .admin-actions .btn-admin {
    background: var(--bg-card);
    color: var(--text-primary);
    border: 1px solid var(--border-color);
    padding: 8px 16px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.admin-dashboard .admin-actions .btn-admin:hover {
    background: var(--bg-card-hover);
    border-color: #8B5CF6;
    transform: translateY(-2px);
}

.admin-dashboard .admin-actions .btn-admin.primary {
    background: #8B5CF6;
    color: #121212;
    border-color: #8B5CF6;
}

.admin-dashboard .admin-actions .btn-admin.primary:hover {
    background: #A78BFA;
    border-color: #A78BFA;
}

/* ==================================================
   TEMA ADMIN - DASHBOARD
================================================== */
[data-user-role="admin"] .admin-dashboard .admin-actions .btn-admin.primary {
    background: #DC3545;
    color: #ffffff;
    border-color: #DC3545;
}

[data-user-role="admin"] .admin-dashboard .admin-actions .btn-admin.primary:hover {
    background: #FF4757;
    border-color: #FF4757;
}

[data-user-role="admin"] .admin-dashboard .stat-card:hover {
    border-color: #DC3545;
}

[data-user-role="admin"] .admin-dashboard .stat-card .stat-icon {
    color: #DC3545;
}

[data-user-role="admin"] .admin-dashboard .quick-action:hover {
    border-color: #DC3545;
}

[data-user-role="admin"] .admin-dashboard .quick-action .qa-icon {
    color: #DC3545;
}

[data-user-role="admin"] .admin-dashboard .admin-header h1 i {
    color: #DC3545 !important;
}

/* Cards de estatísticas */
.admin-dashboard .stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 16px;
    margin-bottom: 30px;
}

.admin-dashboard .stat-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 16px;
    text-align: center;
    transition: all 0.2s;
}

.admin-dashboard .stat-card:hover {
    border-color: #8B5CF6;
    transform: translateY(-2px);
}

.admin-dashboard .stat-card .stat-icon {
    font-size: 1.5rem;
    color: #8B5CF6;
    margin-bottom: 4px;
}

.admin-dashboard .stat-card .stat-number {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1.2;
}

.admin-dashboard .stat-card .stat-label {
    font-size: 0.75rem;
    color: var(--text-muted);
}

/* Seções de ação rápida */
.admin-dashboard .quick-actions {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 16px;
    margin-bottom: 30px;
}

.admin-dashboard .quick-action {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 20px 16px;
    text-decoration: none;
    color: var(--text-primary);
    transition: all 0.2s;
    text-align: center;
    cursor: pointer;
}

.admin-dashboard .quick-action:hover {
    border-color: #8B5CF6;
    transform: translateY(-4px);
    box-shadow: 0 8px 24px var(--shadow-color);
}

.admin-dashboard .quick-action .qa-icon {
    font-size: 2rem;
    color: #8B5CF6;
    margin-bottom: 8px;
}

.admin-dashboard .quick-action .qa-title {
    font-weight: 600;
    font-size: 1rem;
    margin: 0;
}

.admin-dashboard .quick-action .qa-desc {
    font-size: 0.8rem;
    color: var(--text-muted);
    margin: 4px 0 0 0;
}

.admin-dashboard .quick-action .qa-badge {
    display: inline-block;
    background: var(--bg-secondary);
    color: var(--text-muted);
    padding: 2px 10px;
    border-radius: 12px;
    font-size: 0.7rem;
    margin-top: 8px;
}

/* Tema claro */
[data-theme="light"] .admin-dashboard .stat-card {
    background: var(--bg-card, #ffffff);
    border-color: var(--border-color, #dddddd);
}

[data-theme="light"] .admin-dashboard .quick-action {
    background: var(--bg-card, #ffffff);
    border-color: var(--border-color, #dddddd);
}

[data-theme="light"] .admin-dashboard .admin-actions .btn-admin {
    background: var(--bg-card, #ffffff);
    border-color: var(--border-color, #dddddd);
    color: var(--text-primary, #121212);
}

[data-theme="light"] .admin-dashboard .admin-actions .btn-admin.primary {
    background: #7C3AED;
    color: #ffffff;
    border-color: #7C3AED;
}

[data-theme="light"] .admin-dashboard .admin-actions .btn-admin.primary:hover {
    background: #8B5CF6;
    color: #121212;
    border-color: #8B5CF6;
}

/* Admin + Tema Claro */
[data-user-role="admin"][data-theme="light"] .admin-dashboard .admin-actions .btn-admin.primary {
    background: #DC3545;
    color: #ffffff;
    border-color: #DC3545;
}

[data-user-role="admin"][data-theme="light"] .admin-dashboard .admin-actions .btn-admin.primary:hover {
    background: #FF4757;
    color: #ffffff;
    border-color: #FF4757;
}

[data-user-role="admin"][data-theme="light"] .admin-dashboard .stat-card .stat-icon {
    color: #DC3545;
}

[data-user-role="admin"][data-theme="light"] .admin-dashboard .quick-action .qa-icon {
    color: #DC3545;
}

/* Responsividade */
@media (max-width: 576px) {
    .admin-dashboard .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .admin-dashboard .quick-actions {
        grid-template-columns: 1fr 1fr;
    }

    .admin-dashboard .admin-header {
        flex-direction: column;
        align-items: stretch;
    }

    .admin-dashboard .admin-actions {
        justify-content: center;
    }
}
</style>

<div class="admin-dashboard">
    <div class="admin-header">
        <div>
            <h1><i class="bi bi-speedometer2" style="color: #8B5CF6;"></i> Dashboard</h1>
            <p class="subtitle">Gerencie todo o conteúdo do Sonora</p>
        </div>
        <div class="admin-actions">
            <a href="<?= BASE_URL ?>/admin/artistas" class="btn-admin primary">
                <i class="bi bi-person"></i> Gerenciar Artistas
            </a>
            <a href="<?= BASE_URL ?>/admin/albuns" class="btn-admin primary">
                <i class="bi bi-collection"></i> Gerenciar Álbuns
            </a>
            <a href="<?= BASE_URL ?>/admin/musicas" class="btn-admin primary">
                <i class="bi bi-music-note"></i> Gerenciar Músicas
            </a>
            <a href="<?= BASE_URL ?>/admin/usuarios" class="btn-admin primary">
                <i class="bi bi-people"></i> Gerenciar Usuários
            </a>
        </div>
    </div>

    <!-- Cards de Estatísticas -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-music-note"></i></div>
            <div class="stat-number"><?= $totalMusicas ?? 0 ?></div>
            <div class="stat-label">Músicas</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-person"></i></div>
            <div class="stat-number"><?= $totalArtistas ?? 0 ?></div>
            <div class="stat-label">Artistas</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-collection"></i></div>
            <div class="stat-number"><?= $totalAlbuns ?? 0 ?></div>
            <div class="stat-label">Álbuns</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-collection-play"></i></div>
            <div class="stat-number"><?= $totalPlaylists ?? 0 ?></div>
            <div class="stat-label">Playlists</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-heart-fill" style="color: #ff6b6b;"></i></div>
            <div class="stat-number"><?= $totalCurtidas ?? 0 ?></div>
            <div class="stat-label">Curtidas</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="bi bi-people"></i></div>
            <div class="stat-number"><?= $totalUsuarios ?? 0 ?></div>
            <div class="stat-label">Usuários</div>
        </div>
    </div>

    <!-- Ações Rápidas -->
    <h3 style="color: var(--text-primary); margin-bottom: 16px;">
        <i class="bi bi-lightning-fill" style="color: #ffd700;"></i> Ações Rápidas
    </h3>
    <div class="quick-actions">
        <a href="<?= BASE_URL ?>/admin/artistas" class="quick-action">
            <div class="qa-icon"><i class="bi bi-person"></i></div>
            <p class="qa-title">Artistas</p>
            <p class="qa-desc">Visualizar e excluir artistas</p>
            <span class="qa-badge"><?= $totalArtistas ?? 0 ?> cadastrados</span>
        </a>
        <a href="<?= BASE_URL ?>/admin/albuns" class="quick-action">
            <div class="qa-icon"><i class="bi bi-collection"></i></div>
            <p class="qa-title">Álbuns</p>
            <p class="qa-desc">Visualizar e excluir álbuns</p>
            <span class="qa-badge"><?= $totalAlbuns ?? 0 ?> cadastrados</span>
        </a>
        <a href="<?= BASE_URL ?>/admin/musicas" class="quick-action">
            <div class="qa-icon"><i class="bi bi-music-note"></i></div>
            <p class="qa-title">Músicas</p>
            <p class="qa-desc">Ativar, desativar e excluir</p>
            <span class="qa-badge"><?= $totalMusicas ?? 0 ?> cadastradas</span>
        </a>
        <a href="<?= BASE_URL ?>/admin/usuarios" class="quick-action">
            <div class="qa-icon"><i class="bi bi-people"></i></div>
            <p class="qa-title">Usuários</p>
            <p class="qa-desc">Gerenciar usuários</p>
            <span class="qa-badge"><?= $totalUsuarios ?? 0 ?> cadastrados</span>
        </a>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>