<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1>Cadastrar Artista</h1>

<form method="POST">

    <label>Nome</label>

    <br><br>

    <input
        type="text"
        name="nome"
        required
    >

    <br><br>

    <button type="submit">

        Salvar

    </button>

</form>

<br>

<a href="<?= BASE_URL ?>/artistas">

    Voltar

</a>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>