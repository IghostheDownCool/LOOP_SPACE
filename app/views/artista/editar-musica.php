<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
    <h1>Editar Música</h1>
    <p class="text-muted">Atualize as informações da sua música.</p>
</div>

<div class="row">
    <div class="col-md-8">
        <form method="POST" action="<?= BASE_URL ?>/artista/atualizar-musica/<?= $musica['id'] ?>" enctype="multipart/form-data" class="bg-card p-4 rounded">

            <div class="mb-3">
                <label for="titulo" class="form-label">Título da Música *</label>
                <input type="text" name="titulo" id="titulo" class="form-control" value="<?= htmlspecialchars($musica['titulo']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="album_id" class="form-label">Álbum *</label>
                <select name="album_id" id="album_id" class="form-select" required>
                    <option value="">Selecione um álbum</option>
                    <?php foreach ($albuns as $album): ?>
                        <option value="<?= $album['id'] ?>" <?= $album['id'] == $musica['album_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($album['titulo']) ?> (<?= $album['ano'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="numero_faixa" class="form-label">Número da Faixa *</label>
                        <input type="number" name="numero_faixa" id="numero_faixa" class="form-control" value="<?= $musica['numero_faixa'] ?>" min="1" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="duracao" class="form-label">Duração (segundos) *</label>
                        <input type="number" name="duracao" id="duracao" class="form-control" value="<?= $musica['duracao'] ?>" min="1" required>
                        <small class="text-muted">Ex: 180 = 3 minutos</small>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="genero" class="form-label">Gênero</label>
                <input type="text" name="genero" id="genero" class="form-control" value="<?= htmlspecialchars($musica['genero'] ?? '') ?>" placeholder="Ex: Rock, Pop, Eletrônica">
            </div>

            <div class="mb-3">
                <label for="arquivo" class="form-label">Substituir Arquivo de Áudio (opcional)</label>
                <input type="file" name="arquivo" id="arquivo" class="form-control" accept=".mp3,.wav,.ogg,.m4a">
                <small class="text-muted">
                    Atual: <?= htmlspecialchars($musica['arquivo']) ?>
                    <br>Formatos permitidos: MP3, WAV, OGG, M4A. Máximo 20MB.
                </small>
            </div>

            <div class="mb-3">
                <label for="capa" class="form-label">Substituir Capa (opcional)</label>
                <input type="file" name="capa" id="capa" class="form-control" accept="image/*">
                <small class="text-muted">
                    <?php if (!empty($musica['capa'])): ?>
                        Capa atual: <?= htmlspecialchars($musica['capa']) ?>
                    <?php else: ?>
                        Nenhuma capa definida.
                    <?php endif; ?>
                    <br>Formatos: JPG, PNG, GIF, WEBP. Máximo 5MB.
                </small>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Salvar Alterações
                </button>
                <a href="<?= BASE_URL ?>/artista/musicas" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Cancelar
                </a>
            </div>

        </form>
    </div>

    <div class="col-md-4">
        <div class="card bg-card p-3">
            <h5 class="mb-3"><i class="bi bi-info-circle"></i> Informações</h5>
            <ul class="list-unstyled">
                <li class="mb-2"><i class="bi bi-music-note"></i> <strong>Música ID:</strong> <?= $musica['id'] ?></li>
                <li class="mb-2"><i class="bi bi-calendar"></i> <strong>Criada em:</strong> <?= date('d/m/Y H:i', strtotime($musica['criado_em'])) ?></li>
                <li class="mb-2"><i class="bi bi-headphones"></i> <strong>Total de reproduções:</strong> <?= number_format($musica['reproducoes'], 0, ',', '.') ?></li>
                <li>
                    <i class="bi bi-check-circle"></i> <strong>Status:</strong>
                    <?php if ($musica['ativa']): ?>
                        <span class="badge bg-success">Ativa</span>
                    <?php else: ?>
                        <span class="badge bg-danger">Inativa</span>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>