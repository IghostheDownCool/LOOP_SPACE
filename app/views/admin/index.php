<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1>Painel Administrativo</h1>

<ul>

    <li>
        <a href="<?= BASE_URL ?>/admin/artistas">
            Gerenciar Artistas
        </a>
    </li>

    <li>
        <a href="<?= BASE_URL ?>/admin/albuns">
            Gerenciar Álbuns
        </a>
    </li>

    <li>
        <a href="<?= BASE_URL ?>/admin/musicas">
            Gerenciar Músicas
        </a>
    </li>

</ul>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>