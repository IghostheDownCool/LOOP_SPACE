<?php

class Artista extends Model
{
    public function listar(): array
{
    $sql = "
        SELECT id, nome, foto
        FROM artistas
        ORDER BY nome ASC
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function buscarPorId(int $id): array|false
{
    $sql = "
        SELECT id, nome, foto
        FROM artistas
        WHERE id = :id
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    public function cadastrar(string $nome, ?string $foto = null): bool
{
    $sql = "
        INSERT INTO artistas (nome, foto)
        VALUES (:nome, :foto)
    ";

    $stmt = $this->pdo->prepare($sql);
    $result = $stmt->execute([
        ':nome' => $nome,
        ':foto' => $foto
    ]);

    // 🔍 DIAGNÓSTICO (SEM EXIT)
    var_dump([
        'sql' => $sql,
        'nome' => $nome,
        'foto' => $foto,
        'result' => $result,
        'error' => $stmt->errorInfo()
    ]);
    // NÃO USE exit AQUI!

    return $result;
}

    public function atualizar(int $id, string $nome, ?string $foto = null): bool
{
    $sql = "
        UPDATE artistas
        SET nome = :nome, foto = :foto
        WHERE id = :id
    ";

    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        ':id' => $id,
        ':nome' => $nome,
        ':foto' => $foto
    ]);
}

    public function excluir(int $id): bool
    {
        $sql = "DELETE FROM artistas
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }

    public function buscarCompleto(int $id): array|false
{
    $sql = "
        SELECT
            artistas.*,
            COUNT(DISTINCT albuns.id) AS total_albuns,
            COUNT(DISTINCT musicas.id) AS total_musicas
        FROM artistas
        LEFT JOIN albuns ON albuns.artista_id = artistas.id
        LEFT JOIN musicas ON musicas.album_id = albuns.id
        WHERE artistas.id = :id
        GROUP BY artistas.id
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function listarMusicas(int $artistaId): array
{
    $sql = "
        SELECT
            musicas.*,
            albuns.titulo AS album,
            albuns.capa,
            artistas.nome AS artista
        FROM musicas
        INNER JOIN albuns ON albuns.id = musicas.album_id
        INNER JOIN artistas ON artistas.id = albuns.artista_id
        WHERE artistas.id = :artista_id
        ORDER BY albuns.titulo, musicas.numero_faixa
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':artista_id' => $artistaId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function listarAlbuns(int $artistaId): array
{
    $sql = "
        SELECT *
        FROM albuns
        WHERE artista_id = :artista_id
        ORDER BY ano DESC, titulo
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':artista_id' => $artistaId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function seguir(int $usuarioId, int $artistaId): bool
{
    $sql = "
        INSERT IGNORE INTO seguidores_artistas (usuario_id, artista_id)
        VALUES (:usuario_id, :artista_id)
    ";

    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        ':usuario_id' => $usuarioId,
        ':artista_id' => $artistaId
    ]);
}

public function deixarSeguir(int $usuarioId, int $artistaId): bool
{
    $sql = "
        DELETE FROM seguidores_artistas
        WHERE usuario_id = :usuario_id AND artista_id = :artista_id
    ";

    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        ':usuario_id' => $usuarioId,
        ':artista_id' => $artistaId
    ]);
}

public function usuarioSegue(int $usuarioId, int $artistaId): bool
{
    $sql = "
        SELECT COUNT(*) as total
        FROM seguidores_artistas
        WHERE usuario_id = :usuario_id AND artista_id = :artista_id
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        ':usuario_id' => $usuarioId,
        ':artista_id' => $artistaId
    ]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return ($result['total'] ?? 0) > 0;
}

public function listarSeguidos(int $usuarioId): array
{
    $sql = "
        SELECT
            artistas.*,
            (SELECT COUNT(*) FROM seguidores_artistas WHERE artista_id = artistas.id) AS total_seguidores
        FROM seguidores_artistas
        INNER JOIN artistas ON artistas.id = seguidores_artistas.artista_id
        WHERE seguidores_artistas.usuario_id = :usuario_id
        ORDER BY artistas.nome ASC
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':usuario_id' => $usuarioId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getMusicasDosSeguidos(int $usuarioId, int $limite = 20): array
{
    $sql = "
        SELECT
            musicas.*,
            albuns.titulo AS album,
            albuns.capa,
            artistas.nome AS artista,
            artistas.id AS artista_id,
            albuns.id AS album_id
        FROM seguidores_artistas
        INNER JOIN artistas ON artistas.id = seguidores_artistas.artista_id
        INNER JOIN albuns ON albuns.artista_id = artistas.id
        INNER JOIN musicas ON musicas.album_id = albuns.id
        WHERE seguidores_artistas.usuario_id = :usuario_id
        ORDER BY RAND()
        LIMIT :limite
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':usuario_id', $usuarioId, PDO::PARAM_INT);
    $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}