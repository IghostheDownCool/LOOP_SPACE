function tocarMusica(audio, titulo, artista, album, capa)
{
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