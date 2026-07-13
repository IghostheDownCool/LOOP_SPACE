<?php

class Album extends Model
{

    public function listar(): array
    {
        $sql = "
            SELECT
                albuns.*,
                artistas.nome AS artista
            FROM albuns
            INNER JOIN artistas
                ON artistas.id = albuns.artista_id
            ORDER BY albuns.id ASC
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar(
    string $titulo,
    int $artistaId,
    int $ano,
    ?string $capa
): bool
    {
        $sql = "
    INSERT INTO albuns
    (
        titulo,
        artista_id,
        ano,
        capa
    )
    VALUES
    (
        :titulo,
        :artista_id,
        :ano,
        :capa
    )
";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
    ':titulo' => $titulo,
    ':artista_id' => $artistaId,
    ':ano' => $ano,
    ':capa' => $capa
]);
    }

    public function buscarPorId(int $id): array|false
    {
        $sql = "SELECT * FROM albuns WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar(
        int $id,
        string $titulo,
        int $artistaId,
        int $ano
    ): bool {

        $sql = "
            UPDATE albuns
            SET
                titulo = :titulo,
                artista_id = :artista_id,
                ano = :ano
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':titulo' => $titulo,
            ':artista_id' => $artistaId,
            ':ano' => $ano
        ]);
    }

    public function excluir(int $id): bool
    {
        $sql = "DELETE FROM albuns WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}