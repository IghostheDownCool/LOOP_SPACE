<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php

$titulo = '📂 Minhas Playlists';

$subtitulo = 'Crie e organize suas playlists.';

require __DIR__ . '/../components/page-header.php';

?>

<div class="mb-4">

    <a
        href="<?= BASE_URL ?>/playlists/cadastrar"
        class="btn btn-success"
    >
        <i class="bi bi-plus-circle"></i>
        Nova Playlist
    </a>

</div>

<?php if (empty($playlists)): ?>

    <p>Você ainda não criou nenhuma playlist.</p>

<?php else: ?>

<div class="table-responsive">

    <table class="table table-dark table-hover align-middle">

    <tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Pública</th>
    <th>Ações</th>
</tr>

    <?php foreach ($playlists as $playlist): ?>

        <tr>

            <td><?= $playlist['id'] ?></td>

            <td><?= htmlspecialchars($playlist['nome']) ?></td>

            <td>

                <?= $playlist['publica'] ? 'Sim' : 'Não' ?>

            </td>

            <td>

    <a
    href="<?= BASE_URL ?>/playlists/ver/<?= $playlist['id'] ?>"
    class="btn btn-primary"
>
    Ver
</a>

<a
    href="<?= BASE_URL ?>/playlists/editar/<?= $playlist['id'] ?>"
    class="btn btn-secondary"
>
    Editar
</a>

<a
    href="<?= BASE_URL ?>/playlists/excluir/<?= $playlist['id'] ?>"
    class="btn btn-danger"
    onclick="return confirm('Deseja realmente excluir esta playlist?')"
>
    Excluir
</a>

</td>

        </tr>

    <?php endforeach; ?>

</table>
    </div>

<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>