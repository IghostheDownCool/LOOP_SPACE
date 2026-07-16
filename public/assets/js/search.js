// ==================================================
// BARRA DE PESQUISA GLOBAL
// ==================================================

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const resultsContainer = document.getElementById('search-results');

    if (!searchInput || !resultsContainer) return;

    let timeoutId = null;

    searchInput.addEventListener('input', function() {
        clearTimeout(timeoutId);

        const termo = this.value.trim();

        if (termo.length < 2) {
            resultsContainer.classList.remove('show');
            resultsContainer.innerHTML = '';
            return;
        }

        timeoutId = setTimeout(() => {
            realizarBusca(termo);
        }, 300);
    });

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.search-bar-container')) {
            resultsContainer.classList.remove('show');
        }
    });

    function realizarBusca(termo) {
        fetch(BASE_URL + '/buscar?q=' + encodeURIComponent(termo))
            .then(response => response.json())
            .then(resultados => {
                if (resultados.length === 0) {
                    resultsContainer.innerHTML = '<div class="search-result-empty">Nenhum resultado encontrado.</div>';
                    resultsContainer.classList.add('show');
                    return;
                }

                let html = '';
                resultados.forEach(musica => {
                    html += `
                        <div class="search-result-item" data-id="${musica.id}">
                            <img src="${BASE_URL}/uploads/capas/${musica.capa}" alt="${musica.album}">
                            <div class="info">
                                <div class="titulo">${musica.titulo}</div>
                                <div class="artista">${musica.artista} • ${musica.album}</div>
                            </div>
                            <span class="badge">Música</span>
                        </div>
                    `;
                });
                resultsContainer.innerHTML = html;
                resultsContainer.classList.add('show');

                document.querySelectorAll('.search-result-item').forEach(item => {
                    item.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        if (typeof tocarMusicaPorId === 'function') {
                            tocarMusicaPorId(id);
                            resultsContainer.classList.remove('show');
                            searchInput.value = '';
                        }
                    });
                });
            })
            .catch(error => {
                console.error('Erro na busca:', error);
                resultsContainer.innerHTML = '<div class="search-result-empty">Erro ao realizar busca.</div>';
                resultsContainer.classList.add('show');
            });
    }
});