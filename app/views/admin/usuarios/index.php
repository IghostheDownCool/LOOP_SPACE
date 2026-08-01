<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="admin-header">
    <div>
        <h1><i class="bi bi-people"></i> Usuários</h1>
        <p class="subtitle">Gerencie os usuários do sistema</p>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-dark table-hover align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Role</th>
                <th>Cadastro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= $usuario['id'] ?></td>
                    <td><?= htmlspecialchars($usuario['nome']) ?></td>
                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                    <td>
                        <?php if ($usuario['role'] === 'admin'): ?>
                            <span class="badge bg-success">Admin</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">User</span>
                        <?php endif; ?>
                    </td>
                    <td><?= date('d/m/Y', strtotime($usuario['data_cadastro'])) ?></td>
                    <td>
                        <div class="btn-group">
                            <?php if ($usuario['role'] !== 'admin'): ?>
                                <a href="<?= BASE_URL ?>/admin/usuarios/definirAdmin/<?= $usuario['id'] ?>" class="btn btn-sm btn-success">
                                    <i class="bi bi-star"></i> Admin
                                </a>
                            <?php else: ?>
                                <a href="<?= BASE_URL ?>/admin/usuarios/removerAdmin/<?= $usuario['id'] ?>" class="btn btn-sm btn-warning" onclick="return confirm('Remover admin deste usuário?')">
                                    <i class="bi bi-star-slash"></i> Remover
                                </a>
                            <?php endif; ?>
                            <a href="<?= BASE_URL ?>/admin/usuarios/excluir/<?= $usuario['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir este usuário?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>