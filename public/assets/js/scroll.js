// ==================================================
// BOTÃO VOLTAR AO TOPO
// ==================================================

document.addEventListener('DOMContentLoaded', function() {
    const btnTopo = document.getElementById('btn-topo');

    if (!btnTopo) return;

    // Mostra/esconde o botão baseado no scroll
    window.addEventListener('scroll', function() {
        if (window.scrollY > 400) {
            btnTopo.classList.add('show');
        } else {
            btnTopo.classList.remove('show');
        }
    });

    // Scroll suave ao clicar
    btnTopo.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});