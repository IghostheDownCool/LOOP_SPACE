if (btnPlay) {
    btnPlay.addEventListener('click', function () {
        if (!audio.src) {
            return;
        }
        if (audio.paused) {
            audio.play();
        } else {
            audio.pause();
        }
    });
}

audio.addEventListener('play', function () {
    btnPlay.innerHTML = '<i class="bi bi-pause-fill"></i>';
});

audio.addEventListener('pause', function () {
    btnPlay.innerHTML = '<i class="bi bi-play-fill"></i>';
});

if (btnNext) {
    btnNext.addEventListener('click', function () {
        if (typeof tocarProxima === 'function') {
            tocarProxima();
        } else {
            const musicas = document.querySelectorAll('.musica-item');
            const atual = document.querySelector('.musica-item.ativa');
            if (!atual) return;
            const indice = Array.from(musicas).indexOf(atual);
            if (typeof tocarPorIndice === 'function') {
                tocarPorIndice(indice + 1);
            }
        }
    });
}

if (btnPrev) {
    btnPrev.addEventListener('click', function () {
        if (typeof tocarAnterior === 'function') {
            tocarAnterior();
        } else {
            const musicas = document.querySelectorAll('.musica-item');
            const atual = document.querySelector('.musica-item.ativa');
            if (!atual) return;
            const indice = Array.from(musicas).indexOf(atual);
            if (typeof tocarPorIndice === 'function') {
                tocarPorIndice(indice - 1);
            }
        }
    });
}