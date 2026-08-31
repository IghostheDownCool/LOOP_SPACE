<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Login - Sonora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a0a2a 50%, #0a0a0a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            background: rgba(255,255,255,0.04);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px;
            padding: 40px;
            max-width: 420px;
            width: 100%;
        }
        .login-card .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-card .logo h1 {
            color: #8B5CF6;
            font-weight: 800;
            font-size: 2rem;
            margin: 0;
        }
        .login-card .logo small {
            color: #666;
            font-size: 0.8rem;
        }
        .login-card .form-control {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            color: #fff;
            padding: 12px 16px;
            border-radius: 12px;
            transition: all 0.3s;
        }
        .login-card .form-control:focus {
            border-color: #8B5CF6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.15);
            background: rgba(255,255,255,0.08);
        }
        .login-card .form-control::placeholder {
            color: #555;
        }
        .login-card .btn-primary {
            background: #8B5CF6;
            border: none;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
        }
        .login-card .btn-primary:hover {
            background: #A78BFA;
            transform: scale(1.02);
        }
        .login-card .link {
            color: #888;
            font-size: 0.9rem;
            text-decoration: none;
            transition: color 0.3s;
        }
        .login-card .link:hover {
            color: #8B5CF6;
        }
        .alert {
            border-radius: 12px;
            border: none;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="logo">
        <i class="bi bi-vinyl-fill" style="font-size: 2.5rem; color: #8B5CF6;"></i>
        <h1>SONORA</h1>
        <small>Entre e ouça suas músicas</small>
    </div>

    <?php if (Flash::has()): ?>
        <?php $flash = Flash::get(); ?>
        <div class="alert alert-<?= $flash['type'] ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($flash['message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= BASE_URL ?>/login/logar">
        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="E-mail" required>
        </div>
        <div class="mb-3">
            <input type="password" name="senha" class="form-control" placeholder="Senha" required>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>

    <div class="text-center mt-3">
        <a href="<?= BASE_URL ?>/cadastro" class="link">Não tem uma conta? <strong style="color: #8B5CF6;">Cadastre-se</strong></a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>