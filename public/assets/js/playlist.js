function tocarMusicaPlaylist(botao, id, audio, titulo, artista, album, capa) {
    console.log('Playlist tocando música:', titulo);

    const player = document.getElementById('player');
    player.src = audio;
    player.play();

    document.getElementById('gp-titulo').innerText = titulo;
    document.getElementById('gp-artista').innerText = artista + ' • ' + album;
    document.getElementById('gp-capa').src = capa;

    document.getElementById('btn-play').innerHTML = '<i class="bi bi-pause-fill"></i>';

    fetch('/sonora/public/player/reproduzir/' + id, {
        method: 'POST'
    });
}

function selecionarMusica(botao) {
    document.querySelectorAll('.musica-item').forEach(function(item) {
        item.classList.remove('ativa');
    });
    if (botao) {
        botao.closest('.musica-item')?.classList.add('ativa');
    }
}