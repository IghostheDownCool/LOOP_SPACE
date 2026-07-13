function tocarMusica(botao, id, audio, titulo, artista, album, capa)
{
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

    document.getElementById('titulo').innerText = titulo;

    document.getElementById('artista').innerText =
        'Artista: ' + artista;

    document.getElementById('album').innerText =
        'Álbum: ' + album;

    const img = document.getElementById('capa');

    img.src = capa;

    img.style.display = 'block';
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