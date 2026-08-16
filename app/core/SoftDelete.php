<?php

trait SoftDelete
{
    /**
     * Aplica o filtro de soft delete nas consultas
     */
    protected function applySoftDelete($query)
    {
        return $query . " WHERE deleted_at IS NULL";
    }

    /**
     * Soft delete (marca como excluído)
     */
    public function softDelete(int $id, string $table): bool
    {
        $sql = "UPDATE {$table} SET deleted_at = NOW() WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    /**
     * Restaura um registro excluído
     */
    public function restore(int $id, string $table): bool
    {
        $sql = "UPDATE {$table} SET deleted_at = NULL WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    /**
     * Lista registros excluídos (lixeira)
     */
    public function listDeleted(string $table): array
    {
        $sql = "SELECT * FROM {$table} WHERE deleted_at IS NOT NULL ORDER BY deleted_at DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Exclui permanentemente (hard delete)
     */
    public function hardDelete(int $id, string $table): bool
    {
        $sql = "DELETE FROM {$table} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}