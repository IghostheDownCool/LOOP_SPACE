<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<style>
/* ==================================================
   PERFIL - AVATAR E CONFIGURAÇÕES
   ================================================== */

.profile-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px 0;
}

.profile-header {
    text-align: center;
    margin-bottom: 30px;
}

.profile-header h1 {
    color: var(--text-primary);
    margin-bottom: 8px;
}

.profile-header p {
    color: var(--text-secondary);
}

.profile-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 30px;
    text-align: center;
}

.profile-avatar-wrapper {
    position: relative;
    width: 150px;
    height: 150px;
    margin: 0 auto 20px;
}

.profile-avatar-wrapper img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #1db954;
    background: var(--bg-secondary);
}

.profile-avatar-wrapper .avatar-placeholder {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: var(--bg-secondary);
    border: 4px solid var(--border-color);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
    color: var(--text-muted);
}

.profile-name {
    color: var(--text-primary);
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0 0 4px 0;
}

.profile-email {
    color: var(--text-secondary);
    margin-bottom: 20px;
}

.profile-form {
    display: flex;
    flex-direction: column;
    gap: 16px;
    align-items: center;
}

.profile-form .file-input-wrapper {
    position: relative;
    width: 100%;
    max-width: 300px;
}

.profile-form input[type="file"] {
    width: 100%;
    padding: 10px;
    border: 2px dashed var(--border-color);
    border-radius: 8px;
    background: var(--bg-input);
    color: var(--text-primary);
    cursor: pointer;
    transition: border-color 0.2s;
}

.profile-form input[type="file"]:hover {
    border-color: #1db954;
}

.profile-form .btn-upload {
    background: #1db954;
    color: #fff;
    border: none;
    padding: 12px 32px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.2s;
}

.profile-form .btn-upload:hover {
    background: #1ed760;
    transform: scale(1.02);
}

.profile-form .btn-upload:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.profile-actions {
    display: flex;
    gap: 12px;
    justify-content: center;
    margin-top: 8px;
    flex-wrap: wrap;
}

.profile-actions .btn-remover {
    background: transparent;
    color: #dc3545;
    border: 1px solid #dc3545;
    padding: 8px 20px;
    border-radius: 50px;
    font-weight: 500;
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
}

.profile-actions .btn-remover:hover {
    background: #dc3545;
    color: #fff;
}

.profile-actions .btn-voltar {
    background: var(--bg-card-hover);
    color: var(--text-primary);
    border: 1px solid var(--border-color);
    padding: 8px 20px;
    border-radius: 50px;
    font-weight: 500;
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
}

.profile-actions .btn-voltar:hover {
    background: var(--border-color);
}

/* Tema claro */
[data-theme="light"] .profile-card {
    background: var(--bg-card, #ffffff);
    border-color: var(--border-color, #dddddd);
}

[data-theme="light"] .profile-name {
    color: var(--text-primary, #121212);
}

[data-theme="light"] .profile-email {
    color: var(--text-secondary, #666666);
}

[data-theme="light"] .profile-form input[type="file"] {
    background: var(--bg-input, #f0f0f0);
    border-color: var(--border-color, #dddddd);
    color: var(--text-primary, #121212);
}

/* Responsividade */
@media (max-width: 576px) {
    .profile-card {
        padding: 20px;
    }

    .profile-avatar-wrapper {
        width: 120px;
        height: 120px;
    }

    .profile-avatar-wrapper img {
        width: 120px;
        height: 120px;
    }

    .profile-avatar-wrapper .avatar-placeholder {
        width: 120px;
        height: 120px;
        font-size: 3rem;
    }

    .profile-name {
        font-size: 1.2rem;
    }

    .profile-actions {
        flex-direction: column;
        align-items: center;
    }

    .profile-actions .btn-remover,
    .profile-actions .btn-voltar {
        width: 100%;
        text-align: center;
    }
}
</style>

<div class="profile-container">
    <div class="profile-header">
        <h1>👤 Meu Perfil</h1>
        <p>Gerencie suas informações e avatar</p>
    </div>

    <div class="profile-card">
        <!-- Avatar -->
        <div class="profile-avatar-wrapper">
            <?php if (!empty($usuario['avatar'])): ?>
                <img
                    src="<?= BASE_URL ?>/uploads/avatars/<?= htmlspecialchars($usuario['avatar']) ?>"
                    alt="<?= htmlspecialchars($usuario['nome']) ?>"
                    onerror="this.src='<?= BASE_URL ?>/assets/images/default-avatar.png'"
                >
            <?php else: ?>
                <div class="avatar-placeholder">
                    <i class="bi bi-person-circle"></i>
                </div>
            <?php endif; ?>
        </div>

        <h2 class="profile-name"><?= htmlspecialchars($usuario['nome']) ?></h2>
        <p class="profile-email"><?= htmlspecialchars($usuario['email']) ?></p>

        <!-- Formulário de upload -->
        <form
            class="profile-form"
            method="POST"
            action="<?= BASE_URL ?>/perfil/atualizarAvatar"
            enctype="multipart/form-data"
        >
            <div class="file-input-wrapper">
                <input
                    type="file"
                    name="avatar"
                    id="avatar"
                    accept="image/jpeg,image/png,image/gif,image/webp"
                    required
                >
                <small style="color: var(--text-muted); display: block; margin-top: 4px; font-size: 0.75rem;">
                    Formatos: JPG, PNG, GIF, WEBP • Máx. 2MB
                </small>
            </div>

            <button type="submit" class="btn-upload" id="btn-upload">
                <i class="bi bi-cloud-upload"></i> Atualizar Avatar
            </button>
        </form>

        <!-- Ações -->
        <div class="profile-actions">
            <?php if (!empty($usuario['avatar'])): ?>
                <a
                    href="<?= BASE_URL ?>/perfil/removerAvatar"
                    class="btn-remover"
                    onclick="return confirm('Deseja realmente remover seu avatar?')"
                >
                    <i class="bi bi-trash"></i> Remover Avatar
                </a>
            <?php endif; ?>
            <a href="<?= BASE_URL ?>" class="btn-voltar">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
        </div>
    </div>
</div>

<script>
    // Mostra o nome do arquivo selecionado
    document.getElementById('avatar').addEventListener('change', function() {
        const btn = document.getElementById('btn-upload');
        if (this.files.length > 0) {
            btn.innerHTML = '<i class="bi bi-check-circle"></i> Enviar ' + this.files[0].name;
        } else {
            btn.innerHTML = '<i class="bi bi-cloud-upload"></i> Atualizar Avatar';
        }
    });
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>