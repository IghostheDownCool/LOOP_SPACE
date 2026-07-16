<?php

/*
|--------------------------------------------------------------------------
| Componente de Música
|--------------------------------------------------------------------------
|
| Variável esperada:
| $musica
|
*/
?>

<div class="music-card">

    <strong>

        <?= htmlspecialchars($musica['titulo']) ?>

    </strong>

    <br>

    <small>

        <?= htmlspecialchars($musica['artista']) ?>

        •

        <?= htmlspecialchars($musica['album']) ?>

    </small>

</div>