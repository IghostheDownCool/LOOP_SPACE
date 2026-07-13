<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<h1>Álbuns</h1>

<p>
    <a href="<?= BASE_URL ?>/admin">
        Voltar ao Painel
    </a>
</p>

<?php if (empty($albuns)): ?>

    <p>Nenhum álbum cadastrado.</p>

<?php else: ?>

<table border="1" cellpadding="8">

    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Artista</th>
        <th>Ano</th>
    </tr>

    <?php foreach ($albuns as $album): ?>

        <tr>

            <td><?= $album['id'] ?></td>

            <td><?= htmlspecialchars($album['titulo']) ?></td>

            <td><?= htmlspecialchars($album['artista']) ?></td>

            <td><?= $album['ano'] ?></td>

        </tr>

    <?php endforeach; ?>

</table>

<?php endif; ?>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>