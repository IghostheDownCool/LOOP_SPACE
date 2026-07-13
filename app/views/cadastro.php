<?php require_once __DIR__ . '/layouts/header.php'; ?>

<h1>Cadastro de Usuário</h1>

<?php if (!empty($erros)): ?>

    <h3>Foram encontrados os seguintes erros:</h3>

    <ul>

        <?php foreach ($erros as $erro): ?>

            <li><?= htmlspecialchars($erro) ?></li>

        <?php endforeach; ?>

    </ul>

<?php endif; ?>

<form action="" method="POST">

    <p>
        <label>Nome</label><br>

        <input
            type="text"
            name="nome"
            value="<?= htmlspecialchars($old['nome']) ?>"
            required
        >
    </p>

    <p>
        <label>E-mail</label><br>

        <input
            type="email"
            name="email"
            value="<?= htmlspecialchars($old['email']) ?>"
            required
        >
    </p>

    <p>
        <label>Senha</label><br>

        <input
            type="password"
            name="senha"
            required
        >
    </p>

    <button type="submit">
        Cadastrar
    </button>

</form>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>