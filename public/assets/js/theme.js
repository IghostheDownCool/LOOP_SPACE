document.addEventListener('DOMContentLoaded', function() {
    console.log('Theme.js carregado!'); 
    
    const toggleBtn = document.getElementById('theme-toggle');
    const tooltip = document.getElementById('theme-tooltip');
    
    console.log('Botão encontrado?', toggleBtn); 

    function carregarTema() {
        const temaSalvo = localStorage.getItem('theme');
        console.log('Tema salvo:', temaSalvo); 
        
        if (temaSalvo === 'light') {
            document.documentElement.setAttribute('data-theme', 'light');
            if (tooltip) tooltip.textContent = 'Tema claro';
        } else {
            document.documentElement.removeAttribute('data-theme');
            localStorage.setItem('theme', 'dark');
            if (tooltip) tooltip.textContent = 'Tema escuro';
        }
    }

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
    
    atualizarCoresBarras();
}

function atualizarCoresBarras() {
    const isLight = document.documentElement.getAttribute('data-theme') === 'light';
    const bgColor = isLight ? '#d0d0d0' : '#4d4d4d';
    
    const progressPercent = (audio.currentTime / audio.duration) * 100 || 0;
    progressBar.style.background = `linear-gradient(to right, #1db954 0%, #1db954 ${progressPercent}%, ${bgColor} ${progressPercent}%, ${bgColor} 100%)`;
    
    const volumePercent = volumeSlider.value;
    volumeSlider.style.background = `linear-gradient(to right, #1db954 0%, #1db954 ${volumePercent}%, ${bgColor} ${volumePercent}%, ${bgColor} 100%)`;
}

    carregarTema();

    if (toggleBtn) {
        toggleBtn.addEventListener('click', alternarTema);
    } else {
        console.warn('Botão de tema não encontrado!');
    }
});