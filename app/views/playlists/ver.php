<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1><?= htmlspecialchars($playlist['nome']) ?></h1>

<p>

<strong>Pública:</strong>

<?= $playlist['publica'] ? 'Sim' : 'Não' ?>

</p>

<hr>

<h2>Adicionar Música</h2>

<form method="POST" action="<?= BASE_URL ?>/playlists/adicionarMusica/<?= $playlist['id'] ?>">

    <select
        name="musica_id"
        required
    >

        <option value="">
            Selecione uma música
        </option>

        <?php foreach ($todasMusicas as $musica): ?>

            <?php if (in_array($musica['id'], $idsMusicas)) continue; ?>

            <option value="<?= $musica['id'] ?>">

                <?= htmlspecialchars($musica['artista']) ?>

                —

                <?= htmlspecialchars($musica['titulo']) ?>

            </option>

        <?php endforeach; ?>

    </select>

    <button type="submit">

        Adicionar

    </button>

</form>

<hr>

<h2>Músicas</h2>

<?php if (empty($musicas)): ?>

    <p>Esta playlist ainda não possui músicas.</p>

<?php else: ?>

<ul>

<?php foreach ($musicas as $musica): ?>

    <li>

        <strong>

            <?= htmlspecialchars($musica['titulo']) ?>

        </strong>

        -

        <?= htmlspecialchars($musica['artista']) ?>

        <a
            href="<?= BASE_URL ?>/playlists/removerMusica/<?= $playlist['id'] ?>/<?= $musica['id'] ?>"
            onclick="return confirm('Deseja remover esta música da playlist?')"
            style="margin-left:15px; color:red;"
        >
            Remover
        </a>

    </li>

<?php endforeach; ?>

</ul>

<?php endif; ?>

<p>

<a href="<?= BASE_URL ?>/playlists">

Voltar

</a>

</p>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>