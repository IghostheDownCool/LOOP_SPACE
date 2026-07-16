<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php

$curtidaModel = new Curtida();

?>

<h1>Player de Música</h1>

<?php if (empty($musicas)): ?>

    <p>Nenhuma música cadastrada.</p>

<?php else: ?>

<div class="player-container">

    <div class="player-playlist">

        <h3>Músicas</h3>

        <input
            type="text"
            id="busca"
            placeholder="🔍 Buscar música..."
        >

        <ul>

            <?php foreach ($musicas as $musica): ?>

                <li>

                    <button
                        class="musica-item"
                        data-search="<?= strtolower(
                            $musica['titulo'] . ' ' .
                            $musica['artista'] . ' ' .
                            $musica['album']
                        ) ?>"
                        onclick="tocarMusica(
                            this,
                            <?= $musica['id'] ?>,
                            '<?= BASE_URL ?>/uploads/musicas/<?= htmlspecialchars($musica['arquivo'], ENT_QUOTES) ?>',
                            '<?= htmlspecialchars($musica['titulo'], ENT_QUOTES) ?>',
                            '<?= htmlspecialchars($musica['artista'], ENT_QUOTES) ?>',
                            '<?= htmlspecialchars($musica['album'], ENT_QUOTES) ?>',
                            '<?= BASE_URL ?>/uploads/capas/<?= htmlspecialchars($musica['capa'], ENT_QUOTES) ?>'
                        )"
                    >

                        <div class="musica-topo">

    <strong>
        ▶ <?= htmlspecialchars($musica['titulo']) ?>
    </strong>

    <?php if ($curtidaModel->usuarioCurtiu($_SESSION['usuario_id'], $musica['id'])): ?>

        <a
            href="<?= BASE_URL ?>/curtidas/descurtir/<?= $musica['id'] ?>"
            class="favorito"
            title="Descurtir"
        >
            ❤️
        </a>

    <?php else: ?>

        <a
            href="<?= BASE_URL ?>/curtidas/curtir/<?= $musica['id'] ?>"
            class="favorito"
            title="Curtir"
        >
            🤍
        </a>

    <?php endif; ?>

</div>

<span>
    <?= htmlspecialchars($musica['artista']) ?>
</span>

                    </button>

                </li>

            <?php endforeach; ?>

        </ul>

    </div>

</div>

<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

<script>
    const idsMusicas = <?= json_encode(array_column($musicas, 'id')) ?>;
    definirFila(idsMusicas);
</script>


