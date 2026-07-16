<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="page-header">
    <h1>Novo Artista</h1>
    <p class="text-muted">Cadastre um novo artista</p>
</div>

<div class="card bg-dark">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="nome" class="form-label">Nome <span class="text-danger">*</span></label>
                <input
                    type="text"
                    class="form-control bg-secondary text-light"
                    id="nome"
                    name="nome"
                    required
                    placeholder="Digite o nome do artista"
                >
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto (opcional)</label>
                <input
                    type="file"
                    class="form-control bg-secondary text-light"
                    id="foto"
                    name="foto"
                    accept="image/jpeg,image/png,image/gif,image/webp"
                >
                <small class="text-muted">Formatos: JPG, PNG, GIF, WEBP • Máx. 5MB</small>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-verde">
                    <i class="bi bi-check-circle"></i> Salvar
                </button>
                <a href="<?= BASE_URL ?>/admin/artistas" class="btn btn-cinza">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
            </div>

        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>