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
        console.log('Alternando tema...'); // 🔍 LOG
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
        console.log('Tema atual:', document.documentElement.getAttribute('data-theme')); // 🔍 LOG
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