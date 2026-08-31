<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark" data-user-role="<?= isset($_SESSION['usuario_role']) ? $_SESSION['usuario_role'] : 'user' ?>">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SONORA</title>

    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🌊</text></svg>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/theme.css?v=<?= filemtime(__DIR__ . '/../../../public/assets/css/theme.css') ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/buttons.css?v=<?= filemtime(__DIR__ . '/../../../public/assets/css/buttons.css') ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/forms.css?v=<?= filemtime(__DIR__ . '/../../../public/assets/css/forms.css') ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/tables.css?v=<?= filemtime(__DIR__ . '/../../../public/assets/css/tables.css') ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/player.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/artist.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css?v=<?= filemtime(__DIR__ . '/../../../public/assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/music-card.css?v=<?= filemtime(__DIR__ . '/../../../public/assets/css/music-card.css') ?>">

<style>
:root {
    --bg-primary: #0a0a0a;
    --bg-secondary: #1a1a2e;
    --bg-card: #16213e;
    --bg-card-hover: #1a2744;
    --bg-sidebar: #0f0f1a;
    --text-primary: #ffffff;
    --text-secondary: #b3b3b3;
    --text-muted: #6b6b6b;
    --border-color: #2a2a4a;
}

[data-theme="light"] {
    --bg-primary: #f5f5f5;
    --bg-secondary: #ffffff;
    --bg-card: #ffffff;
    --bg-card-hover: #f0f0f0;
    --bg-sidebar: #f8f8f8;
    --text-primary: #121212;
    --text-secondary: #555555;
    --text-muted: #888888;
    --border-color: #dddddd;
}

html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    background: var(--bg-primary);
    color: var(--text-primary);
}

body {
    padding-bottom: 80px !important;
}

.container-fluid {
    min-height: auto !important;
    background: var(--bg-primary) !important;
    padding: 0 !important;
}

.row {
    min-height: auto !important;
    margin: 0 !important;
    display: flex !important;
}

.sidebar {
    background: var(--bg-sidebar) !important;
    border-left: 1px solid var(--border-color) !important;
    padding: 20px 16px !important;
    min-height: 100vh !important;
    height: 100vh !important;
    position: sticky !important;
    top: 0 !important;
    overflow-y: auto !important;
    display: flex !important;
    flex-direction: column !important;
}

.sidebar .menu {
    flex: 1 !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 2px !important;
}

.sidebar .menu .nav-link {
    color: #b3b3b3 !important;
    padding: 10px 14px !important;
    border-radius: 10px !important;
    transition: all 0.2s ease !important;
    font-size: 0.9rem !important;
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
    background: transparent !important;
    border: none !important;
    width: 100% !important;
    text-decoration: none !important;
    font-weight: 500 !important;
}

.sidebar .menu .nav-link:hover {
    color: #ffffff !important;
    background: rgba(139, 92, 246, 0.08) !important;
}

.sidebar .menu .nav-link.active {
    color: #121212 !important;
    background: #8B5CF6 !important;
}

.sidebar .menu .nav-link i {
    font-size: 1.15rem !important;
    width: 22px !important;
    text-align: center !important;
}

.sidebar-footer {
    margin-top: auto !important;
    padding-top: 16px !important;
    border-top: 1px solid var(--border-color) !important;
    text-align: center !important;
    color: var(--text-muted) !important;
    font-size: 12px !important;
}

.conteudo {
    padding: 30px 40px !important;
    background: var(--bg-primary) !important;
    min-height: auto !important;
}

.user-profile {
    padding: 12px 8px 16px 8px !important;
    border-bottom: 1px solid var(--border-color) !important;
    margin-bottom: 16px !important;
}

.user-profile a {
    color: var(--text-primary) !important;
    text-decoration: none !important;
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
}

.user-profile .avatar-img {
    width: 44px !important;
    height: 44px !important;
    border-radius: 50% !important;
    object-fit: cover !important;
}

.user-profile .avatar-placeholder {
    width: 44px !important;
    height: 44px !important;
    border-radius: 50% !important;
    background: var(--bg-card-hover) !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 1.4rem !important;
    color: var(--text-muted) !important;
}

.user-profile .user-name {
    font-weight: 600 !important;
    color: var(--text-primary) !important;
    font-size: 0.95rem !important;
}

.user-profile .user-email {
    font-size: 0.7rem !important;
    color: var(--text-muted) !important;
    display: block !important;
}

.hamburger-btn {
    display: none !important;
    position: fixed !important;
    top: 12px !important;
    right: 12px !important;
    z-index: 1060 !important;
    background: rgba(0,0,0,0.7) !important;
    border: 1px solid var(--border-color) !important;
    color: var(--text-primary) !important;
    font-size: 1.6rem !important;
    padding: 6px 12px !important;
    border-radius: 8px !important;
    cursor: pointer !important;
}

.sidebar-overlay {
    display: none !important;
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
    background: rgba(0,0,0,0.6) !important;
    z-index: 1045 !important;
}

.sidebar-overlay.active {
    display: block !important;
}

[data-user-role="admin"] .sidebar .menu .nav-link.active {
    background: #DC3545 !important;
    color: #ffffff !important;
}

[data-user-role="admin"] .btn-primary,
[data-user-role="admin"] .btn-success,
[data-user-role="admin"] .btn-verde {
    background: #DC3545 !important;
    color: #ffffff !important;
    border-color: #DC3545 !important;
}

[data-user-role="admin"] .btn-primary:hover,
[data-user-role="admin"] .btn-success:hover,
[data-user-role="admin"] .btn-verde:hover {
    background: #FF4757 !important;
    color: #ffffff !important;
    border-color: #FF4757 !important;
}

[data-user-role="admin"] .badge {
    background: #DC3545 !important;
    color: #ffffff !important;
}

@media (max-width: 992px) {
    .conteudo {
        padding: 20px 24px !important;
    }
}

@media (max-width: 768px) {
    .hamburger-btn {
        display: block !important;
    }

    .row {
        display: block !important;
        min-height: auto !important;
    }

    .sidebar {
        position: fixed !important;
        top: 0 !important;
        right: -300px !important;
        width: 280px !important;
        height: 100vh !important;
        z-index: 1050 !important;
        border-left: 1px solid var(--border-color) !important;
        transition: right 0.3s ease !important;
        box-shadow: -4px 0 30px rgba(0,0,0,0.5) !important;
        padding: 16px !important;
        display: none !important;
    }

    .sidebar.open {
        right: 0 !important;
        display: flex !important;
    }

    .conteudo {
        padding: 16px !important;
        margin-top: 60px !important;
        min-height: auto !important;
    }
}

@media (max-width: 576px) {
    .conteudo {
        padding: 12px !important;
        margin-top: 56px !important;
    }

    .sidebar {
        width: 260px !important;
        right: -280px !important;
        padding: 12px 10px !important;
    }

    .hamburger-btn {
        font-size: 1.4rem !important;
        padding: 4px 10px !important;
        top: 8px !important;
        right: 8px !important;
    }

    .sidebar .menu .nav-link {
        font-size: 0.8rem !important;
        padding: 8px 10px !important;
    }
}
</style>

<script>
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

        if (sidebar) {
            sidebar.querySelectorAll('a').forEach(function(link) {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        toggleMenu();
                    }
                });
            });
        }

        window.addEventListener('resize', function() {
            if (window.innerWidth > 768 && sidebar && sidebar.classList.contains('open')) {
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    });

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

</head>

<body>

<?php
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ' . BASE_URL);
    exit;
}
?>

<div class="container-fluid">
    <div class="row">

        <div class="col-12 col-md-9 col-lg-10 conteudo">

            <?php if (Flash::has()): ?>
                <?php $flash = Flash::get(); ?>
                <div class="alert alert-<?= $flash['type'] ?> alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($flash['message']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="search-bar-container mb-4">
                <div class="search-bar">
                    <i class="bi bi-search"></i>
                    <input type="text" id="search-input" class="search-input" placeholder="O que você quer ouvir?" autocomplete="off">
                </div>
                <div id="search-results" class="search-results"></div>
            </div>