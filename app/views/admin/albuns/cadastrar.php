<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="page-header">
    <h1>Novo Álbum</h1>
    <p class="text-muted">Cadastre um novo álbum</p>
</div>

<div class="card bg-dark">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
                <input
                    type="text"
                    class="form-control bg-secondary text-light"
                    id="titulo"
                    name="titulo"
                    required
                    placeholder="Digite o título do álbum"
                >
            </div>

            <div class="mb-3">
                <label for="artista_id" class="form-label">Artista <span class="text-danger">*</span></label>
                <select class="form-control bg-secondary text-light" id="artista_id" name="artista_id" required>
                    <option value="">Selecione um artista</option>
                    <?php foreach ($artistas as $artista): ?>
                        <option value="<?= $artista['id'] ?>"><?= htmlspecialchars($artista['nome']) ?></option>
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
                    placeholder="Ex: 2024"
                >
            </div>

            <div class="mb-3">
                <label for="capa" class="form-label">Capa</label>
                <input
                    type="file"
                    class="form-control bg-secondary text-light"
                    id="capa"
                    name="capa"
                    accept="image/jpeg,image/png,image/gif,image/webp"
                >
                <small class="text-muted">Formatos: JPG, PNG, GIF, WEBP • Máx. 5MB</small>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-verde">
                    <i class="bi bi-check-circle"></i> Salvar
                </button>
                <a href="<?= BASE_URL ?>/admin/albuns" class="btn btn-cinza">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
            </div>

        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>