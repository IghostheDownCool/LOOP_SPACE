<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<style>
/* ==================================================
   CARDS DE ESTATÍSTICAS - CORRIGIDOS
   ================================================== */

/* 1. Força as linhas de estatísticas a não limitarem altura */
.row-cols-2,
.row-cols-md-3,
.row-cols-xl-6 {
    align-items: flex-start !important;
    height: auto !important;
    min-height: auto !important;
}

/* 2. Corrige as colunas de estatísticas */
.row-cols-2 > .col,
.row-cols-md-3 > .col,
.row-cols-xl-6 > .col {
    height: auto !important;
    min-height: auto !important;
    display: flex;
    flex-direction: column;
    flex: 0 0 auto !important;
}

/* 3. Corrige o card de estatística */
.stat-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 16px 12px;
    transition: transform 0.2s, border-color 0.2s, background 0.3s;
    height: auto !important;
    min-height: auto !important;
    flex: 0 0 auto !important;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    width: 100%;
}

.stat-card:hover {
    transform: translateY(-4px);
    border-color: #1db954;
}

.stat-card .stat-icon {
    font-size: 1.8rem;
    color: #1db954;
    margin-bottom: 6px;
    line-height: 1;
}

.stat-card .stat-number {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
    line-height: 1.2;
}

.stat-card .stat-label {
    color: var(--text-secondary);
    font-size: 0.75rem;
    margin-top: 4px;
    line-height: 1.4;
}

/* 4. Responsividade para o dashboard */
@media (max-width: 768px) {
    .stat-card .stat-number {
        font-size: 1.4rem;
    }
    
    .stat-card .stat-icon {
        font-size: 1.4rem;
    }
    
    .stat-card {
        padding: 12px 8px;
    }
}

@media (max-width: 576px) {
    .stat-card .stat-number {
        font-size: 1.2rem;
    }
    
    .stat-card .stat-icon {
        font-size: 1.2rem;
    }
    
    .stat-card .stat-label {
        font-size: 0.65rem;
    }
    
    .stat-card {
        padding: 8px 4px;
    }
}
</style>

<div class="admin-header">
    <div>
        <h1>Dashboard</h1>
        <p class="subtitle">Visão geral do sistema</p>
    </div>
</div>

<!-- Cards de Estatísticas -->
<div class="row row-cols-2 row-cols-md-3 row-cols-xl-6 g-3 mb-4">
    <div class="col">
        <div class="stat-card text-center h-auto">
            <div class="stat-icon"><i class="bi bi-people"></i></div>
            <div class="stat-number"><?= $totalUsuarios ?? 0 ?></div>
            <div class="stat-label">Usuários</div>
        </div>
    </div>
    <div class="col">
        <div class="stat-card text-center h-auto">
            <div class="stat-icon"><i class="bi bi-music-note"></i></div>
            <div class="stat-number"><?= $totalMusicas ?? 0 ?></div>
            <div class="stat-label">Músicas</div>
        </div>
    </div>
    <div class="col">
        <div class="stat-card text-center h-auto">
            <div class="stat-icon"><i class="bi bi-person"></i></div>
            <div class="stat-number"><?= $totalArtistas ?? 0 ?></div>
            <div class="stat-label">Artistas</div>
        </div>
    </div>
    <div class="col">
        <div class="stat-card text-center h-auto">
            <div class="stat-icon"><i class="bi bi-collection"></i></div>
            <div class="stat-number"><?= $totalAlbuns ?? 0 ?></div>
            <div class="stat-label">Álbuns</div>
        </div>
    </div>
    <div class="col">
        <div class="stat-card text-center h-auto">
            <div class="stat-icon"><i class="bi bi-collection-play"></i></div>
            <div class="stat-number"><?= $totalPlaylists ?? 0 ?></div>
            <div class="stat-label">Playlists</div>
        </div>
    </div>
    <div class="col">
        <div class="stat-card text-center h-auto">
            <div class="stat-icon"><i class="bi bi-heart-fill"></i></div>
            <div class="stat-number"><?= $totalCurtidas ?? 0 ?></div>
            <div class="stat-label">Curtidas</div>
        </div>
    </div>
</div>

<!-- Top Músicas e Top Artistas -->
<div class="row g-4">
    <div class="col-md-6">
        <div class="list-card">
            <div class="card-header">
                <h5><i class="bi bi-fire text-danger me-2"></i> Músicas Mais Ouvidas</h5>
            </div>
            <div class="list-group list-group-flush">
                <?php if (empty($topMusicas)): ?>
                    <div class="list-group-item text-muted">Nenhuma música encontrada.</div>
                <?php else: ?>
                    <?php foreach ($topMusicas as $musica): ?>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <?= htmlspecialchars($musica['titulo'] ?? '') ?>
                                <small class="text-muted">— <?= htmlspecialchars($musica['artista'] ?? '') ?></small>
                            </span>
                            <span class="badge badge-primary"><?= $musica['reproducoes'] ?? 0 ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="list-card">
            <div class="card-header">
                <h5><i class="bi bi-star-fill text-warning me-2"></i> Artistas Mais Seguidos</h5>
            </div>
            <div class="list-group list-group-flush">
                <?php if (empty($topArtistas)): ?>
                    <div class="list-group-item text-muted">Nenhum artista encontrado.</div>
                <?php else: ?>
                    <?php foreach ($topArtistas as $artista): ?>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <img src="<?= BASE_URL ?>/uploads/artistas/<?= htmlspecialchars($artista['foto'] ?? 'default-artist.png') ?>" style="width: 30px; height: 30px; object-fit: cover; border-radius: 50%; margin-right: 10px;">
                                <?= htmlspecialchars($artista['nome']) ?>
                            </span>
                            <span class="badge badge-success"><?= $artista['total_seguidores'] ?? 0 ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Últimos Usuários e Últimas Músicas -->
<div class="row g-4 mt-3">
    <div class="col-md-6">
        <div class="list-card">
            <div class="card-header">
                <h5><i class="bi bi-person-plus text-success me-2"></i> Últimos Usuários</h5>
            </div>
            <div class="list-group list-group-flush">
                <?php if (empty($ultimosUsuarios)): ?>
                    <div class="list-group-item text-muted">Nenhum usuário encontrado.</div>
                <?php else: ?>
                    <?php foreach ($ultimosUsuarios as $usuario): ?>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <?= htmlspecialchars($usuario['nome'] ?? '') ?>
                                <small class="text-muted">— <?= htmlspecialchars($usuario['email'] ?? '') ?></small>
                            </span>
                            <small class="text-muted"><?= date('d/m/Y', strtotime($usuario['created_at'] ?? 'now')) ?></small>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="list-card">
            <div class="card-header">
                <h5><i class="bi bi-music-note-beamed text-info me-2"></i> Últimas Músicas</h5>
            </div>
            <div class="list-group list-group-flush">
                <?php if (empty($ultimasMusicas)): ?>
                    <div class="list-group-item text-muted">Nenhuma música encontrada.</div>
                <?php else: ?>
                    <?php foreach ($ultimasMusicas as $musica): ?>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <?= htmlspecialchars($musica['titulo'] ?? '') ?>
                                <small class="text-muted">— <?= htmlspecialchars($musica['artista'] ?? '') ?></small>
                            </span>
                            <small class="text-muted"><?= date('d/m/Y', strtotime($musica['criado_em'] ?? 'now')) ?></small>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>