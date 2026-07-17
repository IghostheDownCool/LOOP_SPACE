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
    // 🔥 SQL com ON DUPLICATE KEY UPDATE (mais eficiente)
    $sql = "
        INSERT INTO historico (usuario_id, musica_id, data_reproducao)
        VALUES (:usuario_id, :musica_id, NOW())
        ON DUPLICATE KEY UPDATE data_reproducao = NOW()
    ";

    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        ':usuario_id' => $usuarioId,
        ':musica_id' => $musicaId
    ]);
}

public function listar(int $usuarioId): array
{
    $sql = "
        SELECT
            historico.data_reproducao,
            musicas.*,
            albuns.titulo AS album,
            albuns.capa,
            artistas.nome AS artista,
            artistas.id AS artista_id,
            albuns.id AS album_id
        FROM historico
        INNER JOIN musicas ON musicas.id = historico.musica_id
        INNER JOIN albuns ON albuns.id = musicas.album_id
        INNER JOIN artistas ON artistas.id = albuns.artista_id
        WHERE historico.usuario_id = :usuario_id
        ORDER BY historico.data_reproducao DESC
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':usuario_id' => $usuarioId]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    error_log("📝 Histórico encontrado: " . count($result) . " registros");
    
    return $result;
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