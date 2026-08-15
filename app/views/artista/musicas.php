<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Minhas Músicas</h1>
    <a href="<?= BASE_URL ?>/artista/upload" class="btn btn-primary">
        <i class="bi bi-cloud-arrow-up"></i> Nova Música
    </a>
</div>

<?php if (empty($musicas)): ?>
    <div class="alert alert-secondary">
        <p class="mb-0">Você ainda não tem músicas cadastradas. <a href="<?= BASE_URL ?>/artista/upload" class="text-primary">Envie sua primeira música</a></p>
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Título</th>
                    <th>Álbum</th>
                    <th>Gênero</th>
                    <th>Duração</th>
                    <th>Plays</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($musicas as $index => $musica): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><strong><?= htmlspecialchars($musica['titulo']) ?></strong></td>
                        <td><?= htmlspecialchars($musica['album'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($musica['genero'] ?? '-') ?></td>
                        <td><?= gmdate('i:s', $musica['duracao']) ?></td>
                        <td><?= number_format($musica['reproducoes'], 0, ',', '.') ?></td>
                        <td>
                            <?php if ($musica['ativa']): ?>
                                <span class="badge bg-success">Ativa</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Inativa</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>/artista/toggle-musica/<?= $musica['id'] ?>" class="btn btn-sm btn-warning" title="Ativar/Desativar">
                                <i class="bi bi-arrow-repeat"></i>
                            </a>
                            <a href="<?= BASE_URL ?>/artista/excluir-musica/<?= $musica['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta música?')" title="Excluir">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>