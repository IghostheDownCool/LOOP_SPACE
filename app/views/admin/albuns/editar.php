<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="page-header">
    <h1>Editar Álbum</h1>
    <p class="text-muted">Atualize as informações do álbum</p>
</div>

<div class="card bg-dark">
    <div class="card-body">

        <?php if (!empty($album['capa'])): ?>
            <div class="mb-3 text-center">
                <img
                    src="<?= BASE_URL ?>/uploads/capas/<?= htmlspecialchars($album['capa']) ?>"
                    alt="<?= htmlspecialchars($album['titulo']) ?>"
                    class="img-fluid"
                    style="max-width: 150px; border-radius: 8px;"
                >
                <p class="text-muted mt-2">Capa atual</p>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
                <input
                    type="text"
                    class="form-control bg-secondary text-light"
                    id="titulo"
                    name="titulo"
                    value="<?= htmlspecialchars($album['titulo']) ?>"
                    required
                >
            </div>

            <div class="mb-3">
                <label for="artista_id" class="form-label">Artista <span class="text-danger">*</span></label>
                <select class="form-control bg-secondary text-light" id="artista_id" name="artista_id" required>
                    <option value="">Selecione um artista</option>
                    <?php foreach ($artistas as $artista): ?>
                        <option value="<?= $artista['id'] ?>" <?= $artista['id'] == $album['artista_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($artista['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="ano" class="form-label">Ano</label>
                <input
                    type="number"
                    class="form-control bg-secondary text-light"
                    id="ano"
                    name="ano"
                    min="1900"
                    max="<?= date('Y') ?>"
                    value="<?= $album['ano'] ?? '' ?>"
                >
            </div>

            <div class="mb-3">
                <label for="capa" class="form-label">Nova Capa (opcional)</label>
                <input
                    type="file"
                    class="form-control bg-secondary text-light"
                    id="capa"
                    name="capa"
                    accept="image/jpeg,image/png,image/gif,image/webp"
                >
                <small class="text-muted">Deixe em branco para manter a capa atual.<br>Formatos: JPG, PNG, GIF, WEBP • Máx. 5MB</small>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-verde">
                    <i class="bi bi-check-circle"></i> Atualizar
                </button>
                <a href="<?= BASE_URL ?>/admin/albuns" class="btn btn-cinza">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
            </div>

        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>