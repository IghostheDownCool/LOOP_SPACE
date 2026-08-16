<?php

class HistoricoNavegacao extends Model
{

    use SoftDelete;

    public function salvar(int $usuarioId, string $tipo, int $itemId, string $titulo, string $link, ?string $imagem = null): bool
    {
        // Verifica se já existe um registro igual
        $sqlCheck = "
            SELECT id FROM historico_navegacao
            WHERE usuario_id = :usuario_id 
              AND tipo = :tipo 
              AND item_id = :item_id
        ";
        $stmtCheck = $this->pdo->prepare($sqlCheck);
        $stmtCheck->execute([
            ':usuario_id' => $usuarioId,
            ':tipo' => $tipo,
            ':item_id' => $itemId
        ]);
        $exists = $stmtCheck->fetch();

        if ($exists) {
            // Atualiza a data
            $sql = "
                UPDATE historico_navegacao
                SET criado_em = NOW()
                WHERE id = :id
            ";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([':id' => $exists['id']]);
        } else {
            // Insere novo
            $sql = "
                INSERT INTO historico_navegacao 
                (usuario_id, tipo, item_id, titulo, link, imagem)
                VALUES (:usuario_id, :tipo, :item_id, :titulo, :link, :imagem)
            ";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ':usuario_id' => $usuarioId,
                ':tipo' => $tipo,
                ':item_id' => $itemId,
                ':titulo' => $titulo,
                ':link' => $link,
                ':imagem' => $imagem
            ]);
        }
    }

    public function listar(int $usuarioId, int $limite = 10): array
    {
        $sql = "
            SELECT *
            FROM historico_navegacao
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

    public function limpar(int $usuarioId): bool
    {
        $sql = "DELETE FROM historico_navegacao WHERE usuario_id = :usuario_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':usuario_id' => $usuarioId]);
    }
}