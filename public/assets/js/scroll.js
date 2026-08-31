document.addEventListener('DOMContentLoaded', function() {
    const btnTopo = document.getElementById('btn-topo');

    if (!btnTopo) return;

    window.addEventListener('scroll', function() {
        if (window.scrollY > 400) {
            btnTopo.classList.add('show');
        } else {
            btnTopo.classList.remove('show');
        }
    });

    btnTopo.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});