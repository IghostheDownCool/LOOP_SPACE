<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1>🏆 Top Músicas</h1>

<?php if (empty($musicas)): ?>

    <p>Nenhuma reprodução registrada.</p>

<?php else: ?>

<table>

    <tr>

        <th>#</th>

        <th>Música</th>

        <th>Artista</th>

        <th>Álbum</th>

        <th>Reproduções</th>

    </tr>

    <?php foreach ($musicas as $indice => $musica): ?>

        <tr>

            <td><?= $indice + 1 ?></td>

            <td><?= htmlspecialchars($musica['titulo']) ?></td>

            <td><?= htmlspecialchars($musica['artista']) ?></td>

            <td><?= htmlspecialchars($musica['album']) ?></td>

            <td><?= $musica['reproducoes'] ?></td>

        </tr>

    <?php endforeach; ?>

</table>

<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>