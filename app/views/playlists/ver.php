<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1><?= htmlspecialchars($playlist['nome']) ?></h1>
        <p class="text-muted">
            <?php if ($playlist['publica']): ?>
                <span class="badge bg-success">Pública</span>
            <?php else: ?>
                <span class="badge bg-secondary">Privada</span>
            <?php endif; ?>
        </p>
    </div>
    <div class="d-flex gap-2">
        <?php if (!empty($playlist['token']) && $playlist['publica']): ?>
            <button class="btn btn-verde" onclick="copiarLink()">
                <i class="bi bi-share"></i> Compartilhar
            </button>
        <?php endif; ?>
        <a href="<?= BASE_URL ?>/playlists/editar/<?= $playlist['id'] ?>" class="btn btn-secondary">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <a href="<?= BASE_URL ?>/playlists" class="btn btn-cinza">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>
</div>

<hr>

<h2>Adicionar Música</h2>
<form method="POST" action="<?= BASE_URL ?>/playlists/adicionarMusica/<?= $playlist['id'] ?>" class="row g-3 mb-4">
    <div class="col-md-8">
        <select name="musica_id" class="form-control" required>
            <option value="">Selecione uma música</option>
            <?php foreach ($todasMusicas as $musica): ?>
                <?php if (in_array($musica['id'], $idsMusicas)) continue; ?>
                <option value="<?= $musica['id'] ?>">
                    <?= htmlspecialchars($musica['artista']) ?> — <?= htmlspecialchars($musica['titulo']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-4">
        <button type="submit" class="btn btn-verde w-100">
            <i class="bi bi-plus-circle"></i> Adicionar
        </button>
    </div>
</form>

<hr>

<h2>Músicas</h2>
<?php if (empty($musicas)): ?>
    <div class="alert alert-secondary">Esta playlist ainda não possui músicas.</div>
<?php else: ?>
    <div class="list-group">
        <?php foreach ($musicas as $musica): ?>
            <div class="list-group-item bg-dark text-light d-flex justify-content-between align-items-center">
                <div>
                    <strong><?= htmlspecialchars($musica['titulo']) ?></strong>
                    <br>
                    <small class="text-muted">
                        <?= htmlspecialchars($musica['artista']) ?>
                        •
                        <?= htmlspecialchars($musica['album']) ?>
                    </small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-secondary"><?= gmdate('i:s', $musica['duracao'] ?? 0) ?></span>
                    <a
                        href="<?= BASE_URL ?>/playlists/removerMusica/<?= $playlist['id'] ?>/<?= $musica['id'] ?>"
                        class="btn btn-sm btn-danger"
                        onclick="return confirm('Deseja remover esta música da playlist?')"
                    >
                        <i class="bi bi-trash"></i>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<script>
    function copiarLink() {
        const link = '<?= BASE_URL ?>/playlists/publica/<?= $playlist['token'] ?>';
        navigator.clipboard.writeText(link).then(() => {
            alert('Link copiado para a área de transferência!');
        }).catch(() => {
            // Fallback para navegadores mais antigos
            const textarea = document.createElement('textarea');
            textarea.value = link;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            alert('Link copiado para a área de transferência!');
        });
    }
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>