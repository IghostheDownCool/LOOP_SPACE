<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<h1>Músicas</h1>

<p>
    <a href="<?= BASE_URL ?>/admin/musicas/cadastrar">
        Nova Música
    </a>
</p>

<p>
    <a href="<?= BASE_URL ?>/admin">
        Voltar ao Painel
    </a>
</p>

<?php if (empty($musicas)): ?>

    <p>Nenhuma música cadastrada.</p>

<?php else: ?>

<table border="1" cellpadding="8" cellspacing="0">

    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Artista</th>
        <th>Álbum</th>
        <th>Faixa</th>
        <th>Duração (s)</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($musicas as $musica): ?>

        <tr>

            <td><?= $musica['id'] ?></td>

            <td><?= htmlspecialchars($musica['titulo']) ?></td>

            <td><?= htmlspecialchars($musica['artista']) ?></td>

            <td><?= htmlspecialchars($musica['album']) ?></td>

            <td><?= $musica['numero_faixa'] ?></td>

            <td><?= $musica['duracao'] ?></td>

            <td>

                <a href="<?= BASE_URL ?>/admin/musicas/editar/<?= $musica['id'] ?>">
                    Editar
                </a>

                |

                <a
                    href="<?= BASE_URL ?>/admin/musicas/excluir/<?= $musica['id'] ?>"
                    onclick="return confirm('Deseja realmente excluir esta música?');"
                >
                    Excluir
                </a>

            </td>

        </tr>

    <?php endforeach; ?>

</table>

<?php endif; ?>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>