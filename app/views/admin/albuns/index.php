<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1>Álbuns</h1>
        <p class="text-muted">Gerencie os álbuns cadastrados</p>
    </div>
    <a href="<?= BASE_URL ?>/admin/albuns/cadastrar" class="btn btn-verde">
        <i class="bi bi-plus-circle"></i> Novo Álbum
    </a>
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
                                <span class="text-muted">Sem capa</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($album['titulo']) ?></td>
                        <td><?= htmlspecialchars($album['artista_nome'] ?? '') ?></td>
                        <td><?= $album['ano'] ?? '' ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= BASE_URL ?>/admin/albuns/editar/<?= $album['id'] ?>" class="btn btn-sm btn-secondary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a
                                    href="<?= BASE_URL ?>/admin/albuns/excluir/<?= $album['id'] ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Deseja realmente excluir este álbum?')"
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