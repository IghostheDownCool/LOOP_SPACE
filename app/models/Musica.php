<?php

class Musica
{
    private PDO $pdo;

    public function __construct()
    {
        $database = new Database();

        $this->pdo = $database->connect();
    }

    public function listar(): array
{
    $sql = "
        SELECT
            musicas.*,
            albuns.titulo AS album,
            albuns.capa,
            artistas.nome AS artista,
            artistas.id AS artista_id,
            albuns.id AS album_id
        FROM musicas
        INNER JOIN albuns ON albuns.id = musicas.album_id
        INNER JOIN artistas ON artistas.id = albuns.artista_id
        ORDER BY artistas.nome ASC,
                 albuns.titulo ASC,
                 musicas.numero_faixa ASC
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function cadastrar(
    string $titulo,
    int $albumId,
    int $numeroFaixa,
    int $duracao,
    string $arquivo
): bool {

    $sql = "
        INSERT INTO musicas
        (
            album_id,
            titulo,
            numero_faixa,
            duracao,
            arquivo
        )
        VALUES
        (
            :album_id,
            :titulo,
            :numero_faixa,
            :duracao,
            :arquivo
        )
    ";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':album_id' => $albumId,
        ':titulo' => $titulo,
        ':numero_faixa' => $numeroFaixa,
        ':duracao' => $duracao,
        ':arquivo' => $arquivo
    ]);
}

    public function buscarPorId(int $id): array|false
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
        WHERE musicas.id = :id
    ";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        ':id' => $id
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    public function atualizar(
        int $id,
        string $titulo,
        int $albumId,
        int $numeroFaixa,
        int $duracao
    ): bool {

        $sql = "
            UPDATE musicas
            SET
                album_id = :album_id,
                titulo = :titulo,
                numero_faixa = :numero_faixa,
                duracao = :duracao
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':album_id' => $albumId,
            ':titulo' => $titulo,
            ':numero_faixa' => $numeroFaixa,
            ':duracao' => $duracao
        ]);
    }

    public function excluir(int $id): bool
    {
        $sql = "
            DELETE FROM musicas
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
    
    public function incrementarReproducoes(int $id): bool
{
    $sql = "
        UPDATE musicas
        SET reproducoes = reproducoes + 1
        WHERE id = :id
    ";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':id' => $id
    ]);
}
public function topMusicas(): array
{
    $sql = "
        SELECT
            musicas.*,
            albuns.titulo AS album,
            albuns.capa,
            artistas.nome AS artista,
            artistas.id AS artista_id,
            albuns.id AS album_id
        FROM musicas
        INNER JOIN albuns ON albuns.id = musicas.album_id
        INNER JOIN artistas ON artistas.id = albuns.artista_id
        ORDER BY reproducoes DESC,
                 titulo ASC
        LIMIT 10
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function buscar(string $termo): array
{
    $sql = "
        SELECT
            musicas.id,
            musicas.titulo,
            musicas.arquivo,
            musicas.duracao,
            albuns.titulo AS album,
            albuns.capa,
            artistas.nome AS artista,
            artistas.id AS artista_id,
            albuns.id AS album_id
        FROM musicas
        INNER JOIN albuns ON albuns.id = musicas.album_id
        INNER JOIN artistas ON artistas.id = albuns.artista_id
        WHERE
            musicas.titulo LIKE :termo
            OR artistas.nome LIKE :termo
            OR albuns.titulo LIKE :termo
        ORDER BY artistas.nome, albuns.titulo, musicas.numero_faixa
        LIMIT 10
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':termo' => '%' . $termo . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function recomendarPorArtistas(array $artistasIds, int $limite = 10): array
{
    if (empty($artistasIds)) {
        return [];
    }

    $placeholders = implode(',', array_fill(0, count($artistasIds), '?'));
    $sql = "
        SELECT
            musicas.*,
            albuns.titulo AS album,
            albuns.capa,
            artistas.nome AS artista,
            artistas.id AS artista_id,
            albuns.id AS album_id
        FROM musicas
        INNER JOIN albuns ON albuns.id = musicas.album_id
        INNER JOIN artistas ON artistas.id = albuns.artista_id
        WHERE artistas.id IN ($placeholders)
        ORDER BY RAND()
        LIMIT ?
    ";

    $stmt = $this->pdo->prepare($sql);

    // Bind dos IDs dos artistas (todos como inteiros)
    foreach ($artistasIds as $index => $id) {
        $stmt->bindValue($index + 1, $id, PDO::PARAM_INT);
    }

    // Bind do limite como inteiro (posição após os IDs)
    $stmt->bindValue(count($artistasIds) + 1, $limite, PDO::PARAM_INT);

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}