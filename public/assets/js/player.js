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

function carregarMusica(musica) {
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

    // Define a fonte do áudio
    audio.src = BASE_URL + '/uploads/musicas/' + musica.arquivo;
    audio.load();

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

    // 🔥 MOSTRA O PLAYER
    mostrarPlayer();
}

// Funções auxiliares para os event listeners
function atualizarDuracao() {
    tempoTotal.textContent = formatarTempo(audio.duration);
    progressBar.max = audio.duration;
    progressBar.value = 0;
}

function atualizarProgresso() {
    progressBar.value = audio.currentTime;
    tempoAtual.textContent = formatarTempo(audio.currentTime);
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
        .then(musica => {
            // Incrementa reprodução no backend
            fetch(BASE_URL + '/player/reproduzir/' + id, { method: 'POST' })
                .catch(err => console.warn('Não foi possível registrar reprodução'));

            carregarMusica(musica);
            play();
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Não foi possível carregar a música.');
            esconderPlayer();
        });
}

function play() {
    if (!musicaAtual) return;
    audio.play();
    isPlaying = true;
    btnPlay.innerHTML = '<i class="bi bi-pause-fill"></i>';
}

function pause() {
    audio.pause();
    isPlaying = false;
    btnPlay.innerHTML = '<i class="bi bi-play-fill"></i>';
}

function togglePlay() {
    if (isPlaying) {
        pause();
    } else {
        play();
    }
}

function tocarProxima() {
    if (fila.length === 0) {
        esconderPlayer();  // Se não houver fila, esconde o player
        return;
    }
    indiceAtual = (indiceAtual + 1) % fila.length;
    tocarMusicaPorId(fila[indiceAtual]);
}

function tocarAnterior() {
    if (fila.length === 0) {
        esconderPlayer();
        return;
    }
    // Se já passou mais de 3 segundos, volta ao início da música
    if (audio.currentTime > 3) {
        audio.currentTime = 0;
        return;
    }
    indiceAtual = (indiceAtual - 1 + fila.length) % fila.length;
    tocarMusicaPorId(fila[indiceAtual]);
}

// ==================================================
// INICIALIZAÇÃO DOS EVENTOS
// ==================================================

btnPlay.addEventListener('click', togglePlay);
btnNext.addEventListener('click', tocarProxima);
btnPrev.addEventListener('click', tocarAnterior);

progressBar.addEventListener('input', function() {
    audio.currentTime = parseFloat(this.value);
});

volumeSlider.addEventListener('input', function() {
    audio.volume = this.value / 100;
});

// ==================================================
// FUNÇÃO PÚBLICA PARA SER CHAMADA PELOS BOTÕES DE PLAY
// ==================================================

function tocarMusica(botao, id, arquivo, titulo, artista, album, capa) {
    tocarMusicaPorId(id);
}

// ==================================================
// FUNÇÃO PARA DEFINIR A FILA
// ==================================================

function definirFila(listaIds) {
    fila = listaIds;
    indiceAtual = 0;
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