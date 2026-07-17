<?php

class Seguidor extends Model
{
    public function seguir(int $usuarioId, int $artistaId): bool
    {
        $sql = "
            INSERT IGNORE INTO seguidores (usuario_id, artista_id)
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
            DELETE FROM seguidores
            WHERE usuario_id = :usuario_id
            AND artista_id = :artista_id
        ";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':usuario_id' => $usuarioId,
            ':artista_id' => $artistaId
        ]);
    }

    public function estaSeguindo(int $usuarioId, int $artistaId): bool
    {
        $sql = "
            SELECT COUNT(*) as total
            FROM seguidores
            WHERE usuario_id = :usuario_id
            AND artista_id = :artista_id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':usuario_id' => $usuarioId,
            ':artista_id' => $artistaId
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] > 0;
    }

    public function listarArtistasSeguidos(int $usuarioId): array
    {
        $sql = "
            SELECT
                artistas.*,
                seguidores.data_seguiu
            FROM seguidores
            INNER JOIN artistas ON artistas.id = seguidores.artista_id
            WHERE seguidores.usuario_id = :usuario_id
            ORDER BY seguidores.data_seguiu DESC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':usuario_id' => $usuarioId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarMusicasDosArtistasSeguidos(int $usuarioId, int $limite = 10): array
    {
        $sql = "
            SELECT
                musicas.*,
                albuns.titulo AS album,
                albuns.capa,
                artistas.nome AS artista,
                artistas.id AS artista_id,
                albuns.id AS album_id
            FROM seguidores
            INNER JOIN artistas ON artistas.id = seguidores.artista_id
            INNER JOIN albuns ON albuns.artista_id = artistas.id
            INNER JOIN musicas ON musicas.album_id = albuns.id
            WHERE seguidores.usuario_id = :usuario_id
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