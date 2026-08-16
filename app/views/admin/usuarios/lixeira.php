<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1>Lixeira - Usuários</h1>
        <p class="text-muted">Usuários excluídos recentemente</p>
    </div>
    <a href="<?= BASE_URL ?>/admin/usuarios" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<?php if (empty($usuarios)): ?>
    <div class="alert alert-secondary">
        Nenhum usuário na lixeira.
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Excluído em</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= $usuario['id'] ?></td>
                        <td><?= htmlspecialchars($usuario['nome']) ?></td>
                        <td><?= htmlspecialchars($usuario['email']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($usuario['deleted_at'])) ?></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="<?= BASE_URL ?>/admin/usuarios/restaurar/<?= $usuario['id'] ?>" class="btn btn-sm btn-success" title="Restaurar">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                </a>
                                <a href="<?= BASE_URL ?>/admin/usuarios/excluir-permanente/<?= $usuario['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir permanentemente?')" title="Excluir permanentemente">
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