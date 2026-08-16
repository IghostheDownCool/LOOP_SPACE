<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
    <h1>Editar Perfil do Artista</h1>
    <p class="text-muted">Atualize as informações do seu perfil público.</p>
</div>

<div class="row">
    <div class="col-md-8">
        <form method="POST" action="<?= BASE_URL ?>/artista/atualizar-perfil" enctype="multipart/form-data" class="bg-card p-4 rounded">

            <div class="mb-3">
                <label for="nome" class="form-label">Nome Artístico *</label>
                <input type="text" name="nome" id="nome" class="form-control" value="<?= htmlspecialchars($artista['nome']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto do Artista</label>
                <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                <small class="text-muted">
                    <?php if (!empty($artista['foto'])): ?>
                        Foto atual: <?= htmlspecialchars($artista['foto']) ?>
                    <?php else: ?>
                        Nenhuma foto definida.
                    <?php endif; ?>
                    <br>Formatos: JPG, PNG, GIF, WEBP. Máximo 5MB.
                </small>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Salvar Alterações
                </button>
                <a href="<?= BASE_URL ?>/artista/dashboard" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
            </div>

        </form>
    </div>

    <div class="col-md-4">
        <div class="card bg-card p-3 text-center">
            <h5 class="mb-3"><i class="bi bi-image"></i> Visualização</h5>
            <?php if (!empty($artista['foto'])): ?>
                <img
                    src="<?= BASE_URL ?>/uploads/artistas/<?= htmlspecialchars($artista['foto']) ?>"
                    alt="<?= htmlspecialchars($artista['nome']) ?>"
                    style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 3px solid #8B5CF6; margin: 0 auto;"
                >
            <?php else: ?>
                <div style="width: 150px; height: 150px; border-radius: 50%; background: var(--bg-secondary); display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                    <i class="bi bi-person" style="font-size: 4rem; color: var(--text-muted);"></i>
                </div>
            <?php endif; ?>
            <p class="mt-2 text-muted">Esta é a foto que aparece no seu perfil público.</p>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>