<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SONORA - Portfólio Musical</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <style>
    /* ==================================================
       FORÇA O FUNDO ESCURO
       ================================================== */
    html, body {
        background: linear-gradient(160deg, #05050a 0%, #0d0a1a 30%, #120b22 60%, #0a0515 100%) !important;
        background-attachment: fixed !important;
        min-height: 100vh !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    body {
        font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
        color: #fff;
        display: flex;
        flex-direction: column;
        overflow-x: hidden;
    }

    /* Remove fundo de qualquer container */
    .container-fluid, .row, .col, main, section, div {
        background: transparent !important;
    }

    /* ==================================================
       ANIMAÇÃO DE FUNDO
       ================================================== */

    .bg-animation {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
        pointer-events: none;
        overflow: hidden;
    }

    .bg-animation .orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.12;
        animation: float 20s infinite ease-in-out;
    }

    .bg-animation .orb:nth-child(1) {
        width: 500px;
        height: 500px;
        background: #8B5CF6;
        top: -150px;
        right: -150px;
        animation-delay: 0s;
        opacity: 0.08;
    }

    .bg-animation .orb:nth-child(2) {
        width: 350px;
        height: 350px;
        background: #6C2BD9;
        bottom: -80px;
        left: -80px;
        animation-delay: -5s;
        opacity: 0.06;
    }

    .bg-animation .orb:nth-child(3) {
        width: 300px;
        height: 300px;
        background: #A78BFA;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        animation-delay: -10s;
        opacity: 0.05;
    }

    .bg-animation .orb:nth-child(4) {
        width: 200px;
        height: 200px;
        background: #4a1a8a;
        top: 20%;
        right: 20%;
        animation-delay: -7s;
        opacity: 0.07;
    }

    .bg-animation .orb:nth-child(5) {
        width: 250px;
        height: 250px;
        background: #2d0b5c;
        bottom: 30%;
        left: 15%;
        animation-delay: -3s;
        opacity: 0.06;
    }

    @keyframes float {
        0%, 100% { transform: translate(0, 0) scale(1); }
        25% { transform: translate(60px, -100px) scale(1.1); }
        50% { transform: translate(-40px, 70px) scale(0.9); }
        75% { transform: translate(50px, 40px) scale(1.05); }
    }

    /* ==================================================
       CONTAINER PRINCIPAL
       ================================================== */

    .landing-container {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 60px 20px;
        position: relative;
        z-index: 1;
        min-height: 100vh;
    }

    /* ==================================================
       LOGO E TÍTULO
       ================================================== */

    .logo-wrapper {
        position: relative;
        margin-bottom: 20px;
    }

    .logo-icon {
        font-size: 5rem;
        color: #8B5CF6;
        display: block;
        animation: pulse-icon 3s ease-in-out infinite;
        filter: drop-shadow(0 0 50px rgba(139, 92, 246, 0.25));
    }

    @keyframes pulse-icon {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .landing-title {
        font-size: 4.5rem;
        font-weight: 900;
        margin-bottom: 8px;
        background: linear-gradient(135deg, #8B5CF6, #A78BFA, #6C2BD9);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        letter-spacing: -0.03em;
    }

    .landing-title .highlight {
        background: linear-gradient(135deg, #A78BFA, #8B5CF6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .landing-badge {
        display: inline-block;
        background: rgba(139, 92, 246, 0.12);
        border: 1px solid rgba(139, 92, 246, 0.2);
        padding: 4px 18px;
        border-radius: 50px;
        font-size: 0.7rem;
        color: #A78BFA;
        letter-spacing: 1px;
        text-transform: uppercase;
        font-weight: 600;
        margin-bottom: 12px;
        backdrop-filter: blur(4px);
    }

    /* ==================================================
       SUBTÍTULO E DESCRIÇÃO
       ================================================== */

    .landing-subtitle {
        font-size: 1.5rem;
        color: #d4d4d4;
        max-width: 650px;
        margin-bottom: 12px;
        font-weight: 300;
        line-height: 1.4;
    }

    .landing-description {
        font-size: 1rem;
        color: #b0b0b0;
        max-width: 600px;
        margin-bottom: 32px;
        line-height: 1.8;
    }

    .landing-description strong {
        color: #A78BFA;
        font-weight: 600;
    }

    .landing-description .highlight-text {
        color: #8B5CF6;
        font-weight: 500;
    }

    /* ==================================================
       BOTÕES
       ================================================== */

    .landing-buttons {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 20px;
    }

    .landing-buttons .btn {
        padding: 14px 36px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        overflow: hidden;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #8B5CF6, #6C2BD9);
        color: #fff;
        border: none;
        box-shadow: 0 4px 24px rgba(139, 92, 246, 0.35);
    }

    .btn-primary-custom:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 8px 40px rgba(139, 92, 246, 0.5);
        color: #fff;
    }

    .btn-primary-custom::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%);
        transform: scale(0);
        transition: transform 0.5s;
    }

    .btn-primary-custom:hover::after {
        transform: scale(1);
    }

    .btn-outline-custom {
        background: rgba(255,255,255,0.04);
        color: #d4d4d4;
        border: 1px solid rgba(255,255,255,0.1);
        backdrop-filter: blur(4px);
    }

    .btn-outline-custom:hover {
        background: rgba(139, 92, 246, 0.12);
        border-color: #8B5CF6;
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 4px 24px rgba(139, 92, 246, 0.15);
    }

    /* ==================================================
       FEATURES / CARDS
       ================================================== */

    .landing-features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 30px;
        max-width: 800px;
        width: 100%;
    }

    .feature-item {
        background: rgba(255,255,255,0.03) !important;
        border: 1px solid rgba(255,255,255,0.06) !important;
        border-radius: 16px;
        padding: 24px 16px;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        cursor: default;
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(4px);
    }

    .feature-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.06), transparent);
        opacity: 0;
        transition: opacity 0.4s;
    }

    .feature-item:hover::before {
        opacity: 1;
    }

    .feature-item:hover {
        border-color: #8B5CF6 !important;
        transform: translateY(-6px);
        box-shadow: 0 8px 32px rgba(139, 92, 246, 0.1);
        background: rgba(255,255,255,0.05) !important;
    }

    .feature-item i {
        font-size: 2.2rem;
        color: #8B5CF6;
        margin-bottom: 10px;
        display: block;
        transition: transform 0.3s;
    }

    .feature-item:hover i {
        transform: scale(1.1);
    }

    .feature-item h5 {
        font-weight: 700;
        margin-bottom: 4px;
        color: #fff;
        font-size: 1rem;
    }

    .feature-item p {
        font-size: 0.8rem;
        color: #777;
        margin: 0;
        line-height: 1.5;
    }

    /* ==================================================
       RODAPÉ
       ================================================== */

    .landing-footer {
        margin-top: 40px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .landing-footer small {
        color: #444;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    /* ==================================================
       RESPONSIVIDADE
       ================================================== */

    @media (max-width: 768px) {
        .landing-title {
            font-size: 3rem;
        }

        .landing-subtitle {
            font-size: 1.2rem;
            max-width: 100%;
        }

        .landing-description {
            font-size: 0.9rem;
            max-width: 100%;
            padding: 0 10px;
        }

        .landing-features {
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 16px;
        }

        .landing-buttons .btn {
            padding: 12px 24px;
            font-size: 0.9rem;
        }

        .logo-icon {
            font-size: 3.5rem;
        }

        .bg-animation .orb:nth-child(1) {
            width: 200px;
            height: 200px;
        }

        .bg-animation .orb:nth-child(2) {
            width: 150px;
            height: 150px;
        }
    }

    @media (max-width: 576px) {
        .landing-title {
            font-size: 2.2rem;
        }

        .landing-subtitle {
            font-size: 1rem;
        }

        .landing-description {
            font-size: 0.85rem;
        }

        .landing-features {
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .feature-item {
            padding: 16px 12px;
        }

        .feature-item i {
            font-size: 1.6rem;
        }

        .feature-item h5 {
            font-size: 0.85rem;
        }

        .landing-buttons {
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 280px;
        }

        .landing-buttons .btn {
            width: 100%;
            justify-content: center;
        }

        .landing-container {
            padding: 40px 16px;
        }

        .bg-animation .orb {
            display: none;
        }
    }

    @media (max-width: 400px) {
        .landing-features {
            grid-template-columns: 1fr;
        }

        .landing-title {
            font-size: 1.8rem;
        }
    }
</style>
</head>
<body>

<!-- ==================================================
     ANIMAÇÃO DE FUNDO
     ================================================== -->
<div class="bg-animation">
    <div class="orb"></div>
    <div class="orb"></div>
    <div class="orb"></div>
    <div class="orb"></div>
    <div class="orb"></div>
</div>

<!-- ==================================================
     CONTEÚDO PRINCIPAL
     ================================================== -->
<div class="landing-container">

    <!-- Badge -->
    <span class="landing-badge">
        <i class="bi bi-mic-fill"></i> Para compositores e sound designers
    </span>

    <!-- Logo -->
    <div class="logo-wrapper">
        <i class="bi bi-vinyl-fill logo-icon"></i>
    </div>

    <!-- Título -->
    <h1 class="landing-title">
        <span class="highlight">SONORA</span>
    </h1>

    <!-- Subtítulo -->
    <p class="landing-subtitle">
        Seu portfólio digital de produções musicais
    </p>

    <!-- Descrição -->
    <p class="landing-description">
        <strong>SONORA</strong> é a plataforma definitiva para <span class="highlight-text">compositores</span> e 
        <span class="highlight-text">sound designers</span> que desejam compartilhar seu trabalho com o mundo.
        <br><br>
        Faça o <strong>upload</strong> de suas produções, organize seu <strong>portfólio</strong> de forma profissional
        e <strong>conecte-se</strong> com uma comunidade de criadores.
    </p>

    <!-- Botões -->
    <div class="landing-buttons">
        <a href="<?= BASE_URL ?>/login" class="btn btn-primary-custom">
            <i class="bi bi-box-arrow-in-right"></i> Entrar
        </a>
        <a href="<?= BASE_URL ?>/cadastro" class="btn btn-outline-custom">
            <i class="bi bi-person-plus"></i> Criar conta
        </a>
    </div>

    <!-- Features -->
    <div class="landing-features">
        <div class="feature-item">
            <i class="bi bi-cloud-arrow-up"></i>
            <h5>Upload</h5>
            <p>Envie suas produções musicais</p>
        </div>
        <div class="feature-item">
            <i class="bi bi-collection-play"></i>
            <h5>Portfólio</h5>
            <p>Organize e mostre seu trabalho</p>
        </div>
        <div class="feature-item">
            <i class="bi bi-people"></i>
            <h5>Visibilidade</h5>
            <p>Compartilhe com o mundo</p>
        </div>
    </div>

    <!-- Rodapé -->
    <div class="landing-footer">
        <small>&copy; <?= date('Y') ?> SONORA. Todos os direitos reservados.</small>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>