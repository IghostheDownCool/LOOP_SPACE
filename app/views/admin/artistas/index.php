<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1>Artistas</h1>
        <p class="text-muted">Visualize e gerencie os artistas cadastrados</p>
    </div>
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
                    <th>Músicas</th>
                    <th>Seguidores</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($artistas as $artista): ?>
                    <tr>
                        <td><?= $artista['id'] ?></td>
                        <td>
                            <?php if (!empty($artista['foto'])): ?>
                                <img
                                    src="<?= BASE_URL ?>/uploads/artistas/<?= htmlspecialchars($artista['foto']) ?>"
                                    alt="<?= htmlspecialchars($artista['nome']) ?>"
                                    style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;"
                                >
                            <?php else: ?>
                                <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--bg-secondary); display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-person" style="color: var(--text-muted);"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>/artista/ver/<?= $artista['id'] ?>" class="text-decoration-none" target="_blank">
                                <?= htmlspecialchars($artista['nome']) ?>
                                <i class="bi bi-box-arrow-up-right" style="font-size: 0.7rem;"></i>
                            </a>
                        </td>
                        <td>
                            <?php
                            $musicaModel = new Musica();
                            $totalMusicas = $musicaModel->contarPorArtista($artista['id']);
                            echo $totalMusicas;
                            ?>
                        </td>
                        <td>
                            <?php
                            $artistaModel = new Artista();
                            $seguidores = $artistaModel->listarSeguidores($artista['id']);
                            echo count($seguidores);
                            ?>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="<?= BASE_URL ?>/artista/ver/<?= $artista['id'] ?>" class="btn btn-sm btn-info" target="_blank" title="Ver perfil">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a
                                    href="<?= BASE_URL ?>/admin/artistas/excluir/<?= $artista['id'] ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Deseja realmente excluir este artista? Todas as músicas e álbuns também serão excluídos.')"
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