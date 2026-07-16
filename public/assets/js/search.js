document.addEventListener('DOMContentLoaded', function () {

    const busca = document.getElementById('busca');

    if (!busca) {
        return;
    }

    busca.addEventListener('keyup', function () {

        const texto = busca.value.toLowerCase();

        document.querySelectorAll('.musica-item').forEach(function (item) {

            const pesquisa = item.dataset.search || '';

if (pesquisa.includes(texto)) {

                item.parentElement.style.display = '';

            } else {

                item.parentElement.style.display = 'none';

            }

        });

    });

});