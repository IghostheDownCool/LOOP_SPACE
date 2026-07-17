<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
    <h1><i class="bi bi-info-circle text-success"></i> Sobre o Loop Space</h1>
    <p class="text-muted">Um projeto de streaming de música inspirado no Spotify</p>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card bg-dark text-light">
            <div class="card-body">
                <h5>🎵 O que é o Loop Space?</h5>
                <p>
                    O Loop Space é um projeto de estudo desenvolvido em PHP puro, com arquitetura MVC,
                    que simula um serviço de streaming de música. O projeto foi criado com o objetivo
                    de praticar conceitos de programação web, banco de dados e boas práticas de desenvolvimento.
                </p>

                <h5 class="mt-4">🛠️ Tecnologias utilizadas</h5>
                <ul>
                    <li><strong>Backend:</strong> PHP 8+ (puro, sem frameworks)</li>
                    <li><strong>Banco de Dados:</strong> MySQL com PDO</li>
                    <li><strong>Frontend:</strong> HTML5, CSS3, JavaScript Vanilla</li>
                    <li><strong>CSS Framework:</strong> Bootstrap 5</li>
                    <li><strong>Ícones:</strong> Bootstrap Icons</li>
                    <li><strong>Servidor Local:</strong> XAMPP</li>
                </ul>

                <h5 class="mt-4">📋 Funcionalidades</h5>
                <ul>
                    <li>✅ Player global com controles (play/pause, próximo, anterior)</li>
                    <li>✅ Modos shuffle e repeat</li>
                    <li>✅ Criação e gerenciamento de playlists</li>
                    <li>✅ Barra de pesquisa global</li>
                    <li>✅ Páginas de artista e álbum</li>
                    <li>✅ Sistema de curtidas e histórico</li>
                    <li>✅ Recomendações personalizadas</li>
                    <li>✅ Seguir artistas</li>
                    <li>✅ Compartilhar playlists</li>
                    <li>✅ Área administrativa com dashboard</li>
                    <li>✅ Sistema de notificações</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-dark text-light">
            <div class="card-body">
                <h5>📊 Estatísticas</h5>
                <p>
                    <i class="bi bi-people"></i> <?= (new Usuario())->contar() ?> usuários<br>
                    <i class="bi bi-music-note"></i> <?= (new Musica())->contar() ?> músicas<br>
                    <i class="bi bi-person"></i> <?= (new Artista())->contar() ?> artistas<br>
                    <i class="bi bi-collection"></i> <?= (new Album())->contar() ?> álbuns<br>
                    <i class="bi bi-collection-play"></i> <?= (new Playlist())->contar() ?> playlists
                </p>
                <hr>
                <p class="text-muted small">
                    <strong>Versão:</strong> 2.0<br>
                    <strong>Desenvolvido por:</strong> Estudante de PHP<br>
                    <strong>Repositório:</strong> <a href="#" class="text-success">GitHub</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>