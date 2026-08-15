<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div style="height: auto; min-height: auto;">

    <div class="page-header">
        <h1>Dashboard do Artista</h1>
        <p class="text-muted">Bem-vindo, <?= htmlspecialchars($artista['nome']) ?>!</p>
    </div>

    <!-- Estatísticas -->
    <div class="row g-3 mb-4" style="height: auto; min-height: auto;">
        <div class="col-6 col-md-3">
            <div class="card bg-card p-3 text-center" style="height: auto; min-height: 100px;">
                <div style="font-size: 1.8rem; color: #8B5CF6; line-height: 1;">
                    <i class="bi bi-music-note-beamed"></i>
                </div>
                <div style="font-size: 1.8rem; font-weight: 700; line-height: 1.2;"><?= $totalMusicas ?></div>
                <div style="font-size: 0.8rem; color: var(--text-muted);">Músicas</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card bg-card p-3 text-center" style="height: auto; min-height: 100px;">
                <div style="font-size: 1.8rem; color: #1db954; line-height: 1;">
                    <i class="bi bi-collection-play"></i>
                </div>
                <div style="font-size: 1.8rem; font-weight: 700; line-height: 1.2;"><?= $totalAlbuns ?></div>
                <div style="font-size: 0.8rem; color: var(--text-muted);">Álbuns</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card bg-card p-3 text-center" style="height: auto; min-height: 100px;">
                <div style="font-size: 1.8rem; color: #ff6b6b; line-height: 1;">
                    <i class="bi bi-headphones"></i>
                </div>
                <div style="font-size: 1.8rem; font-weight: 700; line-height: 1.2;"><?= number_format($totalReproducoes, 0, ',', '.') ?></div>
                <div style="font-size: 0.8rem; color: var(--text-muted);">Reproduções</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card bg-card p-3 text-center" style="height: auto; min-height: 100px;">
                <div style="font-size: 1.8rem; color: #ffd700; line-height: 1;">
                    <i class="bi bi-people"></i>
                </div>
                <div style="font-size: 1.8rem; font-weight: 700; line-height: 1.2;"><?= $totalSeguidores ?></div>
                <div style="font-size: 0.8rem; color: var(--text-muted);">Seguidores</div>
            </div>
        </div>
    </div>

    <!-- Conteúdo principal -->
    <div class="row g-3" style="height: auto; min-height: auto;">
        <!-- Últimas músicas -->
        <div class="col-md-6">
            <div class="card bg-card" style="height: auto !important; min-height: auto !important;">
                <div class="card-header d-flex justify-content-between align-items-center" style="background: var(--bg-secondary); border-bottom: 1px solid var(--border-color); padding: 10px 16px;">
                    <h5 class="mb-0" style="font-size: 1rem;"><i class="bi bi-clock-history"></i> Últimas Músicas</h5>
                    <a href="<?= BASE_URL ?>/artista/musicas" class="btn btn-sm btn-primary" style="padding: 4px 12px; font-size: 0.75rem;">Ver todas</a>
                </div>
                <div class="card-body" style="padding: 0 !important;">
                    <?php if (empty($ultimasMusicas)): ?>
                        <p class="text-muted text-center" style="padding: 20px 0; margin: 0;">Você ainda não tem músicas cadastradas.</p>
                    <?php else: ?>
                        <?php foreach ($ultimasMusicas as $musica): ?>
                            <div class="d-flex justify-content-between align-items-center" style="padding: 8px 16px; border-bottom: 1px solid var(--border-color);">
                                <div>
                                    <strong style="font-size: 0.85rem;"><?= htmlspecialchars($musica['titulo']) ?></strong>
                                    <br>
                                    <small class="text-muted" style="font-size: 0.7rem;"><?= htmlspecialchars($musica['album'] ?? '') ?></small>
                                </div>
                                <span class="badge bg-success" style="font-size: 0.65rem; padding: 4px 8px;"><?= $musica['reproducoes'] ?> plays</span>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Top músicas -->
        <div class="col-md-6">
            <div class="card bg-card" style="height: auto !important; min-height: auto !important;">
                <div class="card-header" style="background: var(--bg-secondary); border-bottom: 1px solid var(--border-color); padding: 10px 16px;">
                    <h5 class="mb-0" style="font-size: 1rem;"><i class="bi bi-fire" style="color: #ff6b6b;"></i> Top Músicas</h5>
                </div>
                <div class="card-body" style="padding: 0 !important;">
                    <?php if (empty($topMusicas)): ?>
                        <p class="text-muted text-center" style="padding: 20px 0; margin: 0;">Nenhuma música com reproduções ainda.</p>
                    <?php else: ?>
                        <?php foreach ($topMusicas as $index => $musica): ?>
                            <div class="d-flex justify-content-between align-items-center" style="padding: 8px 16px; border-bottom: 1px solid var(--border-color);">
                                <div>
                                    <span class="badge bg-secondary me-2" style="font-size: 0.6rem; padding: 3px 8px;">#<?= $index + 1 ?></span>
                                    <strong style="font-size: 0.85rem;"><?= htmlspecialchars($musica['titulo']) ?></strong>
                                </div>
                                <span class="badge bg-warning text-dark" style="font-size: 0.65rem; padding: 4px 8px;"><?= $musica['reproducoes'] ?> plays</span>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Botões rápidos -->
    <div class="row g-2 mt-3" style="height: auto; min-height: auto;">
        <div class="col-6 col-md-3">
            <a href="<?= BASE_URL ?>/artista/upload" class="btn btn-primary w-100" style="font-size: 0.9rem; padding: 10px;">
                <i class="bi bi-cloud-arrow-up"></i> Nova Música
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="<?= BASE_URL ?>/artista/novo-album" class="btn btn-success w-100" style="font-size: 0.9rem; padding: 10px;">
                <i class="bi bi-plus-circle"></i> Novo Álbum
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="<?= BASE_URL ?>/artista/musicas" class="btn btn-secondary w-100" style="font-size: 0.9rem; padding: 10px;">
                <i class="bi bi-music-note-list"></i> Gerenciar
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="<?= BASE_URL ?>/artista/seguidores" class="btn btn-info w-100" style="font-size: 0.9rem; padding: 10px;">
                <i class="bi bi-people"></i> Seguidores
            </a>
        </div>
    </div>

</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>