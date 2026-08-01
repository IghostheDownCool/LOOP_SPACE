<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<style>
/* ==================================================
   PERFIL - MINHA CONTA
   ================================================== */

.profile-container {
    max-width: 700px;
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
    margin-bottom: 20px;
}

.profile-card h3 {
    color: var(--text-primary);
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--border-color);
}

/* Avatar */
.profile-avatar-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 20px;
}

.profile-avatar-wrapper .avatar-large {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #1db954;
    background: var(--bg-secondary);
}

.profile-avatar-wrapper .avatar-placeholder-large {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: var(--bg-secondary);
    border: 4px solid var(--border-color);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
    color: var(--text-muted);
}

/* Formulários */
.profile-form .form-group {
    margin-bottom: 16px;
}

.profile-form label {
    display: block;
    color: var(--text-secondary);
    font-weight: 500;
    margin-bottom: 4px;
    font-size: 0.9rem;
}

.profile-form .form-control {
    width: 100%;
    padding: 10px 14px;
    border-radius: 8px;
    border: 1px solid var(--border-color);
    background: var(--bg-input);
    color: var(--text-primary);
    transition: border-color 0.2s;
}

.profile-form .form-control:focus {
    outline: none;
    border-color: #1db954;
}

.profile-form .form-control::placeholder {
    color: var(--text-muted);
}

.profile-form .btn-submit {
    background: #1db954;
    color: #fff;
    border: none;
    padding: 10px 24px;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}

.profile-form .btn-submit:hover {
    background: #1ed760;
    transform: scale(1.02);
}

.profile-form .btn-submit:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.profile-info-row {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid var(--border-color-light);
}

.profile-info-row .label {
    color: var(--text-muted);
    font-size: 0.9rem;
}

.profile-info-row .value {
    color: var(--text-primary);
    font-weight: 500;
}

/* Tema claro */
[data-theme="light"] .profile-card {
    background: var(--bg-card, #ffffff);
    border-color: var(--border-color, #dddddd);
}

[data-theme="light"] .profile-card h3 {
    border-bottom-color: var(--border-color, #dddddd);
}

[data-theme="light"] .profile-form .form-control {
    background: var(--bg-input, #f0f0f0);
    border-color: var(--border-color, #dddddd);
    color: var(--text-primary, #121212);
}

[data-theme="light"] .profile-info-row {
    border-bottom-color: var(--border-color-light, #eeeeee);
}

[data-theme="light"] .profile-info-row .value {
    color: var(--text-primary, #121212);
}

/* Responsividade */
@media (max-width: 576px) {
    .profile-card {
        padding: 20px;
    }

    .profile-avatar-wrapper .avatar-large {
        width: 100px;
        height: 100px;
    }

    .profile-avatar-wrapper .avatar-placeholder-large {
        width: 100px;
        height: 100px;
        font-size: 3rem;
    }

    .profile-info-row {
        flex-direction: column;
        gap: 4px;
    }
}
</style>

<div class="profile-container">
    <div class="profile-header">
        <h1>👤 Minha Conta</h1>
        <p>Gerencie suas informações pessoais</p>
    </div>

    <!-- =============================================
         INFORMAÇÕES DO USUÁRIO
         ============================================= -->
    <div class="profile-card">
        <h3><i class="bi bi-person"></i> Informações Pessoais</h3>

        <div class="profile-avatar-wrapper">
            <?php if (!empty($usuario['avatar'])): ?>
                <img
                    src="<?= BASE_URL ?>/uploads/avatars/<?= htmlspecialchars($usuario['avatar']) ?>"
                    alt="<?= htmlspecialchars($usuario['nome']) ?>"
                    class="avatar-large"
                    onerror="this.src='<?= BASE_URL ?>/assets/images/default-avatar.png'"
                >
            <?php else: ?>
                <div class="avatar-placeholder-large">
                    <i class="bi bi-person-fill"></i>
                </div>
            <?php endif; ?>
            <small class="text-muted mt-2">
                <a href="<?= BASE_URL ?>/perfil" class="text-decoration-none">Alterar avatar</a>
            </small>
        </div>

        <div class="profile-info-row">
            <span class="label">Nome</span>
            <span class="value"><?= htmlspecialchars($usuario['nome']) ?></span>
        </div>
        <div class="profile-info-row">
            <span class="label">E-mail</span>
            <span class="value"><?= htmlspecialchars($usuario['email']) ?></span>
        </div>
        <div class="profile-info-row">
            <span class="label">Cadastro</span>
            <span class="value"><?= date('d/m/Y', strtotime($usuario['data_cadastro'] ?? 'now')) ?></span>
        </div>
    </div>

    <!-- =============================================
         ALTERAR NOME
         ============================================= -->
    <div class="profile-card">
        <h3><i class="bi bi-pencil"></i> Alterar Nome</h3>
        <form method="POST" action="<?= BASE_URL ?>/perfil/atualizarNome" class="profile-form">
            <div class="form-group">
                <label for="nome">Novo nome</label>
                <input
                    type="text"
                    id="nome"
                    name="nome"
                    class="form-control"
                    value="<?= htmlspecialchars($usuario['nome']) ?>"
                    required
                >
            </div>
            <button type="submit" class="btn-submit">Atualizar Nome</button>
        </form>
    </div>

    <!-- =============================================
         ALTERAR SENHA
         ============================================= -->
    <div class="profile-card">
        <h3><i class="bi bi-lock"></i> Alterar Senha</h3>
        <form method="POST" action="<?= BASE_URL ?>/perfil/atualizarSenha" class="profile-form">
            <div class="form-group">
                <label for="senha_atual">Senha atual</label>
                <input
                    type="password"
                    id="senha_atual"
                    name="senha_atual"
                    class="form-control"
                    placeholder="Digite sua senha atual"
                    required
                >
            </div>
            <div class="form-group">
                <label for="nova_senha">Nova senha</label>
                <input
                    type="password"
                    id="nova_senha"
                    name="nova_senha"
                    class="form-control"
                    placeholder="Digite a nova senha (mín. 6 caracteres)"
                    required
                    minlength="6"
                >
            </div>
            <div class="form-group">
                <label for="confirmar_senha">Confirmar nova senha</label>
                <input
                    type="password"
                    id="confirmar_senha"
                    name="confirmar_senha"
                    class="form-control"
                    placeholder="Confirme a nova senha"
                    required
                    minlength="6"
                >
            </div>
            <button type="submit" class="btn-submit">Atualizar Senha</button>
        </form>
    </div>
</div>

<!-- =============================================
     ESTATÍSTICAS DO USUÁRIO
     ============================================= -->
<div class="profile-card">
    <h3><i class="bi bi-graph-up"></i> Estatísticas</h3>
    
    <div class="profile-info-row">
        <span class="label">⏱️ Tempo total ouvido</span>
        <span class="value"><?= $tempoFormatado ?></span>
    </div>
    <div class="profile-info-row">
        <span class="label">🎵 Músicas ouvidas</span>
        <span class="value"><?= count($usuario['historico'] ?? []) ?></span>
    </div>
    <div class="profile-info-row">
        <span class="label">❤️ Músicas curtidas</span>
        <span class="value"><?= (new Curtida())->contarPorUsuario($_SESSION['usuario_id']) ?></span>
    </div>
    <div class="profile-info-row">
        <span class="label">📂 Playlists criadas</span>
        <span class="value"><?= (new Playlist())->contarPorUsuario($_SESSION['usuario_id']) ?></span>
    </div>
    <div class="profile-info-row">
        <span class="label">👥 Artistas seguidos</span>
        <span class="value"><?= (new Artista())->contarSeguidos($_SESSION['usuario_id']) ?></span>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>