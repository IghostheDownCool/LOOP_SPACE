<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <title>LOOP SPACE</title>

    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🎵</text></svg>">

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

    // Atualiza a cada 30 segundos
    setInterval(atualizarNotificacoes, 30000);
    // Atualiza ao carregar a página
    document.addEventListener('DOMContentLoaded', atualizarNotificacoes);
</script>

<body>

<div class="container-fluid">

    <div class="row">

        <aside class="col-md-3 col-lg-2 sidebar">

            <div class="logo">

    <i class="bi bi-vinyl-fill logo-icon"></i>

    <h2>LOOP SPACE</h2>

    <small>Music Streaming</small>

</div>

            <nav class="menu nav flex-column">

                <a class="nav-link" href="<?= BASE_URL ?>">
                    <i class="bi bi-house-fill"></i>
                    Início
                </a>

                <a class="nav-link" href="<?= BASE_URL ?>/player">
                    <i class="bi bi-music-note-list"></i>
                    Player
                </a>

                <a class="nav-link" href="<?= BASE_URL ?>/curtidas">
    <i class="bi bi-heart-fill"></i>
    Curtidas
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

                <a class="nav-link" href="<?= BASE_URL ?>/admin">
                    <i class="bi bi-speedometer2"></i>
                    Painel
                </a>

                <a class="nav-link position-relative" href="<?= BASE_URL ?>/notificacoes">
    <i class="bi bi-bell"></i>
    Notificações
    <span id="notificacao-badge" class="badge bg-danger rounded-pill" style="display: none; font-size: 0.6rem; position: absolute; top: 2px; right: 2px;">0</span>
</a>

<a class="nav-link" href="<?= BASE_URL ?>/sobre">
    <i class="bi bi-info-circle"></i>
    Sobre
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