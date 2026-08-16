<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
    <h1>Bem-vindo de volta!</h1>
    <p class="text-muted">Aqui estão algumas sugestões para você.</p>
</div>

<!-- Seção: Continuar Navegando -->
<?php if (!empty($historicoNavegacao)): ?>
    <h2 class="mb-3" style="margin-top: 24px !important;">
        <i class="bi bi-clock-history" style="color: #1db954;"></i>
        Continuar navegando
    </h2>
    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-5 g-3 mb-4">
        <?php foreach ($historicoNavegacao as $item): ?>
            <div class="col">
                <a href="<?= BASE_URL . $item['link'] ?>" class="text-decoration-none">
                    <div class="card bg-card text-center h-100">
                        <?php if ($item['imagem']): ?>
                            <img
                                src="<?= BASE_URL ?>/uploads/<?= $item['tipo'] === 'artista' ? 'artistas' : 'capas' ?>/<?= htmlspecialchars($item['imagem']) ?>"
                                alt="<?= htmlspecialchars($item['titulo']) ?>"
                                class="card-img-top"
                                style="aspect-ratio: 1; object-fit: cover;"
                                onerror="this.src='<?= BASE_URL ?>/assets/images/default-cover.png'"
                            >
                        <?php else: ?>
                            <div class="card-img-top d-flex align-items-center justify-content-center" style="aspect-ratio: 1; background: var(--bg-secondary);">
                                <?php if ($item['tipo'] === 'playlist'): ?>
                                    <i class="bi bi-collection-play" style="font-size: 2.5rem; color: #1db954;"></i>
                                <?php elseif ($item['tipo'] === 'genero'): ?>
                                    <i class="bi bi-tag" style="font-size: 2.5rem; color: #ffd700;"></i>
                                <?php else: ?>
                                    <i class="bi bi-music-note" style="font-size: 2.5rem; color: var(--text-muted);"></i>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <div class="card-body py-2">
                            <h6 class="text-primary mb-0" style="font-size: 0.85rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <?= htmlspecialchars($item['titulo']) ?>
                            </h6>
                            <small class="text-muted" style="font-size: 0.65rem; text-transform: capitalize;">
                                <?= $item['tipo'] === 'artista' ? 'Artista' : ($item['tipo'] === 'album' ? 'Álbum' : ($item['tipo'] === 'playlist' ? 'Playlist' : 'Gênero')) ?>
                            </small>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<!-- Seção de Recomendações -->
<?php if (!empty($recomendacoes)): ?>
    <h2 class="mb-3" style="margin-top: 24px !important;">
        <i class="bi bi-stars" style="color: #1db954;"></i>
        Recomendadas para você
    </h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($recomendacoes as $musica): ?>
            <div class="col">
                <div class="card bg-card h-100">
                    <?php 
                    // 🔥 PASSA A FILA DE RECOMENDAÇÕES
                    $filaMusicas = $filaRecomendacoes;
                    require __DIR__ . '/../components/music-card.php'; 
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="alert alert-secondary" style="margin-top: 16px;">
        Você ainda não tem histórico suficiente para recomendações. Comece a ouvir algumas músicas!
    </div>
<?php endif; ?>

<!-- Seção de Artistas Seguidos -->
<?php if (!empty($seguidos)): ?>
    <h2 class="mb-3" style="margin-top: 24px !important;">
        <i class="bi bi-people" style="color: #1db954;"></i>
        Artistas que você segue
    </h2>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3">
        <?php foreach ($seguidos as $seguido): ?>
            <div class="col">
                <div class="card bg-card artist-card h-auto">
                    <a href="<?= BASE_URL ?>/artista/ver/<?= $seguido['id'] ?>" class="text-decoration-none d-block">
                        <img
                            src="<?= BASE_URL ?>/uploads/artistas/<?= htmlspecialchars($seguido['foto'] ?? 'default-artist.png') ?>"
                            alt="<?= htmlspecialchars($seguido['nome']) ?>"
                            class="card-img-top artist-avatar"
                        >
                        <div class="card-body py-2 text-center">
                            <h6 class="artist-name"><?= htmlspecialchars($seguido['nome']) ?></h6>
                            <small class="text-muted"><?= $seguido['total_seguidores'] ?? 0 ?> seguidores</small>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (!empty($musicasSeguidos)): ?>
        <h2 class="mb-3" style="margin-top: 24px !important;">
            <i class="bi bi-music-note-beamed" style="color: #ff6b6b;"></i>
            Músicas dos artistas que você segue
        </h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($musicasSeguidos as $musica): ?>
                <div class="col">
                    <div class="card bg-card h-auto">
                        <?php 
                        // 🔥 PASSA A FILA DE MÚSICAS DOS SEGUIDOS
                        $filaMusicas = $filaSeguidos;
                        require __DIR__ . '/../components/music-card.php'; 
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
<?php else: ?>
    <div class="alert alert-secondary" style="margin-top: 16px;">
        Você ainda não segue nenhum artista.
        <a href="<?= BASE_URL ?>/player" class="text-success">Descubra novos artistas</a> e comece a seguir!
    </div>
<?php endif; ?>

<!-- Seção de Top Músicas -->
<?php if (!empty($topMusicas)): ?>
    <h2 class="mb-3" style="margin-top: 24px !important;">
        <i class="bi bi-fire" style="color: #ff6b6b;"></i>
        Mais ouvidas do momento
    </h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($topMusicas as $musica): ?>
            <div class="col">
                <div class="card bg-card h-100">
                    <?php 
                    // 🔥 PASSA A FILA DE TOP MÚSICAS
                    $filaMusicas = $filaTop;
                    require __DIR__ . '/../components/music-card.php'; 
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>