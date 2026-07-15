<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1>Minhas Playlists</h1>

<p>
    <a href="<?= BASE_URL ?>/playlists/cadastrar">
        Nova Playlist
    </a>
</p>

<?php if (empty($playlists)): ?>

    <p>Você ainda não criou nenhuma playlist.</p>

<?php else: ?>

<table border="1" cellpadding="8">

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

    <a href="<?= BASE_URL ?>/playlists/ver/<?= $playlist['id'] ?>">
        Ver músicas
    </a>

    |

    <a href="<?= BASE_URL ?>/playlists/editar/<?= $playlist['id'] ?>">
        Editar
    </a>

    |

    <a
        href="<?= BASE_URL ?>/playlists/excluir/<?= $playlist['id'] ?>"
        onclick="return confirm('Deseja realmente excluir esta playlist?')"
    >
        Excluir
    </a>

</td>

        </tr>

    <?php endforeach; ?>

</table>

<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>