<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1>Músicas</h1>
        <p class="text-muted">Visualize e gerencie as músicas cadastradas</p>
    </div>
</div>

<?php if (empty($musicas)): ?>
    <div class="alert alert-secondary">
        Nenhuma música cadastrada.
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Artista</th>
                    <th>Álbum</th>
                    <th>Faixa</th>
                    <th>Duração</th>
                    <th>Plays</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($musicas as $musica): ?>
                    <tr>
                        <td><?= $musica['id'] ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>/player" class="text-decoration-none" target="_blank">
                                <?= htmlspecialchars($musica['titulo']) ?>
                                <i class="bi bi-box-arrow-up-right" style="font-size: 0.7rem;"></i>
                            </a>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>/artista/ver/<?= $musica['artista_id'] ?>" class="text-decoration-none" target="_blank">
                                <?= htmlspecialchars($musica['artista']) ?>
                                <i class="bi bi-box-arrow-up-right" style="font-size: 0.7rem;"></i>
                            </a>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>/album/ver/<?= $musica['album_id'] ?>" class="text-decoration-none" target="_blank">
                                <?= htmlspecialchars($musica['album']) ?>
                                <i class="bi bi-box-arrow-up-right" style="font-size: 0.7rem;"></i>
                            </a>
                        </td>
                        <td><?= $musica['numero_faixa'] ?? '-' ?></td>
                        <td><?= gmdate('i:s', $musica['duracao']) ?></td>
                        <td><?= number_format($musica['reproducoes'] ?? 0, 0, ',', '.') ?></td>
                        <td>
                            <?php if ($musica['ativa']): ?>
                                <span class="badge bg-success">Ativa</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Inativa</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <?php if ($musica['ativa']): ?>
                                    <a href="<?= BASE_URL ?>/admin/musicas/desativar/<?= $musica['id'] ?>" class="btn btn-sm btn-warning" title="Desativar">
                                        <i class="bi bi-eye-slash"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="<?= BASE_URL ?>/admin/musicas/ativar/<?= $musica['id'] ?>" class="btn btn-sm btn-success" title="Ativar">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                <?php endif; ?>
                                <a
                                    href="<?= BASE_URL ?>/admin/musicas/excluir/<?= $musica['id'] ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Deseja realmente excluir esta música?')"
                                    title="Excluir"
                                >
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>