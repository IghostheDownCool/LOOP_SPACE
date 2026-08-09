<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark" data-user-role="<?= isset($_SESSION['usuario_role']) ? $_SESSION['usuario_role'] : 'user' ?>">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SONORA</title>

    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🩻</text></svg>">

<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet"
>

<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
>

<link
    rel="stylesheet"
    href="<?= BASE_URL ?>/assets/css/theme.css?v=<?= filemtime(__DIR__ . '/../../../public/assets/css/theme.css') ?>"
>

<link
    rel="stylesheet"
    href="<?= BASE_URL ?>/assets/css/layout.css?v=<?= filemtime(__DIR__ . '/../../../public/assets/css/layout.css') ?>"
>

<link
    rel="stylesheet"
    href="<?= BASE_URL ?>/assets/css/buttons.css?v=<?= filemtime(__DIR__ . '/../../../public/assets/css/buttons.css') ?>"
>

<link
    rel="stylesheet"
    href="<?= BASE_URL ?>/assets/css/forms.css?v=<?= filemtime(__DIR__ . '/../../../public/assets/css/forms.css') ?>"
>

<link
    rel="stylesheet"
    href="<?= BASE_URL ?>/assets/css/tables.css?v=<?= filemtime(__DIR__ . '/../../../public/assets/css/tables.css') ?>"
>

<link
    rel="stylesheet"
    href="<?= BASE_URL ?>/assets/css/player.css"
>

<link
    rel="stylesheet"
    href="<?= BASE_URL ?>/assets/css/admin.css"
>

<link
    rel="stylesheet"
    href="<?= BASE_URL ?>/assets/css/style.css?v=<?= filemtime(__DIR__ . '/../../../public/assets/css/style.css') ?>"
>

<link
    rel="stylesheet"
    href="<?= BASE_URL ?>/assets/css/music-card.css?v=<?= filemtime(__DIR__ . '/../../../public/assets/css/music-card.css') ?>"
>

<!-- ==================================================
     CSS PARA TEMA ADMIN (VERMELHO)
     ================================================== -->
<style>
    /* ==================================================
       TEMA ADMIN - CORES VERMELHAS
       ================================================== */
    [data-user-role="admin"] {
        --primary-color: #DC3545;
        --primary-hover: #FF4757;
        --primary-light: rgba(220, 53, 69, 0.15);
        --primary-shadow: rgba(220, 53, 69, 0.35);
    }

    /* Botões */
    [data-user-role="admin"] .btn-primary,
    [data-user-role="admin"] .btn-success,
    [data-user-role="admin"] .btn-verde,
    [data-user-role="admin"] a.btn-success,
    [data-user-role="admin"] a.btn-primary,
    [data-user-role="admin"] a.btn-verde,
    [data-user-role="admin"] button.btn-success,
    [data-user-role="admin"] button.btn-primary,
    [data-user-role="admin"] button.btn-verde,
    [data-user-role="admin"] .btn-admin.primary,
    [data-user-role="admin"] a.btn-admin.primary,
    [data-user-role="admin"] button.btn-admin.primary {
        background: #DC3545 !important;
        color: #ffffff !important;
        border-color: #DC3545 !important;
    }

    [data-user-role="admin"] .btn-primary:hover,
    [data-user-role="admin"] .btn-success:hover,
    [data-user-role="admin"] .btn-verde:hover,
    [data-user-role="admin"] a.btn-success:hover,
    [data-user-role="admin"] a.btn-primary:hover,
    [data-user-role="admin"] a.btn-verde:hover,
    [data-user-role="admin"] button.btn-success:hover,
    [data-user-role="admin"] button.btn-primary:hover,
    [data-user-role="admin"] button.btn-verde:hover,
    [data-user-role="admin"] .btn-admin.primary:hover,
    [data-user-role="admin"] a.btn-admin.primary:hover,
    [data-user-role="admin"] button.btn-admin.primary:hover {
        background: #FF4757 !important;
        color: #ffffff !important;
        border-color: #FF4757 !important;
    }

    /* Badges */
    [data-user-role="admin"] .badge {
        background: #DC3545 !important;
        color: #ffffff !important;
    }

    /* Ícones */
    [data-user-role="admin"] i.bi.bi-music-note,
    [data-user-role="admin"] i.bi.bi-person,
    [data-user-role="admin"] i.bi.bi-collection,
    [data-user-role="admin"] i.bi.bi-collection-play,
    [data-user-role="admin"] i.bi.bi-heart-fill,
    [data-user-role="admin"] i.bi.bi-people,
    [data-user-role="admin"] i.bi.bi-plus-circle,
    [data-user-role="admin"] i.bi.bi-eye,
    [data-user-role="admin"] i.bi.bi-pencil {
        color: #DC3545 !important;
    }

    /* Menu ativo */
    [data-user-role="admin"] .sidebar .menu .nav-link.active,
    [data-user-role="admin"] .sidebar .menu a.active,
    [data-user-role="admin"] .menu .nav-link.active,
    [data-user-role="admin"] .menu a.active {
        background: #DC3545 !important;
        color: #ffffff !important;
    }

    [data-user-role="admin"] .sidebar .menu .nav-link.active i,
    [data-user-role="admin"] .sidebar .menu a.active i,
    [data-user-role="admin"] .menu .nav-link.active i,
    [data-user-role="admin"] .menu a.active i {
        color: #ffffff !important;
    }

    /* Links */
    [data-user-role="admin"] a.text-primary,
    [data-user-role="admin"] .text-primary {
        color: #DC3545 !important;
    }

    [data-user-role="admin"] a.text-primary:hover {
        color: #FF4757 !important;
    }

    /* Cards hover */
    [data-user-role="admin"] .bg-card:hover {
        border-color: #DC3545 !important;
    }

    /* Logo texto */
    [data-user-role="admin"] .sidebar-logo .logo-text span {
        color: #DC3545 !important;
    }

    /* Player */
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

    /* Botão topo */
    [data-user-role="admin"] .btn-topo {
        background: #DC3545 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 20px rgba(220, 53, 69, 0.35) !important;
    }

    [data-user-role="admin"] .btn-topo:hover {
        background: #FF4757 !important;
        color: #ffffff !important;
        box-shadow: 0 8px 30px rgba(220, 53, 69, 0.5) !important;
    }

    /* Focus */
    [data-user-role="admin"] input:focus,
    [data-user-role="admin"] select:focus {
        border-color: #DC3545 !important;
        box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.15) !important;
    }

    [data-user-role="admin"] .search-bar:focus-within {
        border-color: #DC3545 !important;
        box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.12) !important;
    }

    /* Menu hambúrguer admin */
    [data-user-role="admin"] .hamburger-btn:hover {
        background: rgba(220, 53, 69, 0.3) !important;
    }

    /* Tema claro - Admin */
    [data-user-role="admin"][data-theme="light"] .btn-primary,
    [data-user-role="admin"][data-theme="light"] .btn-success,
    [data-user-role="admin"][data-theme="light"] .btn-verde {
        background: #DC3545 !important;
        color: #ffffff !important;
        border-color: #DC3545 !important;
    }

    [data-user-role="admin"][data-theme="light"] .btn-primary:hover,
    [data-user-role="admin"][data-theme="light"] .btn-success:hover,
    [data-user-role="admin"][data-theme="light"] .btn-verde:hover {
        background: #FF4757 !important;
        color: #ffffff !important;
        border-color: #FF4757 !important;
    }
</style>

<!-- ==================================================
     CSS RESPONSIVO ADICIONAL (NÃO QUEBRA O EXISTENTE)
     ================================================== -->
<style>
    /* 🔥 LOGO NO TOPO DA SIDEBAR (TEXTO SIMPLES) */
    .sidebar-logo {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 16px 0 20px 0;
        border-bottom: 1px solid var(--border-color, #2a2a4a);
        margin-bottom: 16px;
    }

    .sidebar-logo a {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .sidebar-logo .logo-text {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--text-primary, #fff);
        letter-spacing: -0.02em;
    }

    .sidebar-logo .logo-text span {
        color: #8B5CF6;
    }

    @media (max-width: 768px) {
        .sidebar-logo .logo-text {
            font-size: 1.2rem;
        }
    }

    @media (max-width: 576px) {
        .sidebar-logo .logo-text {
            font-size: 1rem;
        }
    }

    /* 🔥 MENU HAMBÚRGUER - SÓ APARECE EM MOBILE */
    .hamburger-btn {
        display: none;
        background: transparent;
        border: none;
        color: var(--text-primary, #fff);
        font-size: 1.8rem;
        padding: 8px 12px;
        cursor: pointer;
        z-index: 1050;
        position: fixed;
        top: 10px;
        left: 10px;
        background: rgba(0,0,0,0.6);
        border-radius: 8px;
        backdrop-filter: blur(4px);
        border: 1px solid rgba(255,255,255,0.1);
    }

    .hamburger-btn:hover {
        background: rgba(139, 92, 246, 0.3);
    }

    /* 🔥 OVERLAY PARA FECHAR O MENU */
    .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.6);
        z-index: 1038;
    }

    .sidebar-overlay.active {
        display: block;
    }

    /* 🔥 RESPONSIVIDADE: Até 768px */
    @media (max-width: 768px) {
        .hamburger-btn {
            display: block;
        }

        .sidebar {
            position: fixed !important;
            top: 0;
            left: -280px;
            width: 270px !important;
            height: 100vh !important;
            z-index: 1040 !important;
            background: var(--bg-primary, #0a0a0a) !important;
            border-right: 1px solid var(--border-color, #2a2a4a) !important;
            transition: left 0.3s ease !important;
            overflow-y: auto !important;
            padding: 20px 16px !important;
            box-shadow: 4px 0 30px rgba(0,0,0,0.5) !important;
        }

        .sidebar.open {
            left: 0 !important;
        }

        /* Esconde a sidebar no layout padrão */
        .col-md-3.col-lg-2.sidebar {
            flex: 0 0 auto !important;
            width: 270px !important;
        }

        /* Ajusta o main para ocupar toda a largura */
        .col-md-9.col-lg-10.conteudo {
            flex: 0 0 100% !important;
            max-width: 100% !important;
            padding-left: 15px !important;
            padding-right: 15px !important;
            margin-top: 60px !important;
        }

        /* Ajusta o container-fluid */
        .container-fluid {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        /* Ajusta o row */
        .row {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        /* Ajusta a barra de pesquisa */
        .search-bar-container {
            max-width: 100% !important;
            padding: 0 10px !important;
        }

        .search-bar {
            height: 46px !important;
            padding: 0 16px !important;
        }

        .search-input {
            font-size: 0.9rem !important;
        }

        /* Ajusta os cards para 2 colunas em telas médias */
        .row-cols-md-2 {
            --bs-gutter-x: 0.75rem !important;
        }

        .row-cols-md-2 > .col {
            flex: 0 0 50% !important;
            max-width: 50% !important;
        }

        /* Ajusta os cards de artista */
        .row-cols-md-3 {
            --bs-gutter-x: 0.75rem !important;
        }

        .row-cols-md-3 > .col {
            flex: 0 0 33.333% !important;
            max-width: 33.333% !important;
        }
    }

    /* 🔥 RESPONSIVIDADE: Até 576px (mobile) */
    @media (max-width: 576px) {
        .sidebar {
            width: 260px !important;
            left: -270px !important;
            padding: 16px 12px !important;
        }

        .sidebar.open {
            left: 0 !important;
        }

        .col-md-9.col-lg-10.conteudo {
            padding-left: 10px !important;
            padding-right: 10px !important;
            margin-top: 56px !important;
        }

        .hamburger-btn {
            font-size: 1.5rem;
            padding: 6px 10px;
            top: 8px;
            left: 8px;
        }

        /* Cards em 1 coluna no mobile */
        .row-cols-md-2 > .col {
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }

        .row-cols-md-3 > .col {
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }

        .row-cols-lg-3 > .col {
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }

        /* Cards de artista em 2 colunas no mobile */
        .row-cols-md-3.row-cols-lg-4.row-cols-xl-5 > .col {
            flex: 0 0 50% !important;
            max-width: 50% !important;
        }

        /* Ajusta o player */
        .player-container {
            padding: 12px !important;
        }

        /* Ajusta os títulos */
        h1 { font-size: 1.4rem !important; }
        h2 { font-size: 1.1rem !important; }
        h3 { font-size: 1rem !important; }

        /* Ajusta formulários */
        form {
            padding: 16px !important;
        }

        /* Ajusta botões */
        .btn, .btn-primary, .btn-success {
            padding: 10px 16px !important;
            font-size: 0.9rem !important;
            width: 100% !important;
        }

        /* Ajusta inputs */
        input, select {
            padding: 10px 12px !important;
            font-size: 0.9rem !important;
        }

        /* Ajusta estatísticas */
        .stats-grid {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 10px !important;
        }

        .stat-item {
            padding: 12px 8px !important;
        }

        .stat-item .stat-value {
            font-size: 1.3rem !important;
        }

        /* Ajusta comentários */
        .comentario-item {
            padding: 10px 12px !important;
        }

        /* Ajusta o perfil do usuário na sidebar (mobile) */
        .user-profile .user-info {
            display: block !important;
        }

        .user-profile .user-email {
            font-size: 0.7rem !important;
        }

        /* Ajusta as abas de gênero */
        .genero-filtro .btn {
            padding: 4px 12px !important;
            font-size: 0.7rem !important;
        }
    }

    /* 🔥 RESPONSIVIDADE: Telas muito pequenas (até 400px) */
    @media (max-width: 400px) {
        .sidebar {
            width: 220px !important;
            left: -230px !important;
        }

        .sidebar.open {
            left: 0 !important;
        }

        .row-cols-md-3.row-cols-lg-4.row-cols-xl-5 > .col {
            flex: 0 0 50% !important;
            max-width: 50% !important;
        }

        .hamburger-btn {
            font-size: 1.3rem;
            padding: 4px 8px;
        }

        .music-card {
            padding: 6px !important;
        }

        .music-info h6 {
            font-size: 0.75rem !important;
        }

        .music-info small {
            font-size: 0.6rem !important;
        }
    }
</style>

<script>
    // 🔥 FORÇA OS LINKS E ÍCONES DO MENU
    (function() {
        function forcarLinksCinza() {
            var isLight = document.documentElement.getAttribute('data-theme') === 'light';
            var isAdmin = document.documentElement.getAttribute('data-user-role') === 'admin';
            var corIcone = isLight ? '#666666' : '#b3b3b3';
            var corActive = isAdmin ? '#ffffff' : '#121212';
            var corActiveBg = isAdmin ? '#DC3545' : '#8B5CF6';

            var links = document.querySelectorAll('.sidebar .menu a, .sidebar a, .menu a, .nav-link');
            links.forEach(function(link) {
                if (!link.classList.contains('active')) {
                    link.style.setProperty('background', 'transparent', 'important');
                    link.style.setProperty('background-color', 'transparent', 'important');
                } else {
                    link.style.setProperty('color', corActive, 'important');
                    link.style.setProperty('background', corActiveBg, 'important');
                    link.style.setProperty('background-color', corActiveBg, 'important');
                }
            });

            var icons = document.querySelectorAll('.sidebar .menu .nav-link i, .sidebar .menu a i, .menu .nav-link i, .menu a i');
            icons.forEach(function(icon) {
                var parentLink = icon.closest('a');
                if (parentLink && parentLink.classList.contains('active')) {
                    icon.style.setProperty('color', corActive, 'important');
                } else {
                    icon.style.setProperty('color', corIcone, 'important');
                }
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', forcarLinksCinza);
        } else {
            forcarLinksCinza();
        }

        setTimeout(forcarLinksCinza, 500);
        setTimeout(forcarLinksCinza, 1000);
        setTimeout(forcarLinksCinza, 2000);
    })();

    // ==================================================
    // MENU HAMBÚRGUER - ABRIR/FECHAR
    // ==================================================
    document.addEventListener('DOMContentLoaded', function() {
        var hamburger = document.createElement('button');
        hamburger.className = 'hamburger-btn';
        hamburger.setAttribute('aria-label', 'Abrir menu');
        hamburger.innerHTML = '<i class="bi bi-list"></i>';
        document.body.prepend(hamburger);

        var overlay = document.createElement('div');
        overlay.className = 'sidebar-overlay';
        document.body.prepend(overlay);

        var sidebar = document.querySelector('.sidebar');

        function toggleMenu() {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
            document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
        }

        hamburger.addEventListener('click', toggleMenu);
        overlay.addEventListener('click', toggleMenu);

        sidebar.querySelectorAll('a').forEach(function(link) {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    toggleMenu();
                }
            });
        });

        window.addEventListener('resize', function() {
            if (window.innerWidth > 768 && sidebar.classList.contains('open')) {
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    });
</script>

</head>

<script>
    function atualizarNotificacoes() {
        fetch('<?= BASE_URL ?>/notificacoes/contar')
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('notificacao-badge');
                if (data.total > 0) {
                    badge.textContent = data.total > 99 ? '99+' : data.total;
                    badge.style.display = 'inline-block';
                } else {
                    badge.style.display = 'none';
                }
            })
            .catch(error => console.error('Erro ao buscar notificações:', error));
    }

    setInterval(atualizarNotificacoes, 30000);
    document.addEventListener('DOMContentLoaded', atualizarNotificacoes);
</script>

<body>

<?php
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ' . BASE_URL);
    exit;
}
?>

<div class="container-fluid">

    <div class="row">

        <aside class="col-md-3 col-lg-2 sidebar">

            <!-- ==================================================
                 LOGO NO TOPO DA SIDEBAR (TEXTO SIMPLES)
                 ================================================== -->


            <!-- ==================================================
                 PERFIL DO USUÁRIO (AVATAR + NOME)
                 ================================================== -->
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

            <div class="user-profile mb-4 p-2">
                <a href="<?= BASE_URL ?>/perfil" class="text-decoration-none d-flex align-items-center gap-3">
                    <div class="user-avatar">
                        <?php if (!empty($usuario['avatar'])): ?>
                            <img
                                src="<?= BASE_URL ?>/uploads/avatars/<?= htmlspecialchars($usuario['avatar']) ?>"
                                alt="<?= htmlspecialchars($usuario['nome']) ?>"
                                class="avatar-img"
                            >
                        <?php else: ?>
                            <div class="avatar-placeholder">
                                <i class="bi bi-person-fill"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="user-info">
                        <strong class="user-name"><?= htmlspecialchars($usuario['nome']) ?></strong>
                        <small class="user-email"><?= htmlspecialchars($usuario['email']) ?></small>
                    </div>
                </a>
            </div>

            <nav class="menu nav flex-column">

                <a class="nav-link" href="<?= BASE_URL ?>">
                    <i class="bi bi-house-fill"></i>
                    Início
                </a>

                <a class="nav-link" href="<?= BASE_URL ?>/artistas">
                    <i class="bi bi-person"></i> Artistas
                </a>

                <a class="nav-link" href="<?= BASE_URL ?>/generos">
                    <i class="bi bi-tags"></i>
                    Gêneros
                </a>

                <a class="nav-link" href="<?= BASE_URL ?>/player">
                    <i class="bi bi-music-note-list"></i>
                    Player
                </a>

                <a class="nav-link" href="<?= BASE_URL ?>/curtidas">
                    <i class="bi bi-heart-fill"></i> Curtidas
                </a>

                <a class="nav-link" href="<?= BASE_URL ?>/historico">
                    <i class="bi bi-clock-history"></i>
                    Recentes
                </a>

                <a class="nav-link" href="<?= BASE_URL ?>/playlists">
                    <i class="bi bi-collection-play-fill"></i>
                    Playlists
                </a>

                <a class="nav-link" href="<?= BASE_URL ?>/player/top">
                    <i class="bi bi-fire"></i>
                    Top Músicas
                </a>

                <a class="nav-link" href="<?= BASE_URL ?>/seguindo">
                    <i class="bi bi-people"></i> Seguindo
                </a>

                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <?php
                    $usuarioModel = new Usuario();
                    $isAdmin = $usuarioModel->isAdmin($_SESSION['usuario_id']);
                    ?>
                    <?php if ($isAdmin): ?>
                        <a class="nav-link" href="<?= BASE_URL ?>/admin">
                            <i class="bi bi-speedometer2"></i>
                            Painel
                        </a>
                    <?php endif; ?>
                <?php endif; ?>

                <a class="nav-link position-relative" href="<?= BASE_URL ?>/notificacoes">
                    <i class="bi bi-bell"></i>
                    Notificações
                    <span id="notificacao-badge" class="badge bg-danger rounded-pill" style="display: none; font-size: 0.6rem; position: absolute; top: 2px; right: 2px;">0</span>
                </a>

                <a class="nav-link" href="<?= BASE_URL ?>/sobre">
                    <i class="bi bi-info-circle"></i>
                    Sobre
                </a>

                <button class="nav-link theme-toggle" id="theme-toggle" title="Alternar tema">
                    <i class="bi bi-moon-fill" id="theme-icon"></i>
                    <span style="margin-left: 8px;">Tema</span>
                </button>

                <a class="nav-link" href="<?= BASE_URL ?>/perfil">
                    <i class="bi bi-person-circle"></i>
                    Perfil
                </a>

                <a class="nav-link" href="<?= BASE_URL ?>/logout">
                    <i class="bi bi-box-arrow-right"></i>
                    Sair
                </a>

            </nav>

            <div class="sidebar-footer">

                <small>
                    LOOP SPACE v1.0
                </small>

            </div>

        </aside>

        <main class="col-md-9 col-lg-10 conteudo">

        <!-- Mensagens Flash -->
        <?php if (Flash::has()): ?>
            <?php $flash = Flash::get(); ?>
            <div class="alert alert-<?= $flash['type'] ?> alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($flash['message']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- BARRA DE PESQUISA -->
        <div class="search-bar-container mb-4">
            <div class="search-bar">
                <i class="bi bi-search"></i>
                <input type="text" id="search-input" class="search-input" placeholder="O que você quer ouvir?" autocomplete="off">
            </div>
            <div id="search-results" class="search-results"></div>
        </div>

        <!-- O RESTANTE DO CONTEÚDO VIRÁ AQUI -->