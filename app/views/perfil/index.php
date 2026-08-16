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
    border: 4px solid #8B5CF6;
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

.profile-avatar-wrapper .avatar-actions {
    display: flex;
    gap: 8px;
    margin-top: 10px;
    flex-wrap: wrap;
    justify-content: center;
}

.profile-avatar-wrapper .btn-avatar {
    border-radius: 50px;
    padding: 4px 20px;
    font-size: 0.85rem;
    background: transparent;
    border: 1px solid var(--border-color);
    color: var(--text-secondary);
    transition: all 0.2s;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.profile-avatar-wrapper .btn-avatar:hover {
    background: rgba(139, 92, 246, 0.1);
    border-color: #8B5CF6;
    color: #8B5CF6;
}

.profile-avatar-wrapper .btn-avatar-danger:hover {
    background: rgba(220, 53, 69, 0.1);
    border-color: #dc3545;
    color: #dc3545;
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
    border-color: #8B5CF6;
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.15);
}

.profile-form .form-control::placeholder {
    color: var(--text-muted);
}

.profile-form .btn-submit {
    background: #8B5CF6;
    color: #121212;
    border: none;
    padding: 10px 24px;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}

.profile-form .btn-submit:hover {
    background: #A78BFA;
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

/* Estatísticas */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 12px;
}

.stat-item {
    background: var(--bg-secondary);
    border-radius: 12px;
    padding: 14px 10px;
    text-align: center;
    transition: all 0.2s;
}

.stat-item:hover {
    background: var(--bg-card-hover);
    transform: translateY(-2px);
}

.stat-item .stat-icon {
    font-size: 1.4rem;
    color: #8B5CF6;
    margin-bottom: 2px;
}

.stat-item .stat-value {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1.2;
}

.stat-item .stat-label {
    font-size: 0.7rem;
    color: var(--text-muted);
}

/* Modal Avatar */
.modal-content.bg-card {
    background: var(--bg-card) !important;
    border: 1px solid var(--border-color) !important;
    border-radius: 16px !important;
}

.modal-content.bg-card .modal-header {
    border-bottom: 1px solid var(--border-color) !important;
    padding: 16px 20px;
}

.modal-content.bg-card .modal-header .modal-title {
    color: var(--text-primary);
}

.modal-content.bg-card .modal-body {
    padding: 20px;
}

.modal-content.bg-card .modal-footer {
    border-top: 1px solid var(--border-color) !important;
    padding: 12px 20px;
}

.modal-content.bg-card .btn-close {
    filter: invert(1);
}

[data-theme="light"] .modal-content.bg-card .btn-close {
    filter: invert(0);
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

[data-theme="light"] .profile-form .form-control:focus {
    border-color: #8B5CF6;
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.15);
}

[data-theme="light"] .profile-form .btn-submit {
    background: #7C3AED;
    color: #ffffff;
}

[data-theme="light"] .profile-form .btn-submit:hover {
    background: #8B5CF6;
    color: #121212;
}

[data-theme="light"] .profile-info-row {
    border-bottom-color: var(--border-color-light, #eeeeee);
}

[data-theme="light"] .profile-info-row .value {
    color: var(--text-primary, #121212);
}

[data-theme="light"] .stat-item {
    background: var(--bg-card-hover, #f0f0f0);
}

[data-theme="light"] .stat-item .stat-icon {
    color: #7C3AED;
}

[data-theme="light"] .profile-avatar-wrapper .avatar-large {
    border-color: #7C3AED;
}

/* ==================================================
   TEMA ADMIN - PERFIL
================================================== */
[data-user-role="admin"] .profile-avatar-wrapper .avatar-large {
    border-color: #DC3545 !important;
}

[data-user-role="admin"] .profile-form .btn-submit {
    background: #DC3545 !important;
    color: #ffffff !important;
}

[data-user-role="admin"] .profile-form .btn-submit:hover {
    background: #FF4757 !important;
    color: #ffffff !important;
}

[data-user-role="admin"] .profile-form .form-control:focus {
    border-color: #DC3545 !important;
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.15) !important;
}

[data-user-role="admin"] .stat-item .stat-icon {
    color: #DC3545 !important;
}

[data-user-role="admin"] .profile-avatar-wrapper .btn-avatar:hover {
    border-color: #DC3545 !important;
    color: #DC3545 !important;
}

[data-user-role="admin"][data-theme="light"] .profile-avatar-wrapper .avatar-large {
    border-color: #DC3545 !important;
}

[data-user-role="admin"][data-theme="light"] .profile-form .btn-submit {
    background: #DC3545 !important;
    color: #ffffff !important;
}

[data-user-role="admin"][data-theme="light"] .profile-form .btn-submit:hover {
    background: #FF4757 !important;
    color: #ffffff !important;
}

[data-user-role="admin"][data-theme="light"] .stat-item .stat-icon {
    color: #DC3545 !important;
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

    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
    }

    .stat-item {
        padding: 10px 8px;
    }

    .stat-item .stat-value {
        font-size: 1.1rem;
    }
}
</style>

<div class="profile-container">
    <div class="profile-header">
        <h1>Minha Conta</h1>
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

            <div class="avatar-actions">
                <button 
                    type="button" 
                    class="btn-avatar"
                    data-bs-toggle="modal" 
                    data-bs-target="#modalAvatar"
                >
                    <i class="bi bi-camera"></i> Alterar avatar
                </button>
                <?php if (!empty($usuario['avatar'])): ?>
                    <a 
                        href="<?= BASE_URL ?>/perfil/removerAvatar" 
                        class="btn-avatar btn-avatar-danger"
                        onclick="return confirm('Tem certeza que deseja remover seu avatar?')"
                    >
                        <i class="bi bi-trash"></i> Remover
                    </a>
                <?php endif; ?>
            </div>
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
         ESTATÍSTICAS DO USUÁRIO
         ============================================= -->
    <div class="profile-card">
        <h3><i class="bi bi-graph-up"></i> Estatísticas</h3>
        
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-icon"><i class="bi bi-clock-history"></i></div>
                <div class="stat-value"><?= $tempoFormatado ?></div>
                <div class="stat-label">Tempo ouvido</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon"><i class="bi bi-music-note"></i></div>
                <div class="stat-value"><?= $totalMusicasOuvidas ?></div>
                <div class="stat-label">Músicas ouvidas</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon"><i class="bi bi-heart-fill"></i></div>
                <div class="stat-value"><?= $totalCurtidas ?></div>
                <div class="stat-label">Músicas curtidas</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon"><i class="bi bi-collection-play-fill"></i></div>
                <div class="stat-value"><?= $totalPlaylists ?></div>
                <div class="stat-label">Playlists criadas</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                <div class="stat-value"><?= $totalArtistasSeguidos ?></div>
                <div class="stat-label">Artistas seguidos</div>
            </div>
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
     MODAL PARA UPLOAD DO AVATAR
     ============================================= -->
<div class="modal fade" id="modalAvatar" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-card">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-camera"></i> Alterar Avatar
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="<?= BASE_URL ?>/perfil/atualizarAvatar" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <p class="text-muted">Selecione uma imagem para seu avatar.</p>
                    </div>
                    <input 
                        type="file" 
                        name="avatar" 
                        id="avatar" 
                        class="form-control" 
                        accept="image/*"
                        required
                        style="background: var(--bg-input); border: 1px solid var(--border-color); color: var(--text-primary);"
                    >
                    <small class="text-muted">Formatos: JPG, PNG, GIF, WEBP. Máx 2MB.</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" style="background: #8B5CF6; border-color: #8B5CF6; color: #121212;">
                        <i class="bi bi-upload"></i> Enviar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>