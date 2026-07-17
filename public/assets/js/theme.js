// ==================================================
// TEMA - MODOS CLARO E ESCURO
// ==================================================

document.addEventListener('DOMContentLoaded', function() {
    console.log('Theme.js carregado!'); // 🔍 LOG
    
    const toggleBtn = document.getElementById('theme-toggle');
    const tooltip = document.getElementById('theme-tooltip');
    
    console.log('Botão encontrado?', toggleBtn); // 🔍 LOG

    // Carrega o tema salvo no localStorage
    function carregarTema() {
        const temaSalvo = localStorage.getItem('theme');
        console.log('Tema salvo:', temaSalvo); // 🔍 LOG
        
        if (temaSalvo === 'light') {
            document.documentElement.setAttribute('data-theme', 'light');
            if (tooltip) tooltip.textContent = 'Tema claro';
        } else {
            document.documentElement.removeAttribute('data-theme');
            localStorage.setItem('theme', 'dark');
            if (tooltip) tooltip.textContent = 'Tema escuro';
        }
    }

    // Alterna entre os temas
    function alternarTema() {
    const temaAtual = document.documentElement.getAttribute('data-theme');
    if (temaAtual === 'light') {
        document.documentElement.removeAttribute('data-theme');
        localStorage.setItem('theme', 'dark');
        if (tooltip) tooltip.textContent = 'Tema escuro';
    } else {
        document.documentElement.setAttribute('data-theme', 'light');
        localStorage.setItem('theme', 'light');
        if (tooltip) tooltip.textContent = 'Tema claro';
    }
    
    // 🔥 ATUALIZA AS CORES DA BARRA DE PROGRESSO E VOLUME
    atualizarCoresBarras();
}

function atualizarCoresBarras() {
    const isLight = document.documentElement.getAttribute('data-theme') === 'light';
    const bgColor = isLight ? '#d0d0d0' : '#4d4d4d';
    
    // Atualiza barra de progresso
    const progressPercent = (audio.currentTime / audio.duration) * 100 || 0;
    progressBar.style.background = `linear-gradient(to right, #1db954 0%, #1db954 ${progressPercent}%, ${bgColor} ${progressPercent}%, ${bgColor} 100%)`;
    
    // Atualiza barra de volume
    const volumePercent = volumeSlider.value;
    volumeSlider.style.background = `linear-gradient(to right, #1db954 0%, #1db954 ${volumePercent}%, ${bgColor} ${volumePercent}%, ${bgColor} 100%)`;
}

    // Carrega o tema ao iniciar
    carregarTema();

    // Event listener do botão
    if (toggleBtn) {
        toggleBtn.addEventListener('click', alternarTema);
    } else {
        console.warn('Botão de tema não encontrado!');
    }
});