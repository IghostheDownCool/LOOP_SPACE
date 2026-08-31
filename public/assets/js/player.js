const audio = document.getElementById('player');
const btnPlay = document.getElementById('btn-play');
const btnPrev = document.getElementById('btn-prev');
const btnNext = document.getElementById('btn-next');
const progressBar = document.getElementById('barra-progresso');
const tempoAtual = document.getElementById('tempo-atual');
const tempoTotal = document.getElementById('tempo-total');
const capaImg = document.getElementById('gp-capa');
const tituloEl = document.getElementById('gp-titulo');
const artistaEl = document.getElementById('gp-artista');
const volumeSlider = document.getElementById('volume');
const playerElement = document.getElementById('global-player');

let fila = [];
let indiceAtual = 0;
let musicaAtual = null;
let isPlaying = false;


let shuffle = false;
let repeatMode = 'none';
let filaOriginal = [];


function mostrarPlayer() {
    playerElement.classList.add('active');
}

function esconderPlayer() {
    playerElement.classList.remove('active');
}

function toggleShuffle() {
    shuffle = !shuffle;
    const btn = document.getElementById('btn-shuffle');
    btn.classList.toggle('btn-shuffle-active', shuffle);
    
    if (shuffle) {
        if (filaOriginal.length === 0) {
            filaOriginal = [...fila];
        }
        const shuffled = [...fila];
        for (let i = shuffled.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
        }
        fila = shuffled;
    } else {
        if (filaOriginal.length > 0) {
            fila = [...filaOriginal];
            filaOriginal = [];
        }
        if (musicaAtual) {
            indiceAtual = fila.indexOf(musicaAtual.id);
            if (indiceAtual === -1) indiceAtual = 0;
        }
    }
    salvarEstadoPlayer();
}

function toggleRepeat() {
    const btn = document.getElementById('btn-repeat');
    const icon = btn.querySelector('i');
    
    if (repeatMode === 'none') {
        repeatMode = 'all';
        btn.classList.add('btn-repeat-active');
        icon.className = 'bi bi-arrow-repeat';
    } else if (repeatMode === 'all') {
        repeatMode = 'one';
        btn.classList.add('btn-repeat-one-active');
        btn.classList.remove('btn-repeat-active');
        icon.className = 'bi bi-arrow-repeat';
    } else {
        repeatMode = 'none';
        btn.classList.remove('btn-repeat-one-active');
        btn.classList.remove('btn-repeat-active');
        icon.className = 'bi bi-arrow-repeat';
    }
    salvarEstadoPlayer();
}

function getProximoIndice() {
    if (fila.length === 0) return -1;
    
    if (repeatMode === 'one') {
        return indiceAtual;
    }
    
    if (repeatMode === 'all') {
        return (indiceAtual + 1) % fila.length;
    }
    
    if (indiceAtual < fila.length - 1) {
        return indiceAtual + 1;
    }
    return -1;
}

function getAnteriorIndice() {
    if (fila.length === 0) return -1;
    
    if (repeatMode === 'one') {
        return indiceAtual;
    }
    
    if (indiceAtual > 0) {
        return indiceAtual - 1;
    }
    return -1;
}

function atualizarDuracao() {
    if (!audio || !audio.duration || isNaN(audio.duration) || audio.duration === 0) {
        tempoTotal.textContent = '0:00';
        progressBar.max = 100;
        progressBar.value = 0;
        return;
    }
    
    tempoTotal.textContent = formatarTempo(audio.duration);
    progressBar.max = audio.duration;
    progressBar.value = 0;
    
    const isLight = document.documentElement.getAttribute('data-theme') === 'light';
    const bgColor = isLight ? '#d0d0d0' : '#4d4d4d';
    progressBar.style.background = `linear-gradient(to right, #1db954 0%, #1db954 0%, ${bgColor} 0%, ${bgColor} 100%)`;
}

function atualizarProgresso() {
    if (!audio || !audio.duration || isNaN(audio.duration) || audio.duration === 0) {
        return;
    }
    
    if (isNaN(audio.currentTime)) {
        return;
    }
    
    const percentual = Math.min((audio.currentTime / audio.duration) * 100, 100);
    
    progressBar.value = audio.currentTime;
    
    tempoAtual.textContent = formatarTempo(audio.currentTime);
    
    const isLight = document.documentElement.getAttribute('data-theme') === 'light';
    const bgColor = isLight ? '#d0d0d0' : '#4d4d4d';
    progressBar.style.background = `linear-gradient(to right, #1db954 0%, #1db954 ${percentual}%, ${bgColor} ${percentual}%, ${bgColor} 100%)`;
}

async function carregarMusica(musica) {
    if (!musica) return;

    console.log('Dados recebidos em carregarMusica:', musica);

    audio.addEventListener('loadedmetadata', function() {
    if (audio.duration && !isNaN(audio.duration) && audio.duration > 0) {
        atualizarDuracao();
    }
});

    tituloEl.textContent = musica.titulo || 'Sem título';
    artistaEl.textContent = musica.artista || 'Artista desconhecido';

    if (musica.capa) {
        let caminhoCapa = BASE_URL + '/uploads/capas/' + musica.capa;
        console.log('Caminho da capa:', caminhoCapa);
        capaImg.src = caminhoCapa;
        capaImg.alt = musica.album || 'Capa';
    } else {
        console.warn('Capa não encontrada para a música:', musica.id);
        capaImg.src = BASE_URL + '/assets/images/default-cover.png';
        capaImg.alt = 'Capa padrão';
    }

    if (!audio.paused) {
        await audio.pause();
    }

    audio.src = BASE_URL + '/uploads/musicas/' + musica.arquivo;
    audio.load();

    await new Promise((resolve) => {
        if (audio.readyState >= 2) {
            resolve();
        } else {
            audio.addEventListener('canplay', resolve, { once: true });
        }
    });

    audio.removeEventListener('loadedmetadata', atualizarDuracao);
    audio.removeEventListener('timeupdate', atualizarProgresso);
    audio.removeEventListener('ended', tocarProxima);

    audio.addEventListener('loadedmetadata', atualizarDuracao);
    audio.addEventListener('timeupdate', atualizarProgresso);
    audio.addEventListener('ended', tocarProxima);

    musicaAtual = musica;
    isPlaying = false;
    btnPlay.innerHTML = '<i class="bi bi-play-fill"></i>';

    mostrarPlayer();

    async function carregarMusica(musica) {
    if (!musica) return;

    console.log('Dados recebidos em carregarMusica:', musica);

    if (musica.id) {
        registrarHistorico(musica.id);
    }

    tituloEl.textContent = musica.titulo || 'Sem título';
    artistaEl.textContent = musica.artista || 'Artista desconhecido';

}
}

function tocarMusicaPorId(id) {
    console.log('tocarMusica chamada com ID:', id);
    
    btnPlay.innerHTML = '<div class="spinner-border spinner-border-sm text-light" role="status"><span class="visually-hidden">Loading...</span></div>';
    btnPlay.disabled = true;

    fetch(BASE_URL + '/player/dados/' + id)
        .then(response => {
            console.log('Resposta da API:', response.status); 
            if (!response.ok) {
                throw new Error('Erro ao carregar música: ' + response.status);
            }
            return response.json();
        })
        .then(async (musica) => {
            if (musica.error) {
                throw new Error(musica.error);
            }
            
            fetch(BASE_URL + '/player/reproduzir/' + id, { method: 'POST' })
                .catch(err => console.warn('Não foi possível registrar reprodução'));

            await carregarMusica(musica);
            await play();
        })
        .catch(error => {
            console.error('Erro:', error);
            mostrarMensagemErro('Não foi possível carregar a música. Tente novamente.');
            esconderPlayer();
        })
        .finally(() => {
            btnPlay.disabled = false;
            if (!musicaAtual) {
                btnPlay.innerHTML = '<i class="bi bi-play-fill"></i>';
            }
        });
}

async function play() {
    if (!musicaAtual) return;
    try {
        await audio.play();
    } catch (error) {
        console.warn('Erro ao reproduzir:', error);
        setTimeout(async () => {
            try {
                await audio.play();
            } catch (retryError) {
                console.error('Falha ao reproduzir mesmo após tentar novamente:', retryError);
            }
        }, 300);
    }
}


function pause() {
    audio.pause();
}

function togglePlay() {
    if (audio.paused) {
        play();
    } else {
        pause();
    }
}

function tocarProxima() {
    console.log('tocarProxima chamada. fila:', fila, 'indiceAtual:', indiceAtual);
    const proximo = getProximoIndice();
    if (proximo === -1) {
        esconderPlayer();
        audio.pause();
        audio.currentTime = 0;
        btnPlay.innerHTML = '<i class="bi bi-play-fill"></i>';
        return;
    }
    indiceAtual = proximo;
    tocarMusicaPorId(fila[indiceAtual]);
}

function tocarAnterior() {
    if (fila.length === 0) {
        return;
    }
    const anterior = getAnteriorIndice();
    if (anterior === -1) {
        audio.currentTime = 0;
        return;
    }
    if (audio.currentTime > 3 && repeatMode !== 'one') {
        audio.currentTime = 0;
        return;
    }
    indiceAtual = anterior;
    tocarMusicaPorId(fila[indiceAtual]);
}

function definirFila(listaIds) {
    filaOriginal = [...listaIds];
    fila = [...listaIds];
    indiceAtual = 0;
    salvarEstadoPlayer();
}

function tocarMusica(botao, id, arquivo, titulo, artista, album, capa) {
    tocarMusicaPorId(id);
}

function formatarTempo(segundos) {
    if (isNaN(segundos) || segundos === Infinity) {
        return '0:00';
    }
    const min = Math.floor(segundos / 60);
    const sec = Math.floor(segundos % 60);
    return min + ':' + String(sec).padStart(2, '0');
}

function salvarEstadoPlayer() {
    const estado = {
        shuffle: shuffle,
        repeatMode: repeatMode,
        filaOriginal: filaOriginal,
        volume: audio.volume
    };
    sessionStorage.setItem('playerEstado', JSON.stringify(estado));
    console.log('Estado salvo:', estado); 
}

function carregarEstadoPlayer() {
    const saved = sessionStorage.getItem('playerEstado');
    console.log('Estado carregado:', saved); 
    if (saved) {
        try {
            const estado = JSON.parse(saved);
            shuffle = estado.shuffle || false;
            repeatMode = estado.repeatMode || 'none';
            filaOriginal = estado.filaOriginal || [];
            
            if (estado.volume !== undefined && !isNaN(estado.volume)) {
                audio.volume = estado.volume;
                volumeSlider.value = estado.volume * 100;
                console.log('Volume restaurado para:', estado.volume);
            }
            
            const btnShuffle = document.getElementById('btn-shuffle');
            if (btnShuffle && shuffle) {
                btnShuffle.classList.add('btn-shuffle-active');
            }
            
            const btnRepeat = document.getElementById('btn-repeat');
            if (btnRepeat) {
                if (repeatMode === 'one') {
                    btnRepeat.classList.add('btn-repeat-one-active');
                } else if (repeatMode === 'all') {
                    btnRepeat.classList.add('btn-repeat-active');
                }
            }
        } catch (e) {
            console.warn('Erro ao carregar estado do player:', e);
        }
    }
}

function mostrarMensagemErro(mensagem) {
    const alertasAntigos = document.querySelectorAll('.alerta-flutuante');
    alertasAntigos.forEach(el => el.remove());
    
    const msg = document.createElement('div');
    msg.className = 'alerta-flutuante alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3';
    msg.style.zIndex = '9999';
    msg.style.minWidth = '300px';
    msg.style.maxWidth = '90%';
    msg.style.boxShadow = '0 4px 20px rgba(0,0,0,0.5)';
    msg.innerHTML = `
        <i class="bi bi-exclamation-triangle me-2"></i>
        ${mensagem}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    document.body.appendChild(msg);
    
    setTimeout(() => {
        if (msg.parentNode) {
            msg.classList.remove('show');
            setTimeout(() => msg.remove(), 300);
        }
    }, 5000);
}

function registrarHistorico(musicaId) {
    console.log('Registrando histórico para música:', musicaId);
    
    fetch(BASE_URL + '/historico/registrar/' + musicaId, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        console.log('Resposta do histórico:', response.status);
        if (!response.ok) {
            console.warn('Erro ao registrar histórico:', response.status);
        }
        return response.json();
    })
    .then(data => {
        console.log('Dados retornados:', data);
    })
    .catch(err => console.warn('Erro ao registrar histórico:', err));
}

audio.addEventListener('play', function() {
    isPlaying = true;
    btnPlay.innerHTML = '<i class="bi bi-pause-fill"></i>';
});

audio.addEventListener('pause', function() {
    isPlaying = false;
    btnPlay.innerHTML = '<i class="bi bi-play-fill"></i>';
});


btnPlay.addEventListener('click', togglePlay);


btnNext.addEventListener('click', tocarProxima);


btnPrev.addEventListener('click', tocarAnterior);


progressBar.addEventListener('input', function() {
    if (!audio || !audio.duration || isNaN(audio.duration) || audio.duration === 0) {
        return;
    }
    
    const percentual = Math.min((this.value / audio.duration) * 100, 100);
    const isLight = document.documentElement.getAttribute('data-theme') === 'light';
    const bgColor = isLight ? '#d0d0d0' : '#4d4d4d';
    

    audio.currentTime = parseFloat(this.value);
    

    this.style.background = `linear-gradient(to right, #1db954 0%, #1db954 ${percentual}%, ${bgColor} ${percentual}%, ${bgColor} 100%)`;
});


volumeSlider.addEventListener('input', function() {
    const volumeValue = this.value / 100;
    audio.volume = volumeValue;
    salvarEstadoPlayer();
    

    const percentual = this.value;
    const bgColor = document.documentElement.getAttribute('data-theme') === 'light' ? '#d0d0d0' : '#4d4d4d';
    this.style.background = `linear-gradient(to right, #1db954 0%, #1db954 ${percentual}%, ${bgColor} ${percentual}%, ${bgColor} 100%)`;
});


document.addEventListener('DOMContentLoaded', function() {
    const volumeValue = volumeSlider.value;
    const bgColor = document.documentElement.getAttribute('data-theme') === 'light' ? '#d0d0d0' : '#4d4d4d';
    volumeSlider.style.background = `linear-gradient(to right, #1db954 0%, #1db954 ${volumeValue}%, ${bgColor} ${volumeValue}%, ${bgColor} 100%)`;
});

const btnShuffle = document.getElementById('btn-shuffle');
const btnRepeat = document.getElementById('btn-repeat');

volumeSlider.addEventListener('input', function() {
    audio.volume = this.value / 100;
    console.log('Volume alterado para:', audio.volume);
    salvarEstadoPlayer();
});

if (btnShuffle) {
    btnShuffle.addEventListener('click', toggleShuffle);
}

if (btnRepeat) {
    btnRepeat.addEventListener('click', toggleRepeat);
}

document.addEventListener('DOMContentLoaded', function() {
    carregarEstadoPlayer();
});


function tocarMusicaComFila(musicaId, listaIds) {
    console.log('tocarMusicaComFila - ID:', musicaId, 'Lista:', listaIds);
    
    if (!listaIds || listaIds.length === 0) {
        tocarMusicaPorId(musicaId);
        return;
    }
    
    definirFila(listaIds);

    indiceAtual = listaIds.indexOf(musicaId);
    if (indiceAtual === -1) indiceAtual = 0;
    
    console.log('Índice atual:', indiceAtual, 'Fila:', fila);
    
    tocarMusicaPorId(listaIds[indiceAtual]);
}