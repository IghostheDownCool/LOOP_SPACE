<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1><?= htmlspecialchars($album['titulo']) ?></h1>
        <p class="text-muted">Detalhes do álbum</p>
    </div>
    <div>
        <a href="<?= BASE_URL ?>/admin/albuns/editar/<?= $album['id'] ?>" class="btn btn-secondary">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <a href="<?= BASE_URL ?>/admin/albuns" class="btn btn-cinza">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card bg-dark">
            <div class="card-body text-center">
                <?php if (!empty($album['capa'])): ?>
                    <img
                        src="<?= BASE_URL ?>/uploads/capas/<?= htmlspecialchars($album['capa']) ?>"
                        alt="<?= htmlspecialchars($album['titulo']) ?>"
                        class="img-fluid"
                        style="max-width: 200px; border-radius: 8px;"
                    >
                <?php else: ?>
                    <div class="bg-secondary p-5 rounded" style="max-width: 200px; margin: 0 auto;">
                        <i class="bi bi-disc" style="font-size: 4rem; color: #888;"></i>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card bg-dark">
            <div class="card-body">
                <h5 class="card-title">Informações</h5>
                <table class="table table-dark table-borderless">
                    <tr>
                        <th style="width: 120px;">Título</th>
                        <td><?= htmlspecialchars($album['titulo']) ?></td>
                    </tr>
                    <tr>
                        <th>Artista</th>
                        <td>
                            <a href="<?= BASE_URL ?>/admin/artistas/editar/<?= $album['artista_id'] ?>" class="text-light">
                                <?= htmlspecialchars($album['artista_nome'] ?? '') ?>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Ano</th>
                        <td><?= $album['ano'] ?? 'Não informado' ?></td>
                    </tr>
                    <tr>
                        <th>Total de Músicas</th>
                        <td><?= count($musicas ?? []) ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <?php if (!empty($musicas)): ?>
            <div class="card bg-dark mt-3">
                <div class="card-body">
                    <h5 class="card-title">Músicas do Álbum</h5>
                    <div class="table-responsive">
                        <table class="table table-dark table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Título</th>
                                    <th>Duração</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($musicas as $musica): ?>
                                    <tr>
                                        <td><?= $musica['numero_faixa'] ?? '-' ?></td>
                                        <td><?= htmlspecialchars($musica['titulo']) ?></td>
                                        <td><?= $musica['duracao'] ? gmdate('i:s', $musica['duracao']) : '-' ?></td>
                                        <td>
                                            <a href="<?= BASE_URL ?>/admin/musicas/editar/<?= $musica['id'] ?>" class="btn btn-sm btn-secondary">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-secondary mt-3">
                Este álbum ainda não possui músicas cadastradas.
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>