        </div>


        <aside class="col-12 col-md-3 col-lg-2 sidebar">

            <?php
            $usuarioModel = new Usuario();
            if (isset($_SESSION['usuario_id']) && !empty($_SESSION['usuario_id'])) {
                $usuario = $usuarioModel->buscarPorId($_SESSION['usuario_id']);
                if (!$usuario) {
                    session_unset();
                    session_destroy();
                    header('Location: /login');
                    exit;
                }
            } else {
                $usuario = null;
            }
            ?>

            <div class="user-profile">
                <a href="<?= BASE_URL ?>/perfil">
                    <div class="user-avatar">
                        <?php if (!empty($usuario['avatar'])): ?>
                            <img src="<?= BASE_URL ?>/uploads/avatars/<?= htmlspecialchars($usuario['avatar']) ?>" alt="<?= htmlspecialchars($usuario['nome']) ?>" class="avatar-img">
                        <?php else: ?>
                            <div class="avatar-placeholder"><i class="bi bi-person-fill"></i></div>
                        <?php endif; ?>
                    </div>
                    <div class="user-info">
                        <span class="user-name"><?= htmlspecialchars($usuario['nome']) ?></span>
                        <span class="user-email"><?= htmlspecialchars($usuario['email']) ?></span>
                    </div>
                </a>
            </div>

            <nav class="menu nav flex-column">
                <a class="nav-link" href="<?= BASE_URL ?>"><i class="bi bi-house-fill"></i> Início</a>
                <a class="nav-link" href="<?= BASE_URL ?>/artistas"><i class="bi bi-person"></i> Artistas</a>
                <a class="nav-link" href="<?= BASE_URL ?>/generos"><i class="bi bi-tags"></i> Gêneros</a>
                <a class="nav-link" href="<?= BASE_URL ?>/player"><i class="bi bi-music-note-list"></i> Player</a>
                <a class="nav-link" href="<?= BASE_URL ?>/curtidas"><i class="bi bi-heart-fill"></i> Curtidas</a>
                <a class="nav-link" href="<?= BASE_URL ?>/historico"><i class="bi bi-clock-history"></i> Recentes</a>
                <a class="nav-link" href="<?= BASE_URL ?>/playlists"><i class="bi bi-collection-play-fill"></i> Playlists</a>
                <a class="nav-link" href="<?= BASE_URL ?>/player/top"><i class="bi bi-fire"></i> Top Músicas</a>
                <a class="nav-link" href="<?= BASE_URL ?>/seguindo"><i class="bi bi-people"></i> Seguindo</a>

                <?php
                $isAdmin = $usuarioModel->isAdmin($_SESSION['usuario_id']);
                if ($isAdmin): ?>
                    <a class="nav-link" href="<?= BASE_URL ?>/admin"><i class="bi bi-speedometer2"></i> Painel</a>
                <?php endif; ?>

                <?php
                $isArtista = $usuarioModel->isArtista($_SESSION['usuario_id']);
                if ($isArtista): ?>
                    <a class="nav-link" href="<?= BASE_URL ?>/artista"><i class="bi bi-mic-fill"></i> Área do Artista</a>
                <?php endif; ?>

                <a class="nav-link position-relative" href="<?= BASE_URL ?>/notificacoes">
                    <i class="bi bi-bell"></i> Notificações
                    <span id="notificacao-badge" class="badge bg-danger rounded-pill" style="display: none; font-size: 0.6rem; position: absolute; top: 2px; right: 2px;">0</span>
                </a>

                <a class="nav-link" href="<?= BASE_URL ?>/sobre"><i class="bi bi-info-circle"></i> Sobre</a>
                <button class="nav-link theme-toggle" id="theme-toggle"><i class="bi bi-moon-fill" id="theme-icon"></i> <span style="margin-left: 8px;">Tema</span></button>
                <a class="nav-link" href="<?= BASE_URL ?>/perfil"><i class="bi bi-person-circle"></i> Perfil</a>
                <a class="nav-link" href="<?= BASE_URL ?>/logout"><i class="bi bi-box-arrow-right"></i> Sair</a>
            </nav>

            <div class="sidebar-footer">
                <small>Sonora v1.0</small>
            </div>

        </aside>

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
            <button id="btn-shuffle" class="btn btn-cinza" title="Aleatório">
                <i class="bi bi-shuffle"></i>
            </button>

            <button id="btn-prev" class="btn btn-cinza">
                <i class="bi bi-skip-start-fill"></i>
            </button>

            <button id="btn-play" class="btn btn-verde">
                <i class="bi bi-play-fill"></i>
            </button>

            <button id="btn-next" class="btn btn-cinza">
                <i class="bi bi-skip-end-fill"></i>
            </button>

            <button id="btn-repeat" class="btn btn-cinza" title="Repetir">
                <i class="bi bi-arrow-repeat"></i>
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

<style>
    .global-player {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 1035;
        background: var(--bg-sidebar, #0f0f1a);
        border-top: 1px solid var(--border-color, #2a2a4a);
        padding: 12px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: nowrap;
        transition: all 0.3s ease;
    }

    .player-left {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 180px;
        flex-shrink: 0;
    }

    .player-left img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 6px;
        flex-shrink: 0;
    }

    .player-left h6 {
        margin: 0;
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-primary, #fff);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
    }

    .player-left small {
        display: block;
        font-size: 0.75rem;
        color: var(--text-secondary, #b3b3b3);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
    }

    .player-center {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
        min-width: 0;
        gap: 4px;
    }

    .player-controls {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .player-controls .btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        font-size: 1.1rem;
        background: transparent;
        border: none;
        color: var(--text-secondary, #b3b3b3);
        transition: all 0.2s ease;
        flex-shrink: 0;
    }

    .player-controls .btn:hover {
        color: var(--text-primary, #fff);
        transform: scale(1.1);
    }

    .player-controls .btn-verde {
        background: #8B5CF6;
        color: #121212;
        width: 44px;
        height: 44px;
        font-size: 1.3rem;
    }

    .player-controls .btn-verde:hover {
        background: #A78BFA;
        transform: scale(1.1);
        color: #121212;
    }

    .player-controls .btn-cinza {
        background: transparent;
        color: var(--text-secondary, #b3b3b3);
    }

    .player-controls .btn-cinza:hover {
        color: var(--text-primary, #fff);
    }

    .player-controls .btn.active {
        color: #8B5CF6;
    }

    .player-progress {
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
        max-width: 500px;
    }

    .player-progress span {
        font-size: 0.7rem;
        color: var(--text-secondary, #b3b3b3);
        flex-shrink: 0;
        min-width: 36px;
        text-align: center;
    }

    #barra-progresso {
        flex: 1;
        height: 4px;
        -webkit-appearance: none;
        appearance: none;
        background: var(--border-color, #2a2a4a);
        border-radius: 2px;
        outline: none;
        cursor: pointer;
        min-width: 60px;
    }

    #barra-progresso::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #8B5CF6;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    #barra-progresso::-webkit-slider-thumb:hover {
        transform: scale(1.2);
    }

    #barra-progresso::-moz-range-thumb {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #8B5CF6;
        cursor: pointer;
        border: none;
    }

    .player-right {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 120px;
        flex-shrink: 0;
    }

    .player-right i {
        color: var(--text-secondary, #b3b3b3);
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    #volume {
        width: 80px;
        height: 4px;
        -webkit-appearance: none;
        appearance: none;
        background: var(--border-color, #2a2a4a);
        border-radius: 2px;
        outline: none;
        cursor: pointer;
        flex-shrink: 0;
    }

    #volume::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #8B5CF6;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    #volume::-webkit-slider-thumb:hover {
        transform: scale(1.2);
    }

    #volume::-moz-range-thumb {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #8B5CF6;
        cursor: pointer;
        border: none;
    }

    [data-user-role="admin"] .player-controls .btn-verde {
        background: #DC3545 !important;
        color: #ffffff !important;
    }

    [data-user-role="admin"] .player-controls .btn-verde:hover {
        background: #FF4757 !important;
        color: #ffffff !important;
    }

    [data-user-role="admin"] #barra-progresso::-webkit-slider-thumb {
        background: #DC3545 !important;
    }

    [data-user-role="admin"] #volume::-webkit-slider-thumb {
        background: #DC3545 !important;
    }

    @media (max-width: 768px) {
        .global-player {
            padding: 10px 16px;
            gap: 12px;
        }

        .player-left {
            min-width: 140px;
        }

        .player-left img {
            width: 40px;
            height: 40px;
        }

        .player-left h6 {
            font-size: 0.8rem;
            max-width: 100px;
        }

        .player-left small {
            font-size: 0.65rem;
            max-width: 100px;
        }

        .player-controls .btn {
            width: 32px;
            height: 32px;
            font-size: 1rem;
        }

        .player-controls .btn-verde {
            width: 38px;
            height: 38px;
            font-size: 1.1rem;
        }

        .player-right {
            min-width: 100px;
        }

        #volume {
            width: 60px;
        }

        .player-progress span {
            font-size: 0.65rem;
            min-width: 30px;
        }

        .player-progress {
            max-width: 350px;
        }
    }

    @media (max-width: 576px) {
        .global-player {
            padding: 8px 10px;
            gap: 8px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .player-left {
            display: none;
        }

        .player-center {
            flex: 1;
            min-width: 0;
            width: 100%;
            order: 1;
        }

        .player-controls {
            gap: 4px;
        }

        .player-controls .btn {
            width: 28px;
            height: 28px;
            font-size: 0.85rem;
        }

        .player-controls .btn-verde {
            width: 36px;
            height: 36px;
            font-size: 1rem;
        }

        .player-controls #btn-shuffle,
        .player-controls #btn-repeat {
            display: none;
        }

        .player-progress {
            max-width: 100%;
            gap: 6px;
        }

        .player-progress span {
            font-size: 0.6rem;
            min-width: 24px;
        }

        #barra-progresso {
            min-width: 40px;
        }

        .player-right {
            min-width: auto;
            gap: 6px;
            order: 2;
        }

        .player-right i {
            font-size: 1rem;
        }

        #volume {
            width: 40px;
        }
    }

    @media (max-width: 400px) {
        .global-player {
            padding: 6px 8px;
        }

        .player-controls .btn {
            width: 24px;
            height: 24px;
            font-size: 0.75rem;
        }

        .player-controls .btn-verde {
            width: 32px;
            height: 32px;
            font-size: 0.9rem;
        }

        .player-progress span {
            font-size: 0.5rem;
            min-width: 20px;
        }

        #volume {
            width: 30px;
        }
    }
</style>

<script>
    const BASE_URL = '<?= BASE_URL ?>';
</script>

<script src="<?= BASE_URL ?>/assets/js/player.js?v=<?= filemtime(__DIR__ . '/../../../public/assets/js/player.js') ?>"></script>
<script src="<?= BASE_URL ?>/assets/js/volume.js?v=<?= filemtime(__DIR__ . '/../../../public/assets/js/volume.js') ?>"></script>
<script src="<?= BASE_URL ?>/assets/js/playlist.js?v=<?= filemtime(__DIR__ . '/../../../public/assets/js/playlist.js') ?>"></script>
<script src="<?= BASE_URL ?>/assets/js/search.js?v=<?= filemtime(__DIR__ . '/../../../public/assets/js/search.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL ?>/assets/js/playlist-modal.js?v=<?= filemtime(__DIR__ . '/../../../public/assets/js/playlist-modal.js') ?>"></script>
<script src="<?= BASE_URL ?>/assets/js/theme.js?v=<?= filemtime(__DIR__ . '/../../../public/assets/js/theme.js') ?>"></script>

<button id="btn-topo" class="btn-topo" title="Voltar ao topo">
    <i class="bi bi-chevron-up"></i>
</button>

</body>
</html>