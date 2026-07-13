<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<h1>Editar Música</h1>

<form method="POST">

    <input
        type="hidden"
        name="id"
        value="<?= $musica['id'] ?>"
    >

    <label>Título</label>

    <br><br>

    <input
        type="text"
        name="titulo"
        value="<?= htmlspecialchars($musica['titulo']) ?>"
        required
    >

    <br><br>

    <label>Álbum</label>

    <br><br>

    <select
        name="album_id"
        required
    >

        <?php foreach ($albuns as $album): ?>

            <option
                value="<?= $album['id'] ?>"
                <?= $album['id'] == $musica['album_id'] ? 'selected' : '' ?>
            >
                <?= htmlspecialchars($album['titulo']) ?>
            </option>

        <?php endforeach; ?>

    </select>

    <br><br>

    <label>Número da Faixa</label>

    <br><br>

    <input
        type="number"
        name="numero_faixa"
        value="<?= $musica['numero_faixa'] ?>"
        min="1"
        required
    >

    <br><br>

    <label>Duração (em segundos)</label>

    <br><br>

    <input
        type="number"
        name="duracao"
        value="<?= $musica['duracao'] ?>"
        min="1"
        required
    >

    <br><br>

    <button type="submit">
        Salvar Alterações
    </button>

</form>

<br>

<a href="<?= BASE_URL ?>/admin/musicas">
    Voltar
</a>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>