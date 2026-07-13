<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1>Artistas</h1>

<p>
    <a href="<?= BASE_URL ?>/artistas/cadastrar">
        Novo Artista
    </a>
</p>

<?php if (empty($artistas)): ?>

    <p>Nenhum artista cadastrado.</p>

<?php else: ?>

<table border="1" cellpadding="8" cellspacing="0">

    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($artistas as $artista): ?>

        <tr>

            <td><?= $artista['id'] ?></td>

            <td><?= htmlspecialchars($artista['nome']) ?></td>

            <td>

                Editar |
                Excluir

            </td>

        </tr>

    <?php endforeach; ?>

</table>

<?php endif; ?>

<br>

<a href="<?= BASE_URL ?>">

    Voltar para Home

</a>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>