const barraProgresso = document.getElementById('barra-progresso');

const tempoAtual = document.getElementById('tempo-atual');

const tempoTotal = document.getElementById('tempo-total');

audioPlayer.addEventListener('timeupdate', function () {

    if (!audioPlayer.duration) {
        return;
    }

    barraProgresso.max = Math.floor(audioPlayer.duration);

    barraProgresso.value = Math.floor(audioPlayer.currentTime);

    tempoAtual.innerText =
        formatarTempo(audioPlayer.currentTime);

    tempoTotal.innerText =
        formatarTempo(audioPlayer.duration);

});

barraProgresso.addEventListener('input', function () {

    audioPlayer.currentTime = barraProgresso.value;

});