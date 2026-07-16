function selecionarMusica(botao)
{
    document.querySelectorAll('.musica-item').forEach(function(item) {

        item.classList.remove('ativa');

    });

    botao.classList.add('ativa');
}





const audioPlayer = document.getElementById('player');



function tocarPorIndice(indice)
{
    const musicas = document.querySelectorAll('.musica-item');

    if (indice < 0 || indice >= musicas.length) {
        return;
    }

    musicas[indice].click();
}




function formatarTempo(segundos)
{
    if (isNaN(segundos)) {
        return '0:00';
    }

    const min = Math.floor(segundos / 60);

    const seg = Math.floor(segundos % 60);

    return min + ':' + String(seg).padStart(2, '0');
}



function tocarProxima()
{
    const musicas = document.querySelectorAll('.musica-item');

    const atual = document.querySelector('.musica-item.ativa');

    if (!atual) {
        return;
    }

    const indice = Array.from(musicas).indexOf(atual);

    if (indice < musicas.length - 1) {

        tocarPorIndice(indice + 1);

    } else {

        // Volta para a primeira música da lista
        tocarPorIndice(0);

    }
}


const volume = document.getElementById('volume');

if (volume) {

    audioPlayer.volume = 1;

    volume.addEventListener('input', function () {

        audioPlayer.volume = volume.value / 100;

    });

}