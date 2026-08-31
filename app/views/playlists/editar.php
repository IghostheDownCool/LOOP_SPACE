<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<style>

.playlist-form-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px 0;
}

.playlist-form-header {
    text-align: center;
    margin-bottom: 30px;
}

.playlist-form-header h1 {
    color: var(--text-primary);
    font-size: 1.8rem;
    margin: 0;
}

.playlist-form-header p {
    color: var(--text-secondary);
    font-size: 0.95rem;
    margin: 4px 0 0 0;
}

.playlist-form-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 30px;
}

.playlist-form-card .form-group {
    margin-bottom: 20px;
}

.playlist-form-card label {
    display: block;
    color: var(--text-secondary);
    font-weight: 500;
    margin-bottom: 6px;
    font-size: 0.9rem;
}

.playlist-form-card .form-control {
    width: 100%;
    padding: 10px 14px;
    border-radius: 8px;
    border: 1px solid var(--border-color);
    background: var(--bg-input);
    color: var(--text-primary);
    transition: border-color 0.2s;
    font-size: 1rem;
}

.playlist-form-card .form-control:focus {
    outline: none;
    border-color: #1db954;
    box-shadow: 0 0 0 3px rgba(29, 185, 84, 0.15);
}

.playlist-form-card .form-check {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
}

.playlist-form-card .form-check input[type="checkbox"] {
    width: 18px;
    height: 18px;
    accent-color: #1db954;
    cursor: pointer;
}

.playlist-form-card .form-check label {
    margin: 0;
    cursor: pointer;
}

.playlist-form-card .form-actions {
    display: flex;
    gap: 12px;
    margin-top: 8px;
}

.playlist-form-card .btn-submit {
    background: #1db954;
    color: #fff;
    border: none;
    padding: 10px 32px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.playlist-form-card .btn-submit:hover {
    background: #1ed760;
    transform: scale(1.02);
}

.playlist-form-card .btn-cancel {
    background: var(--bg-card-hover);
    color: var(--text-secondary);
    border: 1px solid var(--border-color);
    padding: 10px 32px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.playlist-form-card .btn-cancel:hover {
    background: var(--border-color);
    color: var(--text-primary);
}

[data-theme="light"] .playlist-form-card {
    background: var(--bg-card, #ffffff);
    border-color: var(--border-color, #dddddd);
}

[data-theme="light"] .playlist-form-card .form-control {
    background: var(--bg-input, #f0f0f0);
    border-color: var(--border-color, #dddddd);
    color: var(--text-primary, #121212);
}

[data-theme="light"] .playlist-form-card label {
    color: var(--text-secondary, #666666);
}

@media (max-width: 576px) {
    .playlist-form-card {
        padding: 20px;
    }

    .playlist-form-card .form-actions {
        flex-direction: column;
    }

    .playlist-form-card .btn-submit,
    .playlist-form-card .btn-cancel {
        justify-content: center;
        width: 100%;
    }
}
</style>

<div class="playlist-form-container">
    <div class="playlist-form-header">
        <h1><i class="bi bi-pencil" style="color: #ffd700;"></i> Editar Playlist</h1>
        <p>Atualize as informações da sua playlist</p>
    </div>

    <div class="playlist-form-card">
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome da playlist <span class="text-danger">*</span></label>
                <input
                    type="text"
                    class="form-control"
                    id="nome"
                    name="nome"
                    value="<?= htmlspecialchars($playlist['nome']) ?>"
                    required
                    autofocus
                >
            </div>

            <div class="form-check">
                <input
                    type="checkbox"
                    class="form-check-input"
                    id="publica"
                    name="publica"
                    value="1"
                    <?= $playlist['publica'] ? 'checked' : '' ?>
                >
                <label class="form-check-label" for="publica">
                    <i class="bi bi-globe" style="color: #1db954;"></i>
                    Playlist pública (qualquer pessoa pode visualizar)
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="bi bi-check-circle"></i> Atualizar
                </button>
                <a href="<?= BASE_URL ?>/playlists" class="btn-cancel">
                    <i class="bi bi-x-circle"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>