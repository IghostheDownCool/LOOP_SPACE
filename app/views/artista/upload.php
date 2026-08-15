<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
    <h1>Enviar Nova Música</h1>
    <p class="text-muted">Preencha os dados abaixo para adicionar uma nova música.</p>
</div>

<div class="row">
    <div class="col-md-8">
        <form method="POST" action="<?= BASE_URL ?>/artista/salvar-musica" enctype="multipart/form-data" class="bg-card p-4 rounded">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título da Música *</label>
                <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Ex: Minha Música" required>
            </div>

            <div class="mb-3">
                <label for="album_id" class="form-label">Álbum *</label>
                <select name="album_id" id="album_id" class="form-select" required>
                    <option value="">Selecione um álbum</option>
                    <?php foreach ($albuns as $album): ?>
                        <option value="<?= $album['id'] ?>"><?= htmlspecialchars($album['titulo']) ?> (<?= $album['ano'] ?>)</option>
                    <?php endforeach; ?>
                </select>
                <?php if (empty($albuns)): ?>
                    <small class="text-muted">Você não tem álbuns. <a href="<?= BASE_URL ?>/artista/novo-album" class="text-primary">Crie um álbum primeiro</a></small>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="numero_faixa" class="form-label">Número da Faixa *</label>
                        <input type="number" name="numero_faixa" id="numero_faixa" class="form-control" placeholder="1" min="1" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="duracao" class="form-label">Duração (segundos) *</label>
                        <input type="number" name="duracao" id="duracao" class="form-control" placeholder="180" min="1" required>
                        <small class="text-muted">Ex: 180 = 3 minutos</small>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="genero" class="form-label">Gênero</label>
                <input type="text" name="genero" id="genero" class="form-control" placeholder="Ex: Rock, Pop, Eletrônica">
            </div>

            <div class="mb-3">
                <label for="arquivo" class="form-label">Arquivo de Áudio (MP3) *</label>
                <input type="file" name="arquivo" id="arquivo" class="form-control" accept=".mp3,.wav,.ogg,.m4a" required>
                <small class="text-muted">Formatos permitidos: MP3, WAV, OGG, M4A. Máximo 20MB.</small>
            </div>

            <div class="mb-3">
                <label for="capa" class="form-label">Capa da Música (opcional)</label>
                <input type="file" name="capa" id="capa" class="form-control" accept="image/*">
                <small class="text-muted">Formatos: JPG, PNG, GIF, WEBP. Máximo 5MB.</small>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-cloud-arrow-up"></i> Enviar Música
            </button>
        </form>
    </div>

    <div class="col-md-4">
        <div class="card bg-card p-3">
            <h5 class="mb-3"><i class="bi bi-info-circle"></i> Dicas</h5>
            <ul class="list-unstyled">
                <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Use um título claro e descritivo</li>
                <li class="mb-2"><i class="bi bi-check-circle text-success"></i> A duração deve ser em segundos</li>
                <li class="mb-2"><i class="bi bi-check-circle text-success"></i> O arquivo de áudio deve ser MP3</li>
                <li class="mb-2"><i class="bi bi-check-circle text-success"></i> A capa ajuda a destacar sua música</li>
                <li><i class="bi bi-check-circle text-success"></i> Músicas inativas não aparecem para o público</li>
            </ul>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>