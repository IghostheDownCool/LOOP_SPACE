<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="admin-header">
    <div>
        <h1>Editar Álbum</h1>
        <p class="subtitle">Atualize as informações do álbum</p>
    </div>
    <div class="actions">
        <a href="<?= BASE_URL ?>/admin/albuns" class="btn btn-cinza">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>
</div>

<div class="admin-card">
    <form method="POST" enctype="multipart/form-data" class="form-admin">

        <?php if (!empty($album['capa'])): ?>
            <div class="text-center mb-4">
                <img
                    src="<?= BASE_URL ?>/uploads/capas/<?= htmlspecialchars($album['capa']) ?>"
                    alt="<?= htmlspecialchars($album['titulo']) ?>"
                    class="detail-cover"
                    style="max-width: 150px; border-radius: 8px;"
                >
                <p class="text-muted" style="font-size: 0.85rem;">Capa atual</p>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="titulo">Título <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        class="form-control"
                        id="titulo"
                        name="titulo"
                        value="<?= htmlspecialchars($album['titulo']) ?>"
                        required
                        placeholder="Digite o título do álbum"
                    >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="ano">Ano</label>
                    <input
                        type="number"
                        class="form-control"
                        id="ano"
                        name="ano"
                        value="<?= $album['ano'] ?? '' ?>"
                        min="1900"
                        max="<?= date('Y') ?>"
                        placeholder="Ex: 2024"
                    >
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="artista_id">Artista <span class="text-danger">*</span></label>
            <select class="form-control" id="artista_id" name="artista_id" required>
                <option value="">Selecione um artista</option>
                <?php foreach ($artistas as $artista): ?>
                    <option value="<?= $artista['id'] ?>" <?= $artista['id'] == $album['artista_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($artista['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="capa">Nova Capa (opcional)</label>
            <input
                type="file"
                class="form-control"
                id="capa"
                name="capa"
                accept="image/jpeg,image/png,image/gif,image/webp"
            >
            <small class="form-text">
                Deixe em branco para manter a capa atual.<br>
                Formatos: JPG, PNG, GIF, WEBP • Máx. 5MB
            </small>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-verde">
                <i class="bi bi-check-circle"></i> Atualizar
            </button>
            <a href="<?= BASE_URL ?>/admin/albuns" class="btn btn-cinza">
                <i class="bi bi-x-circle"></i> Cancelar
            </a>
        </div>

    </form>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>