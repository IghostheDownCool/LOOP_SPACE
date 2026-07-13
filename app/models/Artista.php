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
}