// ==================================================
// CONTROLES DO PLAYER - COMPLEMENTAR AO player.js
// ==================================================

// NOTA: As variáveis `audio`, `btnPlay`, `btnNext`, `btnPrev`
// já são declaradas no player.js. Não as redeclare aqui!

// --- Botão Play/Pause ---
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

// Atualiza ícone ao tocar/pausar (já feito no player.js, mas mantido para compatibilidade)
audio.addEventListener('play', function () {
    btnPlay.innerHTML = '<i class="bi bi-pause-fill"></i>';
});

audio.addEventListener('pause', function () {
    btnPlay.innerHTML = '<i class="bi bi-play-fill"></i>';
});

// --- Botão Próximo ---
if (btnNext) {
    btnNext.addEventListener('click', function () {
        // Usa a função global do player.js (tocarProxima)
        if (typeof tocarProxima === 'function') {
            tocarProxima();
        } else {
            // Fallback para a lógica antiga (se não existir a função)
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

// --- Botão Anterior ---
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

// --- Evento de fim da música (já tratado no player.js, então removido) ---
// audio.addEventListener('ended', function () {
//     tocarProxima();
// });