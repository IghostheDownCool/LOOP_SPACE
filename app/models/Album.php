<?php

class Album
{
    private PDO $pdo;

    public function __construct()
    {
        $database = new Database();

        $this->pdo = $database->connect();
    }

    public function listar(): array
    {
        $sql = "
            SELECT
                albuns.*,
                artistas.nome AS artista
            FROM albuns
            INNER JOIN artistas
                ON artistas.id = albuns.artista_id
            ORDER BY albuns.id ASC
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}