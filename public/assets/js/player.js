function tocarMusica(botao, id, audio, titulo, artista, album, capa)
{
    console.log({
        gpTitulo: document.getElementById('gp-titulo'),
        gpArtista: document.getElementById('gp-artista'),
        gpCapa: document.getElementById('gp-capa'),
        player: document.getElementById('player')
    });

    document.querySelectorAll('.musica-item').forEach(function(item) {
        item.classList.remove('ativa');
    });

    botao.classList.add('ativa');

    const player = document.getElementById('player');

    player.src = audio;

    fetch('/LOOP_SPACE/public/player/reproduzir/' + id, {
        method: 'POST'
    });

    player.play();
    btnPlay.innerHTML =
    '<i class="bi bi-pause-fill"></i>';

    document.getElementById('gp-titulo').innerText = titulo;
    document.getElementById('gp-artista').innerText = artista + ' • ' + album;

    const img = document.getElementById('gp-capa');

    console.log(capa);

    img.src = capa;
}

document.addEventListener('DOMContentLoaded', function () {

    const busca = document.getElementById('busca');

    if (!busca) {
        return;
    }

    busca.addEventListener('keyup', function () {

        const texto = busca.value.toLowerCase();

        document.querySelectorAll('.musica-item').forEach(function (item) {

            const pesquisa = item.dataset.search || '';

if (pesquisa.includes(texto)) {

                item.parentElement.style.display = '';

            } else {

                item.parentElement.style.display = 'none';

            }

        });

    });

});

const audioPlayer = document.getElementById('player');

const btnPlay = document.getElementById('btn-play');

if (btnPlay) {

    btnPlay.addEventListener('click', function () {

        if (!audioPlayer.src) {
            return;
        }

        if (audioPlayer.paused) {

            audioPlayer.play();

        } else {

            audioPlayer.pause();

        }

    });

}

audioPlayer.addEventListener('play', function () {

    btnPlay.innerHTML =
        '<i class="bi bi-pause-fill"></i>';

});

audioPlayer.addEventListener('pause', function () {

    btnPlay.innerHTML =
        '<i class="bi bi-play-fill"></i>';

});

function tocarPorIndice(indice)
{
    const musicas = document.querySelectorAll('.musica-item');

    if (indice < 0 || indice >= musicas.length) {
        return;
    }

    musicas[indice].click();
}