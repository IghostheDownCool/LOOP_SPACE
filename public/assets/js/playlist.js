// ==================================================
// PLAYLIST.JS - FUNÇÕES AUXILIARES PARA PLAYLISTS
// ==================================================

function tocarMusicaPlaylist(botao, id, audio, titulo, artista, album, capa) {
    console.log('Playlist tocando música:', titulo);

    // Atualiza o player global
    const player = document.getElementById('player');
    player.src = audio;
    player.play();

    // Atualiza os elementos do player
    document.getElementById('gp-titulo').innerText = titulo;
    document.getElementById('gp-artista').innerText = artista + ' • ' + album;
    document.getElementById('gp-capa').src = capa;

    // Altera o botão play para pause
    document.getElementById('btn-play').innerHTML = '<i class="bi bi-pause-fill"></i>';

    // Registra a reprodução no backend
    fetch('/LOOP_SPACE/public/player/reproduzir/' + id, {
        method: 'POST'
    });
}

function selecionarMusica(botao) {
    // Remove a classe 'ativa' de todos os itens
    document.querySelectorAll('.musica-item').forEach(function(item) {
        item.classList.remove('ativa');
    });
    // Adiciona a classe 'ativa' no botão clicado (ou no elemento pai)
    if (botao) {
        botao.closest('.musica-item')?.classList.add('ativa');
    }
}