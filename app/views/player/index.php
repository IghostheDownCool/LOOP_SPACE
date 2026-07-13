<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1>Player de Música</h1>

<?php if (empty($musicas)): ?>

    <p>Nenhuma música cadastrada.</p>

<?php else: ?>

<div style="display:flex; gap:40px;">

    <div style="width:300px;">

        <h3>Músicas</h3>

        <ul style="list-style:none; padding:0;">

            <?php foreach ($musicas as $musica): ?>

                <li style="margin-bottom:10px;">

                    <button
                        onclick="tocarMusica(
                            '<?= BASE_URL ?>/uploads/musicas/<?= htmlspecialchars($musica['arquivo']) ?>',
                            '<?= htmlspecialchars($musica['titulo'], ENT_QUOTES) ?>',
                            '<?= htmlspecialchars($musica['artista'], ENT_QUOTES) ?>',
                            '<?= htmlspecialchars($musica['album'], ENT_QUOTES) ?>',
                            '<?= BASE_URL ?>/uploads/capas/<?= htmlspecialchars($musica['capa']) ?>'
                        )"
                    >

                        ▶ <?= htmlspecialchars($musica['titulo']) ?>

                    </button>

                </li>

            <?php endforeach; ?>

        </ul>

    </div>

    <div>

        <img
            id="capa"
            src=""
            width="250"
            style="display:none;"
        >

        <h2 id="titulo">Escolha uma música</h2>

        <p id="artista"></p>

        <p id="album"></p>

        <audio
            id="player"
            controls
            style="width:500px;"
        >

        </audio>

    </div>

</div>

<script>

function tocarMusica(audio, titulo, artista, album, capa)
{
    const player = document.getElementById('player');

    player.src = audio;

    player.play();

    document.getElementById('titulo').innerText = titulo;

    document.getElementById('artista').innerText =
        'Artista: ' + artista;

    document.getElementById('album').innerText =
        'Álbum: ' + album;

    const img = document.getElementById('capa');

    img.src = capa;

    img.style.display = 'block';
}

</script>

<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>