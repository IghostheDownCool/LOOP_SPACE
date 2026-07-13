<?php

class Usuario
{
    private PDO $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();
    }

    public function cadastrar(string $nome, string $email, string $senha): bool
    {
        $sql = "INSERT INTO usuarios (nome, email, senha)
                VALUES (:nome, :email, :senha)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senha
        ]);
    }
    public function buscarPorEmail(string $email): bool
{
    $sql = "SELECT id FROM usuarios WHERE email = :email LIMIT 1";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        ':email' => $email
    ]);

    return $stmt->fetch() !== false;
}
public function buscarPorEmailLogin(string $email)
{
    $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        ':email' => $email
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}