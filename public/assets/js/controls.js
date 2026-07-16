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

const btnNext = document.getElementById('btn-next');

if (btnNext) {

    btnNext.addEventListener('click', function () {

        const musicas = document.querySelectorAll('.musica-item');

        const atual = document.querySelector('.musica-item.ativa');

        if (!atual) {
            return;
        }

        const indice = Array.from(musicas).indexOf(atual);

        tocarPorIndice(indice + 1);

    });

}

const btnPrev = document.getElementById('btn-prev');

if (btnPrev) {

    btnPrev.addEventListener('click', function () {

        const musicas = document.querySelectorAll('.musica-item');

        const atual = document.querySelector('.musica-item.ativa');

        if (!atual) {
            return;
        }

        const indice = Array.from(musicas).indexOf(atual);

        tocarPorIndice(indice - 1);

    });

}

audioPlayer.addEventListener('ended', function () {

    tocarProxima();

});