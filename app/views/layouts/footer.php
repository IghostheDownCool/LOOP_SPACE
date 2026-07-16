        </main>

    </div>

</div>

<div id="global-player" class="global-player">

    <div class="player-left">

        <img
            id="gp-capa"
            src=""
            alt="Capa"
        >

        <div>

            <h6 id="gp-titulo">
                Nenhuma música selecionada
            </h6>

            <small id="gp-artista">
                —
            </small>

        </div>

    </div>

    <div class="player-center">

        <audio id="player"></audio>

        <div class="player-controls">

            <button id="btn-prev" class="btn btn-cinza">
                <i class="bi bi-skip-start-fill"></i>
            </button>

            <button id="btn-play" class="btn btn-verde">
                <i class="bi bi-play-fill"></i>
            </button>

            <button id="btn-next" class="btn btn-cinza">
                <i class="bi bi-skip-end-fill"></i>
            </button>

        </div>

        <div class="player-progress">

    <span id="tempo-atual">
        0:00
    </span>

    <input
        type="range"
        id="barra-progresso"
        value="0"
        min="0"
        max="100"
    >

    <span id="tempo-total">
        0:00
    </span>

</div>

    </div>

    <div class="player-right">

    <i class="bi bi-volume-up-fill"></i>

    <input
        type="range"
        id="volume"
        min="0"
        max="100"
        value="100"
    >

</div>

</div>

<script src="<?= BASE_URL ?>/assets/js/player.js?v=<?= filemtime(__DIR__ . '/../../../public/assets/js/player.js') ?>"></script>

<script src="<?= BASE_URL ?>/assets/js/controls.js?v=<?= filemtime(__DIR__ . '/../../../public/assets/js/controls.js') ?>"></script>

<script src="<?= BASE_URL ?>/assets/js/progress.js?v=<?= filemtime(__DIR__ . '/../../../public/assets/js/progress.js') ?>"></script>

<script src="<?= BASE_URL ?>/assets/js/volume.js?v=<?= filemtime(__DIR__ . '/../../../public/assets/js/volume.js') ?>"></script>

<script src="<?= BASE_URL ?>/assets/js/playlist.js?v=<?= filemtime(__DIR__ . '/../../../public/assets/js/playlist.js') ?>"></script>

<script src="<?= BASE_URL ?>/assets/js/search.js?v=<?= filemtime(__DIR__ . '/../../../public/assets/js/search.js') ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>