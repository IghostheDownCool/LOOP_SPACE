<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="row">
    <div class="col-md-3 text-center">
        <img
            src="<?= BASE_URL ?>/uploads/artistas/<?= htmlspecialchars($artista['foto'] ?? 'default-artist.png') ?>"
            alt="<?= htmlspecialchars($artista['nome']) ?>"
            class="img-fluid rounded-circle"
            style="max-width: 200px;"
        >
        <h1 class="mt-3"><?= htmlspecialchars($artista['nome']) ?></h1>
        <p>
            <?= $artista['total_albuns'] ?? 0 ?> álbuns •
            <?= $artista['total_musicas'] ?? 0 ?> músicas
        </p>

        <?php
        $artistaModel = new Artista();
        $segue = $artistaModel->usuarioSegue($_SESSION['usuario_id'], $artista['id']);
        ?>

        <div class="mt-3 mb-4">
            <?php if ($segue): ?>
                <a href="<?= BASE_URL ?>/artista/deixarSeguir/<?= $artista['id'] ?>" class="btn btn-verde">
                    <i class="bi bi-check-circle"></i> Seguindo
                </a>
            <?php else: ?>
                <a href="<?= BASE_URL ?>/artista/seguir/<?= $artista['id'] ?>" class="btn btn-secondary">
                    <i class="bi bi-plus-circle"></i> Seguir
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="col-md-9">
        <h2>Álbuns</h2>
        <div class="row">
            <?php if (!empty($albuns)): ?>
                <?php foreach ($albuns as $album): ?>
                    <div class="col-md-3 mb-3">
                        <div class="card bg-dark text-light">
                            <img
                                src="<?= BASE_URL ?>/uploads/capas/<?= htmlspecialchars($album['capa'] ?? 'default-album.png') ?>"
                                alt="<?= htmlspecialchars($album['titulo']) ?>"
                                class="card-img-top"
                            >
                            <div class="card-body">
                                <h6><?= htmlspecialchars($album['titulo']) ?></h6>
                                <small><?= $album['ano'] ?? '' ?></small>
                                <br>
                                <a href="<?= BASE_URL ?>/album/ver/<?= $album['id'] ?>" class="btn btn-sm btn-verde">Ver</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted">Nenhum álbum encontrado.</p>
            <?php endif; ?>
        </div>

        <h2 class="mt-4">Músicas</h2>
        <?php if (!empty($musicas)): ?>
            <div class="list-group">
                <?php foreach ($musicas as $musica): ?>
                    <?php require __DIR__ . '/../components/music-card.php'; ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-muted">Nenhuma música encontrada.</p>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>