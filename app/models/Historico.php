<?php

class Historico
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function registrar(int $usuarioId, int $musicaId): bool
    {
        $sql = "
            INSERT INTO historico
            (usuario_id, musica_id)
            VALUES
            (?, ?)
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $usuarioId,
            $musicaId
        ]);
    }

    public function listar(int $usuarioId): array
    {
        $sql = "
            SELECT
                musicas.*,
                albuns.titulo AS album,
                albuns.capa,
                artistas.nome AS artista,
                historico.data_reproducao

            FROM historico

            INNER JOIN musicas
                ON musicas.id = historico.musica_id

            INNER JOIN albuns
                ON albuns.id = musicas.album_id

            INNER JOIN artistas
                ON artistas.id = albuns.artista_id

            WHERE historico.usuario_id = ?

            ORDER BY historico.data_reproducao DESC
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            $usuarioId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function artistasMaisOuvidos(int $usuarioId, int $limite = 5): array
{
    $sql = "
        SELECT
            artistas.id,
            artistas.nome,
            COUNT(historico.id) AS total
        FROM historico
        INNER JOIN musicas ON musicas.id = historico.musica_id
        INNER JOIN albuns ON albuns.id = musicas.album_id
        INNER JOIN artistas ON artistas.id = albuns.artista_id
        WHERE historico.usuario_id = :usuario_id
        GROUP BY artistas.id
        ORDER BY total DESC
        LIMIT :limite
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':usuario_id', $usuarioId, PDO::PARAM_INT);
    $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);  // 🔥 FORÇA COMO INTEIRO
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}