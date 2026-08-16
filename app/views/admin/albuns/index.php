<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1>Álbuns</h1>
        <p class="text-muted">Visualize e gerencie os álbuns cadastrados</p>
    </div>
</div>

<?php if (empty($albuns)): ?>
    <div class="alert alert-secondary">
        Nenhum álbum cadastrado.
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Capa</th>
                    <th>Título</th>
                    <th>Artista</th>
                    <th>Ano</th>
                    <th>Músicas</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($albuns as $album): ?>
                    <tr>
                        <td><?= $album['id'] ?></td>
                        <td>
                            <?php if (!empty($album['capa'])): ?>
                                <img
                                    src="<?= BASE_URL ?>/uploads/capas/<?= htmlspecialchars($album['capa']) ?>"
                                    alt="<?= htmlspecialchars($album['titulo']) ?>"
                                    style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;"
                                >
                            <?php else: ?>
                                <div style="width: 40px; height: 40px; border-radius: 4px; background: var(--bg-secondary); display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-collection-play" style="color: var(--text-muted);"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>/album/ver/<?= $album['id'] ?>" class="text-decoration-none" target="_blank">
                                <?= htmlspecialchars($album['titulo']) ?>
                                <i class="bi bi-box-arrow-up-right" style="font-size: 0.7rem;"></i>
                            </a>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>/artista/ver/<?= $album['artista_id'] ?>" class="text-decoration-none" target="_blank">
                                <?= htmlspecialchars($album['artista'] ?? '') ?>
                                <i class="bi bi-box-arrow-up-right" style="font-size: 0.7rem;"></i>
                            </a>
                        </td>
                        <td><?= $album['ano'] ?? '-' ?></td>
                        <td>
                            <?php
                            $albumModel = new Album();
                            $musicas = $albumModel->listarMusicas($album['id']);
                            echo count($musicas);
                            ?>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="<?= BASE_URL ?>/album/ver/<?= $album['id'] ?>" class="btn btn-sm btn-info" target="_blank" title="Ver álbum">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a
                                    href="<?= BASE_URL ?>/admin/albuns/excluir/<?= $album['id'] ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Deseja realmente excluir este álbum? Todas as músicas também serão excluídas.')"
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