<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<input type="hidden" name="token" value="<?= $playlist['token'] ?? '' ?>">

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
        <div class="mb-3">
    <label>
            <input
                type="checkbox"
                name="publica"
                <?= $playlist['publica'] ? 'checked' : '' ?>
            >

            Pública
        </label>
</div>
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