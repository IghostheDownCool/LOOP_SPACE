// ==================================================
// PLAYER GLOBAL - LOOP SPACE
// ==================================================

// Elementos do DOM
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

// Estado do player
let fila = [];
let indiceAtual = 0;
let musicaAtual = null;
let isPlaying = false;

// ==================================================
// ESTADOS DO PLAYER AVANÇADO
// ==================================================

let shuffle = false;
let repeatMode = 'none'; // 'none', 'one', 'all'
let filaOriginal = [];

// ==================================================
// FUNÇÕES DE VISIBILIDADE DO PLAYER
// ==================================================

function mostrarPlayer() {
    playerElement.classList.add('active');
}

function esconderPlayer() {
    playerElement.classList.remove('active');
}

// ==================================================
// FUNÇÕES DE SHUFFLE E REPETIÇÃO
// ==================================================

function toggleShuffle() {
    shuffle = !shuffle;
    const btn = document.getElementById('btn-shuffle');
    btn.classList.toggle('btn-shuffle-active', shuffle);
    
    if (shuffle) {
        // Embaralha a fila
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
        // Restaura a fila original
        if (filaOriginal.length > 0) {
            fila = [...filaOriginal];
            filaOriginal = [];
        }
        // Encontra o índice da música atual na fila restaurada
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
    
    // none
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

// ==================================================
// FUNÇÕES DE CONTROLE
// ==================================================

function atualizarDuracao() {
    tempoTotal.textContent = formatarTempo(audio.duration);
    progressBar.max = audio.duration;
    progressBar.value = 0;
}

function atualizarProgresso() {
    progressBar.value = audio.currentTime;
    tempoAtual.textContent = formatarTempo(audio.currentTime);
}

async function carregarMusica(musica) {
    if (!musica) return;

    console.log('Dados recebidos em carregarMusica:', musica);

    // Atualiza título e artista
    tituloEl.textContent = musica.titulo || 'Sem título';
    artistaEl.textContent = musica.artista || 'Artista desconhecido';

    // Verifica a capa
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

    // Pausa a música atual antes de trocar
    if (!audio.paused) {
        await audio.pause();
    }

    // Define a nova fonte
    audio.src = BASE_URL + '/uploads/musicas/' + musica.arquivo;
    audio.load();

    // Espera o carregamento terminar
    await new Promise((resolve) => {
        if (audio.readyState >= 2) {
            resolve();
        } else {
            audio.addEventListener('canplay', resolve, { once: true });
        }
    });

    // Remove event listeners antigos para evitar duplicação
    audio.removeEventListener('loadedmetadata', atualizarDuracao);
    audio.removeEventListener('timeupdate', atualizarProgresso);
    audio.removeEventListener('ended', tocarProxima);

    // Adiciona os listeners
    audio.addEventListener('loadedmetadata', atualizarDuracao);
    audio.addEventListener('timeupdate', atualizarProgresso);
    audio.addEventListener('ended', tocarProxima);

    musicaAtual = musica;
    isPlaying = false;
    btnPlay.innerHTML = '<i class="bi bi-play-fill"></i>';

    // Mostra o player
    mostrarPlayer();
}

function tocarMusicaPorId(id) {
    console.log('tocarMusica chamada com ID:', id);

    fetch(BASE_URL + '/player/dados/' + id)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao carregar música');
            }
            return response.json();
        })
        .then(async (musica) => {
            // Incrementa reprodução no backend
            fetch(BASE_URL + '/player/reproduzir/' + id, { method: 'POST' })
                .catch(err => console.warn('Não foi possível registrar reprodução'));

            await carregarMusica(musica);
            await play();
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Não foi possível carregar a música.');
            esconderPlayer();
        });
}

async function play() {
    if (!musicaAtual) return;
    try {
        await audio.play();
        // O evento 'play' vai atualizar o ícone e isPlaying
    } catch (error) {
        console.warn('Erro ao reproduzir:', error);
        // Tenta novamente após um pequeno delay
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
    audio.pause(); // O evento 'pause' vai atualizar o ícone e isPlaying
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
    // Se já passou mais de 3 segundos, volta ao início da música atual
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

// ==================================================
// FUNÇÃO PÚBLICA PARA SER CHAMADA PELOS BOTÕES DE PLAY
// ==================================================

function tocarMusica(botao, id, arquivo, titulo, artista, album, capa) {
    tocarMusicaPorId(id);
}

// ==================================================
// FUNÇÃO DE FORMATAÇÃO DE TEMPO
// ==================================================

function formatarTempo(segundos) {
    if (isNaN(segundos) || segundos === Infinity) {
        return '0:00';
    }
    const min = Math.floor(segundos / 60);
    const sec = Math.floor(segundos % 60);
    return min + ':' + String(sec).padStart(2, '0');
}

// ==================================================
// PERSISTÊNCIA DO ESTADO
// ==================================================

function salvarEstadoPlayer() {
    const estado = {
        shuffle: shuffle,
        repeatMode: repeatMode,
        filaOriginal: filaOriginal,
        volume: audio.volume
    };
    sessionStorage.setItem('playerEstado', JSON.stringify(estado));
}

function carregarEstadoPlayer() {
    const saved = sessionStorage.getItem('playerEstado');
    if (saved) {
        try {
            const estado = JSON.parse(saved);
            shuffle = estado.shuffle || false;
            repeatMode = estado.repeatMode || 'none';
            filaOriginal = estado.filaOriginal || [];
            
            // Restaura volume
            if (estado.volume !== undefined) {
                audio.volume = estado.volume;
                volumeSlider.value = estado.volume * 100;
            }
            
            // Atualiza UI dos botões
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

// ==================================================
// INICIALIZAÇÃO DOS EVENTOS (APENAS UMA VEZ)
// ==================================================

// Sincroniza o estado com os eventos do áudio
audio.addEventListener('play', function() {
    isPlaying = true;
    btnPlay.innerHTML = '<i class="bi bi-pause-fill"></i>';
});

audio.addEventListener('pause', function() {
    isPlaying = false;
    btnPlay.innerHTML = '<i class="bi bi-play-fill"></i>';
});

// Botão Play/Pause
btnPlay.addEventListener('click', togglePlay);

// Botão Próximo
btnNext.addEventListener('click', tocarProxima);

// Botão Anterior
btnPrev.addEventListener('click', tocarAnterior);

// Barra de progresso
progressBar.addEventListener('input', function() {
    audio.currentTime = parseFloat(this.value);
});

// Volume
volumeSlider.addEventListener('input', function() {
    audio.volume = this.value / 100;
    salvarEstadoPlayer();
});

// ==================================================
// EVENT LISTENERS PARA SHUFFLE E REPETIÇÃO
// ==================================================

const btnShuffle = document.getElementById('btn-shuffle');
const btnRepeat = document.getElementById('btn-repeat');

if (btnShuffle) {
    btnShuffle.addEventListener('click', toggleShuffle);
}

if (btnRepeat) {
    btnRepeat.addEventListener('click', toggleRepeat);
}

// Carrega o estado salvo ao iniciar
document.addEventListener('DOMContentLoaded', function() {
    carregarEstadoPlayer();
});