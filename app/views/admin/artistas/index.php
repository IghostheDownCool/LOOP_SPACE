<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1>Artistas</h1>
        <p class="text-muted">Gerencie os artistas cadastrados</p>
    </div>
    <a href="<?= BASE_URL ?>/admin/artistas/cadastrar" class="btn btn-verde">
        <i class="bi bi-plus-circle"></i> Novo Artista
    </a>
</div>

<?php if (empty($artistas)): ?>
    <div class="alert alert-secondary">
        Nenhum artista cadastrado.
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($artistas as $artista): ?>
                    <tr>
                        <td><?= $artista['id'] ?></td>
                        <td>
                            <?php if ($artista['foto']): ?>
                                <img
                                    src="<?= BASE_URL ?>/uploads/artistas/<?= htmlspecialchars($artista['foto']) ?>"
                                    alt="<?= htmlspecialchars($artista['nome']) ?>"
                                    style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;"
                                >
                            <?php else: ?>
                                <span class="text-muted">Sem foto</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($artista['nome']) ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= BASE_URL ?>/admin/artistas/editar/<?= $artista['id'] ?>" class="btn btn-sm btn-secondary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a
                                    href="<?= BASE_URL ?>/admin/artistas/excluir/<?= $artista['id'] ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Deseja realmente excluir este artista?')"
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