<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - SONORA</title>
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
        .cadastro-card {
            background: rgba(255,255,255,0.04);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px;
            padding: 40px;
            max-width: 480px;
            width: 100%;
        }
        .cadastro-card .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .cadastro-card .logo h1 {
            color: #8B5CF6;
            font-weight: 800;
            font-size: 2rem;
            margin: 0;
        }
        .cadastro-card .logo small {
            color: #666;
            font-size: 0.8rem;
        }
        .cadastro-card .form-control {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            color: #fff;
            padding: 12px 16px;
            border-radius: 12px;
            transition: all 0.3s;
        }
        .cadastro-card .form-control:focus {
            border-color: #8B5CF6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.15);
            background: rgba(255,255,255,0.08);
        }
        .cadastro-card .form-control::placeholder {
            color: #555;
        }
        .cadastro-card .btn-primary {
            background: #8B5CF6;
            border: none;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
        }
        .cadastro-card .btn-primary:hover {
            background: #A78BFA;
            transform: scale(1.02);
        }
        .cadastro-card .link {
            color: #888;
            font-size: 0.9rem;
            text-decoration: none;
            transition: color 0.3s;
        }
        .cadastro-card .link:hover {
            color: #8B5CF6;
        }
        .alert {
            border-radius: 12px;
            border: none;
        }

        .tipo-conta {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
        }
        .tipo-conta .tipo-option {
            flex: 1;
            text-align: center;
            padding: 14px 10px;
            border: 2px solid var(--border-color, #2a2a4a);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: rgba(255,255,255,0.03);
        }
        .tipo-conta .tipo-option:hover {
            border-color: rgba(139, 92, 246, 0.3);
            background: rgba(139, 92, 246, 0.05);
        }
        .tipo-conta .tipo-option.selected {
            border-color: #8B5CF6;
            background: rgba(139, 92, 246, 0.1);
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.15);
        }
        .tipo-conta .tipo-option i {
            font-size: 1.8rem;
            display: block;
            margin-bottom: 4px;
            color: var(--text-secondary, #b3b3b3);
        }
        .tipo-conta .tipo-option.selected i {
            color: #8B5CF6;
        }
        .tipo-conta .tipo-option strong {
            display: block;
            font-size: 0.9rem;
            color: var(--text-primary, #fff);
        }
        .tipo-conta .tipo-option small {
            font-size: 0.7rem;
            color: var(--text-muted, #6b6b6b);
        }
        .tipo-conta .tipo-option.selected small {
            color: var(--text-secondary, #b3b3b3);
        }
        .tipo-conta input[type="radio"] {
            display: none;
        }
    </style>
</head>
<body>

<div class="cadastro-card">
    <div class="logo">
        <i class="bi bi-vinyl-fill" style="font-size: 2.5rem; color: #8B5CF6;"></i>
        <h1>SONORA</h1>
        <small>Crie sua conta e comece a ouvir</small>
    </div>

    <?php if (Flash::has()): ?>
        <?php $flash = Flash::get(); ?>
        <div class="alert alert-<?= $flash['type'] ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($flash['message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= BASE_URL ?>/cadastro/cadastrar">
        <div class="mb-3">
            <input type="text" name="nome" class="form-control" placeholder="Nome completo" required>
        </div>
        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="E-mail" required>
        </div>
        <div class="mb-3">
            <input type="password" name="senha" class="form-control" placeholder="Senha (mín. 6 caracteres)" required minlength="6">
        </div>

        <div class="mb-3">
            <label style="color: var(--text-secondary, #b3b3b3); font-size: 0.85rem; margin-bottom: 6px; display: block;">
                <i class="bi bi-person"></i> Como você quer usar o SONORA?
            </label>
            <div class="tipo-conta">
                <label class="tipo-option selected" id="option-ouvinte">
                    <input type="radio" name="tipo" value="ouvinte" checked>
                    <i class="bi bi-headphones"></i>
                    <strong>Ouvinte</strong>
                    <small>Ouça e curta músicas</small>
                </label>
                <label class="tipo-option" id="option-artista">
                    <input type="radio" name="tipo" value="artista">
                    <i class="bi bi-mic-fill"></i>
                    <strong>Artista</strong>
                    <small>Poste suas músicas</small>
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Criar conta</button>
    </form>

    <div class="text-center mt-3">
        <a href="<?= BASE_URL ?>/login" class="link">Já tem uma conta? <strong style="color: #8B5CF6;">Faça login</strong></a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const options = document.querySelectorAll('.tipo-option');

        options.forEach(function(option) {
            option.addEventListener('click', function() {
                options.forEach(function(opt) {
                    opt.classList.remove('selected');
                });

                this.classList.add('selected');

                const radio = this.querySelector('input[type="radio"]');
                if (radio) {
                    radio.checked = true;
                }
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>