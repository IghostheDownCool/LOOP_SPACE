<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>SONORA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <style>
        body {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a0a2a 50%, #0a0a0a 100%);
            min-height: 100vh;
            color: #fff;
            display: flex;
            flex-direction: column;
        }
        .landing-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 40px 20px;
        }
        .landing-title {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #8B5CF6, #A78BFA);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .landing-subtitle {
            font-size: 1.3rem;
            color: #b3b3b3;
            margin-bottom: 30px;
            max-width: 600px;
        }
        .landing-buttons {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .landing-buttons .btn {
            padding: 12px 32px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s;
        }
        .btn-primary-custom {
            background: #8B5CF6;
            color: #fff;
            border: none;
        }
        .btn-primary-custom:hover {
            background: #A78BFA;
            transform: scale(1.05);
            color: #fff;
        }
        .btn-outline-custom {
            background: transparent;
            color: #b3b3b3;
            border: 1px solid #4a4a4a;
        }
        .btn-outline-custom:hover {
            background: rgba(139, 92, 246, 0.1);
            border-color: #8B5CF6;
            color: #fff;
        }
        .landing-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 24px;
            margin-top: 40px;
            max-width: 800px;
            width: 100%;
        }
        .feature-item {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 16px;
            padding: 20px;
            transition: all 0.3s;
        }
        .feature-item:hover {
            border-color: #8B5CF6;
            transform: translateY(-4px);
        }
        .feature-item i {
            font-size: 2rem;
            color: #8B5CF6;
            margin-bottom: 8px;
        }
        .feature-item h5 {
            font-weight: 600;
            margin-bottom: 4px;
        }
        .feature-item p {
            font-size: 0.85rem;
            color: #888;
            margin: 0;
        }
        @media (max-width: 576px) {
            .landing-title { font-size: 2.5rem; }
            .landing-subtitle { font-size: 1rem; }
        }
    </style>
</head>
<body>

<div class="landing-container">
    <div class="logo-icon" style="font-size: 4rem; color: #8B5CF6;">
        <i class="bi bi-vinyl-fill"></i>
    </div>
    <h1 class="landing-title">SONORA</h1>
    <p class="landing-subtitle">
        Descubra, ouça e compartilhe músicas. Uma experiência completa de streaming.
    </p>

    <div class="landing-buttons">
        <a href="<?= BASE_URL ?>/login" class="btn btn-primary-custom">
            <i class="bi bi-box-arrow-in-right"></i> Entrar
        </a>
        <a href="<?= BASE_URL ?>/cadastro" class="btn btn-outline-custom">
            <i class="bi bi-person-plus"></i> Criar conta
        </a>
    </div>

    <div class="landing-features">
        <div class="feature-item">
            <i class="bi bi-music-note-beamed"></i>
            <h5>Músicas</h5>
            <p>Milhares de músicas disponíveis</p>
        </div>
        <div class="feature-item">
            <i class="bi bi-collection-play"></i>
            <h5>Playlists</h5>
            <p>Crie e compartilhe playlists</p>
        </div>
        <div class="feature-item">
            <i class="bi bi-people"></i>
            <h5>Artistas</h5>
            <p>Siga seus artistas favoritos</p>
        </div>
    </div>

    <div style="margin-top: 30px; color: #555; font-size: 0.8rem;">
        &copy; <?= date('Y') ?> SONORA. Todos os direitos reservados.
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>