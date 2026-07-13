<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<h1>Editar Álbum</h1>

<form method="POST">

    <input
        type="hidden"
        name="id"
        value="<?= $album['id'] ?>"
    >

    <label>Título</label>

    <br><br>

    <input
        type="text"
        name="titulo"
        value="<?= htmlspecialchars($album['titulo']) ?>"
        required
    >

    <br><br>

    <label>Artista</label>

    <br><br>

    <select
        name="artista_id"
        required
    >

        <?php foreach ($artistas as $artista): ?>

            <option
                value="<?= $artista['id'] ?>"
                <?= $artista['id'] == $album['artista_id'] ? 'selected' : '' ?>
            >

                <?= htmlspecialchars($artista['nome']) ?>

            </option>

        <?php endforeach; ?>

    </select>

    <br><br>

    <label>Ano</label>

    <br><br>

    <input
        type="number"
        name="ano"
        value="<?= $album['ano'] ?>"
        min="1900"
        max="<?= date('Y') + 1 ?>"
        required
    >

    <br><br>

    <button type="submit">
        Salvar Alterações
    </button>

</form>

<br>

<a href="<?= BASE_URL ?>/admin/albuns">
    Voltar
</a>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>