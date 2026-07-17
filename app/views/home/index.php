<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
    <h1>Bem-vindo de volta!</h1>
    <p class="text-muted">Aqui estão algumas sugestões para você.</p>
</div>

<!-- Seção de Recomendações -->
<?php if (!empty($recomendacoes)): ?>
    <h2 class="mt-4 mb-3">
        <i class="bi bi-stars" style="color: #1db954;"></i>
        Recomendadas para você
    </h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($recomendacoes as $musica): ?>
            <div class="col">
                <div class="card bg-card h-100">
                    <?php require __DIR__ . '/../components/music-card.php'; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="alert alert-secondary">
        Você ainda não tem histórico suficiente para recomendações. Comece a ouvir algumas músicas!
    </div>
<?php endif; ?>

<!-- Seção de Artistas Seguidos -->
<?php
$artistaModel = new Artista();
$seguidos = $artistaModel->listarSeguidos($_SESSION['usuario_id']);
$musicasSeguidos = $artistaModel->getMusicasDosSeguidos($_SESSION['usuario_id'], 10);
?>

<?php if (!empty($seguidos)): ?>
    <h2 class="mt-5 mb-3">
        <i class="bi bi-people" style="color: #1db954;"></i>
        Artistas que você segue
    </h2>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3">
        <?php foreach ($seguidos as $seguido): ?>
            <div class="col">
                <div class="card bg-card text-center h-100 artist-card">
                    <a href="<?= BASE_URL ?>/artista/ver/<?= $seguido['id'] ?>" class="text-decoration-none">
                        <img
                            src="<?= BASE_URL ?>/uploads/artistas/<?= htmlspecialchars($seguido['foto'] ?? 'default-artist.png') ?>"
                            alt="<?= htmlspecialchars($seguido['nome']) ?>"
                            class="card-img-top artist-avatar"
                        >
                        <div class="card-body py-2">
                            <h6 class="artist-name"><?= htmlspecialchars($seguido['nome']) ?></h6>
                            <small class="text-muted"><?= $seguido['total_seguidores'] ?? 0 ?> seguidores</small>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (!empty($musicasSeguidos)): ?>
        <h2 class="mt-5 mb-3">
            <i class="bi bi-music-note-beamed" style="color: #ff6b6b;"></i>
            Músicas dos artistas que você segue
        </h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($musicasSeguidos as $musica): ?>
                <div class="col">
                    <div class="card bg-card h-100">
                        <?php require __DIR__ . '/../components/music-card.php'; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
<?php else: ?>
    <div class="alert alert-secondary mt-4">
        Você ainda não segue nenhum artista.
        <a href="<?= BASE_URL ?>/player" class="text-success">Descubra novos artistas</a> e comece a seguir!
    </div>
<?php endif; ?>

<!-- Seção de Top Músicas -->
<?php if (!empty($topMusicas)): ?>
    <h2 class="mt-5 mb-3">
        <i class="bi bi-fire" style="color: #ff6b6b;"></i>
        Mais ouvidas do momento
    </h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($topMusicas as $musica): ?>
            <div class="col">
                <div class="card bg-card h-100">
                    <?php require __DIR__ . '/../components/music-card.php'; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>