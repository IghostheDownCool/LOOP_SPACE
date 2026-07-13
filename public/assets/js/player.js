function tocarMusica(botao, audio, titulo, artista, album, capa)
{
    document.querySelectorAll('.musica-item').forEach(function(item) {
        item.classList.remove('ativa');
    });

    botao.classList.add('ativa');

    const player = document.getElementById('player');

    player.src = audio;

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