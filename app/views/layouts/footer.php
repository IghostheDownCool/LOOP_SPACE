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

    </div>

    <div class="player-right">

        🔊 Volume

    </div>

</div>

<script src="<?= BASE_URL ?>/assets/js/player.js?v=<?= filemtime(__DIR__ . '/../../../public/assets/js/player.js') ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>