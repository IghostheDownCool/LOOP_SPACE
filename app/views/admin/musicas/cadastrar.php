<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<h1>Cadastrar Música</h1>

<form method="POST" enctype="multipart/form-data">

    <label>Título</label>

    <br><br>

    <input
        type="text"
        name="titulo"
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

            <option value="<?= $album['id'] ?>">

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
        min="1"
        required
    >

    <br><br>

    <label>Duração (em segundos)</label>

    <br><br>

    <input
        type="number"
        name="duracao"
        min="1"
        required
    >

    <br><br>
    <label>Arquivo MP3</label>

<br><br>

<input
    type="file"
    name="arquivo"
    accept=".mp3,audio/mpeg"
    required
>

<br><br>

    <button type="submit">
        Salvar
    </button>

</form>

<br>

<a href="<?= BASE_URL ?>/admin/musicas">
    Voltar
</a>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>