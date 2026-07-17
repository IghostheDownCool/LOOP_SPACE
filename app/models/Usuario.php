<?php

class Usuario
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
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
public function contar(): int
{
    $sql = "SELECT COUNT(*) as total FROM usuarios";
    $stmt = $this->pdo->query($sql);
    return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

public function ultimos(int $limite = 5): array
{
    $sql = "
        SELECT id, nome, email, data_cadastro AS created_at
        FROM usuarios
        ORDER BY data_cadastro DESC
        LIMIT :limite
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}