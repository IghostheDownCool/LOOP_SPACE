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

// Estado do player
let fila = [];
let indiceAtual = 0;
let musicaAtual = null;
let isPlaying = false;

// ==================================================
// FUNÇÕES DE CONTROLE
// ==================================================

function carregarMusica(musica) {
    if (!musica) return;

    // Atualiza os dados na interface
console.log('Dados recebidos em carregarMusica:', musica); // 🔍 LOG
tituloEl.textContent = musica.titulo || 'Sem título';
artistaEl.textContent = musica.artista || 'Artista desconhecido';

// Verifica se o campo capa existe
if (musica.capa) {
    let caminhoCapa = BASE_URL + '/uploads/capas/' + musica.capa;
    console.log('Caminho da capa:', caminhoCapa); // 🔍 LOG
    capaImg.src = caminhoCapa;
    capaImg.alt = musica.album || 'Capa';
} else {
    console.warn('Capa não encontrada para a música:', musica.id); // 🔍 LOG
    capaImg.src = BASE_URL + '/assets/images/default-cover.png';
    capaImg.alt = 'Capa padrão';
}

    // Define a fonte do áudio
    audio.src = BASE_URL + '/uploads/musicas/' + musica.arquivo;
    audio.load();

    // Atualiza a barra de progresso quando a música carregar
    audio.addEventListener('loadedmetadata', function() {
        tempoTotal.textContent = formatarTempo(audio.duration);
        progressBar.max = audio.duration;
        progressBar.value = 0;
    });

    // Atualiza o progresso durante a reprodução
    audio.addEventListener('timeupdate', function() {
        progressBar.value = audio.currentTime;
        tempoAtual.textContent = formatarTempo(audio.currentTime);
    });

    // Quando a música terminar, toca a próxima automaticamente
    audio.addEventListener('ended', function() {
        tocarProxima();
    });

    musicaAtual = musica;
    isPlaying = false; // será setado para true no play
    btnPlay.innerHTML = '<i class="bi bi-play-fill"></i>';
}

function tocarMusicaPorId(id) {
    console.log('tocarMusica chamada com ID:', id);
    // Busca os dados da música via AJAX
    fetch(BASE_URL + '/player/dados/' + id)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao carregar música');
            }
            return response.json();
        })
        .then(musica => {
            // Incrementa reprodução no backend (opcional)
            fetch(BASE_URL + '/player/reproduzir/' + id, { method: 'POST' })
                .catch(err => console.warn('Não foi possível registrar reprodução'));

            carregarMusica(musica);
            play();
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Não foi possível carregar a música.');
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
    if (fila.length === 0) return;
    indiceAtual = (indiceAtual + 1) % fila.length;
    tocarMusicaPorId(fila[indiceAtual]);
}

function tocarAnterior() {
    if (fila.length === 0) return;
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

// Botão Play/Pause
btnPlay.addEventListener('click', togglePlay);

// Botão Próximo
btnNext.addEventListener('click', tocarProxima);

// Botão Anterior
btnPrev.addEventListener('click', tocarAnterior);

// Barra de progresso (arrastar)
progressBar.addEventListener('input', function() {
    audio.currentTime = parseFloat(this.value);
});

// Controle de volume (já existe no volume.js, mas podemos manter)
volumeSlider.addEventListener('input', function() {
    audio.volume = this.value / 100;
});

// ==================================================
// FUNÇÃO PÚBLICA PARA SER CHAMADA PELOS BOTÕES DE PLAY
// ==================================================

// Esta função será chamada pelos botões "play" nas músicas
function tocarMusica(botao, id, arquivo, titulo, artista, album, capa) {
    // Opção 1: Se você quiser usar os parâmetros diretamente (sem AJAX)
    // Nesse caso, você pode montar o objeto música manualmente.
    // Mas é melhor usar o AJAX para garantir dados consistentes.

    // Vamos usar a função que busca via AJAX:
    tocarMusicaPorId(id);

    // Também atualizamos a fila (opcional)
    // Se você quiser criar uma fila a partir da lista atual, veja abaixo.
}

// ==================================================
// FUNÇÃO PARA DEFINIR A FILA (ex: quando entrar na página player)
// ==================================================

function definirFila(listaIds) {
    fila = listaIds;
    indiceAtual = 0;
}

// ==================================================
// FUNÇÃO DE FORMATAÇÃO DE TEMPO (já existente)
// ==================================================

function formatarTempo(segundos) {
    if (isNaN(segundos) || segundos === Infinity) {
        return '0:00';
    }
    const min = Math.floor(segundos / 60);
    const sec = Math.floor(segundos % 60);
    return min + ':' + String(sec).padStart(2, '0');
}