<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <title>LOOP SPACE</title>

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
    href="<?= BASE_URL ?>/assets/css/style.css?v=<?= filemtime(__DIR__ . '/../../../public/assets/css/style.css') ?>"
>

<link
    rel="stylesheet"
    href="<?= BASE_URL ?>/assets/css/layout.css?v=<?= filemtime(__DIR__ . '/../../../public/assets/css/layout.css') ?>"
>

<link
    rel="stylesheet"
    href="<?= BASE_URL ?>/assets/css/forms.css?v=<?= filemtime(__DIR__ . '/../../../public/assets/css/forms.css') ?>"
>

    <link
        rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/admin.css"
    >

    <link
        rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/player.css"
    >

    

</head>

<body>

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