<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1>Login</h1>

<form action="" method="POST">

    <p>
        <label>E-mail</label><br>

        <input
            type="email"
            name="email"
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
        Entrar
    </button>

</form>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>