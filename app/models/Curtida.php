<?php

class Curtida
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function curtir(int $usuarioId, int $musicaId): bool
    {
        $sql = "
            INSERT IGNORE INTO curtidas
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

    public function descurtir(int $usuarioId, int $musicaId): bool
    {
        $sql = "
            DELETE FROM curtidas
            WHERE usuario_id = ?
            AND musica_id = ?
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $usuarioId,
            $musicaId
        ]);
    }

    public function usuarioCurtiu(int $usuarioId, int $musicaId): bool
    {
        $sql = "
            SELECT id
            FROM curtidas
            WHERE usuario_id = ?
            AND musica_id = ?
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            $usuarioId,
            $musicaId
        ]);

        return $stmt->fetch() !== false;
    }

    public function totalCurtidas(int $musicaId): int
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM curtidas
            WHERE musica_id = ?
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([$musicaId]);

        return (int)$stmt->fetch()['total'];
    }
    public function listarCurtidas(int $usuarioId): array
{
    $sql = "
        SELECT
            musicas.*,
            albuns.titulo AS album,
            albuns.capa,
            artistas.nome AS artista

        FROM curtidas

        INNER JOIN musicas
            ON musicas.id = curtidas.musica_id

        INNER JOIN albuns
            ON albuns.id = musicas.album_id

        INNER JOIN artistas
            ON artistas.id = albuns.artista_id

        WHERE curtidas.usuario_id = ?

        ORDER BY artistas.nome ASC,
                 albuns.titulo ASC,
                 musicas.numero_faixa ASC
    ";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        $usuarioId
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}