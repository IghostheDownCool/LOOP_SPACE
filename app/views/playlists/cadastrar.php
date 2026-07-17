<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1>Nova Playlist</h1>

<form method="POST">

    <p>

        <label>Nome</label>

        <br>

        <input
            type="text"
            name="nome"
            required
        >

    </p>

<div class="mb-3 form-check">
    <input
        type="checkbox"
        class="form-check-input"
        id="publica"
        name="publica"
        value="1"
    >
    <label class="form-check-label" for="publica">
        Playlist pública (qualquer pessoa pode visualizar)
    </label>
</div>

    <p>

        <label>

            <input
                type="checkbox"
                name="publica"
            >

            Playlist pública

        </label>

    </p>

    <p>

        <button type="submit">
            Salvar
        </button>

    </p>

</form>

<p>

    <a href="<?= BASE_URL ?>/playlists">

        Voltar

    </a>

</p>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>