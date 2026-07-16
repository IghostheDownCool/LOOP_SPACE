// ==================================================
// MODAL DE ADICIONAR À PLAYLIST
// ==================================================

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM carregado - playlist-modal.js executado');

    const modalPlaylists = document.getElementById('modalPlaylists');
    if (modalPlaylists) {
        console.log('Modal encontrado com ID:', modalPlaylists.id);

        modalPlaylists.addEventListener('show.bs.modal', function(event) {
            console.log('Evento show.bs.modal disparado');

            const button = event.relatedTarget; // botão que abriu o modal
            if (!button) {
                console.error('Nenhum botão relacionado ao modal');
                return;
            }

            const musicaId = button.getAttribute('data-musica-id');
            const musicaTitulo = button.getAttribute('data-musica-titulo');
            console.log('Música ID:', musicaId, 'Título:', musicaTitulo);

            // Armazena o ID da música no modal
            modalPlaylists.setAttribute('data-musica-id', musicaId);

            // Atualiza o título do modal
            const titleEl = document.querySelector('.modal-title');
            if (titleEl) {
                titleEl.innerHTML = '<i class="bi bi-collection-play-fill"></i> Adicionar "' + musicaTitulo + '" à playlist';
            }

            // Busca as playlists via AJAX
            const listContainer = document.getElementById('playlist-list');
            listContainer.innerHTML = '<p class="text-muted">Carregando playlists...</p>';

            console.log('Fazendo fetch para:', BASE_URL + '/playlists/listarJson');

            fetch(BASE_URL + '/playlists/listarJson')
                .then(response => {
                    console.log('Resposta recebida:', response);
                    if (!response.ok) {
                        throw new Error('Erro HTTP: ' + response.status);
                    }
                    return response.json();
                })
                .then(playlists => {
                    console.log('Playlists recebidas:', playlists);
                    if (playlists.length === 0) {
                        listContainer.innerHTML = '<p class="text-muted">Você ainda não tem playlists. <a href="' + BASE_URL + '/playlists/criar" class="text-success">Criar uma</a></p>';
                        return;
                    }
                    let html = '<ul class="list-group list-group-flush">';
                    playlists.forEach(playlist => {
                        html += `
                            <li class="list-group-item bg-dark text-light d-flex justify-content-between align-items-center playlist-item"
                                data-playlist-id="${playlist.id}"
                                data-musica-id="${musicaId}"
                                style="cursor:pointer;"
                            >
                                ${playlist.nome}
                                <i class="bi bi-plus-circle text-success"></i>
                            </li>
                        `;
                    });
                    html += '</ul>';
                    listContainer.innerHTML = html;

                    // Adiciona evento de clique em cada item da playlist
                    document.querySelectorAll('.playlist-item').forEach(item => {
                        item.addEventListener('click', function() {
                            const playlistId = this.getAttribute('data-playlist-id');
                            const musicaId = this.getAttribute('data-musica-id');
                            console.log('Clicou na playlist:', playlistId, 'para música:', musicaId);
                            adicionarMusicaPlaylist(playlistId, musicaId);
                        });
                    });
                })
                .catch(error => {
                    console.error('Erro no fetch:', error);
                    listContainer.innerHTML = '<p class="text-danger">Erro ao carregar playlists: ' + error.message + '</p>';
                });
        });
    } else {
        console.error('Modal com ID "modalPlaylists" não encontrado no DOM');
    }

    // Função para adicionar a música à playlist
    function adicionarMusicaPlaylist(playlistId, musicaId) {
        console.log('Adicionando música', musicaId, 'à playlist', playlistId);

        fetch(BASE_URL + '/playlists/adicionarMusica/' + playlistId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'musica_id=' + musicaId
        })
        .then(response => {
            console.log('Resposta do adicionar:', response);
            if (response.ok) {
                // Fecha o modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalPlaylists'));
                if (modal) modal.hide();
                // Exibe mensagem de sucesso
                alert('Música adicionada à playlist com sucesso!');
            } else {
                alert('Erro ao adicionar música à playlist.');
            }
        })
        .catch(error => {
            console.error('Erro ao adicionar:', error);
            alert('Erro ao adicionar música.');
        });
    }
});