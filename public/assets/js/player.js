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
// FUNÇÕES DE VISIBILIDADE DO PLAYER
// ==================================================

function mostrarPlayer() {
    playerElement.classList.add('active');
}

function esconderPlayer() {
    playerElement.classList.remove('active');
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
    if (fila.length === 0) {
        esconderPlayer();
        audio.pause();
        audio.currentTime = 0;
        btnPlay.innerHTML = '<i class="bi bi-play-fill"></i>';
        return;
    }
    indiceAtual = (indiceAtual + 1) % fila.length;
    tocarMusicaPorId(fila[indiceAtual]);
}

function tocarAnterior() {
    if (fila.length === 0) {
        return;
    }
    // Se já passou mais de 3 segundos, volta ao início da música atual
    if (audio.currentTime > 3) {
        audio.currentTime = 0;
        return;
    }
    indiceAtual = (indiceAtual - 1 + fila.length) % fila.length;
    tocarMusicaPorId(fila[indiceAtual]);
}

function definirFila(listaIds) {
    fila = listaIds;
    indiceAtual = 0;
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
});