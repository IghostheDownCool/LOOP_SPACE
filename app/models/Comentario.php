<?php

class Comentario extends Model
{
    public function criar(int $usuarioId, int $musicaId, string $comentario): bool
    {
        $sql = "
            INSERT INTO comentarios (usuario_id, musica_id, comentario)
            VALUES (:usuario_id, :musica_id, :comentario)
        ";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':usuario_id' => $usuarioId,
            ':musica_id' => $musicaId,
            ':comentario' => $comentario
        ]);
    }

    public function listarPorMusica(int $musicaId): array
    {
        $sql = "
            SELECT
                comentarios.*,
                usuarios.nome AS usuario_nome,
                usuarios.avatar AS usuario_avatar
            FROM comentarios
            INNER JOIN usuarios ON usuarios.id = comentarios.usuario_id
            WHERE comentarios.musica_id = :musica_id
            ORDER BY comentarios.criado_em DESC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':musica_id' => $musicaId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function excluir(int $id, int $usuarioId): bool
    {
        $sql = "
            DELETE FROM comentarios
            WHERE id = :id AND usuario_id = :usuario_id
        ";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':usuario_id' => $usuarioId
        ]);
    }

    public function contarPorMusica(int $musicaId): int
    {
        $sql = "
            SELECT COUNT(*) as total
            FROM comentarios
            WHERE musica_id = :musica_id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':musica_id' => $musicaId]);
        return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}