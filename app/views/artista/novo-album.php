<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
    <h1>Novo Álbum</h1>
    <p class="text-muted">Crie um novo álbum para organizar suas músicas.</p>
</div>

<div class="row">
    <div class="col-md-8">
        <form method="POST" action="<?= BASE_URL ?>/artista/salvar-album" enctype="multipart/form-data" class="bg-card p-4 rounded">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título do Álbum *</label>
                <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Ex: Meu Primeiro Álbum" required>
            </div>

            <div class="mb-3">
                <label for="ano" class="form-label">Ano *</label>
                <input type="number" name="ano" id="ano" class="form-control" placeholder="2024" value="<?= date('Y') ?>" min="1900" max="<?= date('Y') + 1 ?>" required>
            </div>

            <div class="mb-3">
                <label for="capa" class="form-label">Capa do Álbum (opcional)</label>
                <input type="file" name="capa" id="capa" class="form-control" accept="image/*">
                <small class="text-muted">Formatos: JPG, PNG, GIF, WEBP. Máximo 5MB.</small>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-plus-circle"></i> Criar Álbum
            </button>
        </form>
    </div>

    <div class="col-md-4">
        <div class="card bg-card p-3">
            <h5 class="mb-3"><i class="bi bi-info-circle"></i> Sobre Álbuns</h5>
            <ul class="list-unstyled">
                <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Álbuns organizam suas músicas</li>
                <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Cada música deve pertencer a um álbum</li>
                <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Você pode ter quantos álbuns quiser</li>
                <li><i class="bi bi-check-circle text-success"></i> A capa ajuda a identificar o álbum</li>
            </ul>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>