<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<h1>Editar Artista</h1>

<form method="POST">

    <input
        type="hidden"
        name="id"
        value="<?= $artista['id'] ?>"
    >

    <label>Nome</label>

    <br><br>

    <input
        type="text"
        name="nome"
        value="<?= htmlspecialchars($artista['nome']) ?>"
        required
    >

    <br><br>

    <button type="submit">
        Salvar Alterações
    </button>

</form>

<br>

<a href="<?= BASE_URL ?>/admin/artistas">
    Voltar
</a>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>