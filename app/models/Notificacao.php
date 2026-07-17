<?php

class Notificacao extends Model
{
    public function criar(int $usuarioId, string $tipo, string $mensagem, ?string $link = null): bool
    {
        $sql = "
            INSERT INTO notificacoes (usuario_id, tipo, mensagem, link)
            VALUES (:usuario_id, :tipo, :mensagem, :link)
        ";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':usuario_id' => $usuarioId,
            ':tipo' => $tipo,
            ':mensagem' => $mensagem,
            ':link' => $link
        ]);
    }

    public function listar(int $usuarioId, int $limite = 20): array
    {
        $sql = "
            SELECT *
            FROM notificacoes
            WHERE usuario_id = :usuario_id
            ORDER BY criado_em DESC
            LIMIT :limite
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':usuario_id', $usuarioId, PDO::PARAM_INT);
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contarNaoLidas(int $usuarioId): int
    {
        $sql = "
            SELECT COUNT(*) as total
            FROM notificacoes
            WHERE usuario_id = :usuario_id AND lida = 0
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':usuario_id' => $usuarioId]);
        return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function marcarComoLida(int $id, int $usuarioId): bool
    {
        $sql = "
            UPDATE notificacoes
            SET lida = 1
            WHERE id = :id AND usuario_id = :usuario_id
        ";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':usuario_id' => $usuarioId
        ]);
    }

    public function marcarTodasComoLidas(int $usuarioId): bool
    {
        $sql = "
            UPDATE notificacoes
            SET lida = 1
            WHERE usuario_id = :usuario_id AND lida = 0
        ";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':usuario_id' => $usuarioId]);
    }
}