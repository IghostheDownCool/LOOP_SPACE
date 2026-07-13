<?php

class Artista extends Model
{
    public function listar(): array
    {
        $sql = "SELECT * FROM artistas ORDER BY nome ASC";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): array|false
    {
        $sql = "SELECT * FROM artistas WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrar(string $nome): bool
    {
        $sql = "INSERT INTO artistas (nome)
                VALUES (:nome)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nome' => $nome
        ]);
    }

    public function atualizar(int $id, string $nome): bool
    {
        $sql = "UPDATE artistas
                SET nome = :nome
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':nome' => $nome
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
}