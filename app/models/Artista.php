<?php

class Artista
{
    private PDO $pdo;

    public function __construct()
{
    $this->pdo = Database::connect();
}

    public function listar(): array
    {
        $sql = "SELECT * FROM artistas ORDER BY nome ASC";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function cadastrar(string $nome): bool
{
    $sql = "INSERT INTO artistas (nome) VALUES (:nome)";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':nome' => $nome
    ]);
}
}