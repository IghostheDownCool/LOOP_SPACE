function tocarMusica(botao, id, audio, titulo, artista, album, capa)
{
    console.log({
        gpTitulo: document.getElementById('gp-titulo'),
        gpArtista: document.getElementById('gp-artista'),
        gpCapa: document.getElementById('gp-capa'),
        player: document.getElementById('player')
    });

    selecionarMusica(botao);

    const player = document.getElementById('player');

    player.src = audio;

    fetch('/LOOP_SPACE/public/player/reproduzir/' + id, {
        method: 'POST'
    });

    player.play();
    btnPlay.innerHTML =
    '<i class="bi bi-pause-fill"></i>';

barraProgresso.value = 0;

tempoAtual.innerText = '0:00';

tempoTotal.innerText = '0:00';
    
    document.getElementById('gp-titulo').innerText = titulo;
    document.getElementById('gp-artista').innerText = artista + ' • ' + album;

    const img = document.getElementById('gp-capa');

    console.log(capa);

    img.src = capa;
}