<?php

class Genero extends Model
{

    use SoftDelete;

    /**
     * Lista todos os gêneros
     */
    public function listar(): array
    {
        $sql = "SELECT * FROM generos ORDER BY nome ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Busca um gênero por ID
     */
    public function buscarPorId(int $id): array|false
    {
        $sql = "SELECT * FROM generos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Busca um gênero por nome
     */
    public function buscarPorNome(string $nome): array|false
    {
        $sql = "SELECT * FROM generos WHERE nome = :nome";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':nome' => $nome]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Cria um novo gênero (apenas admin)
     */
    public function criar(string $nome): bool
    {
        $sql = "INSERT INTO generos (nome) VALUES (:nome)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':nome' => $nome]);
    }

    /**
     * Atualiza um gênero (apenas admin)
     */
    public function atualizar(int $id, string $nome): bool
    {
        $sql = "UPDATE generos SET nome = :nome WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':nome' => $nome
        ]);
    }

    /**
     * Exclui um gênero (apenas admin)
     */
    public function excluir(int $id): bool
    {
        $sql = "DELETE FROM generos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    /**
     * Conta quantos gêneros existem
     */
    public function contar(): int
    {
        $sql = "SELECT COUNT(*) as total FROM generos";
        $stmt = $this->pdo->query($sql);
        return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}