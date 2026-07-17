<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($playlist['nome']) ?> - Loop Space</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <style>
        body { background: #121212; color: #fff; padding-top: 60px; }
        .playlist-cover { background: #181818; border-radius: 12px; padding: 30px; }
        .music-item { background: #181818; border: none; color: #fff; }
        .music-item:hover { background: #282828; }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="playlist-cover text-center">
                <i class="bi bi-collection-play" style="font-size: 100px; color: #1db954;"></i>
                <h1 class="mt-3"><?= htmlspecialchars($playlist['nome']) ?></h1>
                <p class="text-muted">
                    Por <?= htmlspecialchars($playlist['usuario_nome']) ?>
                </p>
                <p>
                    <?= count($musicas) ?> músicas
                </p>
                <a href="<?= BASE_URL ?>" class="btn btn-verde mt-3">
                    <i class="bi bi-house"></i> Ir para o Loop Space
                </a>
            </div>
        </div>
        <div class="col-md-8">
            <h2 class="mb-4">Músicas</h2>
            <?php if (empty($musicas)): ?>
                <div class="alert alert-secondary">Esta playlist ainda não possui músicas.</div>
            <?php else: ?>
                <div class="list-group">
                    <?php foreach ($musicas as $musica): ?>
                        <div class="list-group-item music-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong><?= htmlspecialchars($musica['titulo']) ?></strong>
                                <br>
                                <small class="text-muted">
                                    <?= htmlspecialchars($musica['artista']) ?>
                                    •
                                    <?= htmlspecialchars($musica['album']) ?>
                                </small>
                            </div>
                            <span class="badge bg-success"><?= gmdate('i:s', $musica['duracao'] ?? 0) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>