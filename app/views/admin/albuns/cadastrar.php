<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<h1>Cadastrar Álbum</h1>

<form method="POST">

    <label>Título</label>

    <br><br>

    <input
        type="text"
        name="titulo"
        required
    >

    <br><br>

    <label>Artista</label>

    <br><br>

    <select
        name="artista_id"
        required
    >

        <option value="">Selecione um artista</option>

        <?php foreach ($artistas as $artista): ?>

            <option value="<?= $artista['id'] ?>">

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
        min="1900"
        max="<?= date('Y') + 1 ?>"
        required
    >

    <br><br>

    <button type="submit">

        Salvar

    </button>

</form>

<br>

<a href="<?= BASE_URL ?>/admin/albuns">

    Voltar

</a>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>