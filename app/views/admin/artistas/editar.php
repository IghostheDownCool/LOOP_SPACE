<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="page-header">
    <h1>Editar Artista</h1>
    <p class="text-muted">Atualize as informações do artista</p>
</div>

<div class="card bg-dark">
    <div class="card-body">

        <?php if ($artista['foto']): ?>
            <div class="mb-3 text-center">
                <img
                    src="<?= BASE_URL ?>/uploads/artistas/<?= htmlspecialchars($artista['foto']) ?>"
                    alt="<?= htmlspecialchars($artista['nome']) ?>"
                    class="img-fluid rounded-circle"
                    style="max-width: 150px;"
                >
                <p class="text-muted mt-2">Foto atual</p>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="nome" class="form-label">Nome <span class="text-danger">*</span></label>
                <input
                    type="text"
                    class="form-control bg-secondary text-light"
                    id="nome"
                    name="nome"
                    value="<?= htmlspecialchars($artista['nome']) ?>"
                    required
                >
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Nova Foto (opcional)</label>
                <input
                    type="file"
                    class="form-control bg-secondary text-light"
                    id="foto"
                    name="foto"
                    accept="image/jpeg,image/png,image/gif,image/webp"
                >
                <small class="text-muted">Deixe em branco para manter a foto atual.<br>Formatos: JPG, PNG, GIF, WEBP • Máx. 5MB</small>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-verde">
                    <i class="bi bi-check-circle"></i> Atualizar
                </button>
                <a href="<?= BASE_URL ?>/admin/artistas" class="btn btn-cinza">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
            </div>

        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>