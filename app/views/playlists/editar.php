<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1>Editar Playlist</h1>

<form method="POST">

    <p>
        <label>Nome:</label>
    </p>

    <input
        type="text"
        name="nome"
        value="<?= htmlspecialchars($playlist['nome']) ?>"
        required
    >


    <p>
        <label>
            <input
                type="checkbox"
                name="publica"
                <?= $playlist['publica'] ? 'checked' : '' ?>
            >

            Pública
        </label>
    </p>


    <button
        type="submit"
        class="btn btn-verde"
    >
        Salvar
    </button>


    <a
        href="<?= BASE_URL ?>/playlists"
        class="btn btn-cinza"
    >
        Cancelar
    </a>

</form>


<?php require_once __DIR__ . '/../layouts/footer.php'; ?>