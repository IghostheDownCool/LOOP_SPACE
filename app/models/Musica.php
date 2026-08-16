<?php

class Musica
{
    private PDO $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();
    }

    /**
     * Lista todas as músicas ATIVAS (público)
     */
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
            WHERE musicas.ativa = 1
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
        string $arquivo,
        ?string $genero = null
    ): bool {
        $sql = "
            INSERT INTO musicas
            (
                album_id,
                titulo,
                numero_faixa,
                duracao,
                arquivo,
                genero,
                ativa
            )
            VALUES
            (
                :album_id,
                :titulo,
                :numero_faixa,
                :duracao,
                :arquivo,
                :genero,
                1
            )
        ";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':album_id' => $albumId,
            ':titulo' => $titulo,
            ':numero_faixa' => $numeroFaixa,
            ':duracao' => $duracao,
            ':arquivo' => $arquivo,
            ':genero' => $genero
        ]);
    }

    public function buscarPorId(int $id): array|false
    {
        $sql = "
            SELECT
                musicas.*,
                albuns.titulo AS album,
                albuns.capa,
                albuns.artista_id,
                artistas.nome AS artista
            FROM musicas
            INNER JOIN albuns ON albuns.id = musicas.album_id
            INNER JOIN artistas ON artistas.id = albuns.artista_id
            WHERE musicas.id = :id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar(
        int $id,
        string $titulo,
        int $albumId,
        int $numeroFaixa,
        int $duracao,
        ?string $genero = null
    ): bool {
        $sql = "
            UPDATE musicas
            SET
                album_id = :album_id,
                titulo = :titulo,
                numero_faixa = :numero_faixa,
                duracao = :duracao,
                genero = :genero
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':album_id' => $albumId,
            ':titulo' => $titulo,
            ':numero_faixa' => $numeroFaixa,
            ':duracao' => $duracao,
            ':genero' => $genero
        ]);
    }

    public function excluir(int $id): bool
    {
        $sql = "DELETE FROM musicas WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function incrementarReproducoes(int $id): bool
    {
        $sql = "UPDATE musicas SET reproducoes = reproducoes + 1 WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    /**
     * Top músicas (apenas ATIVAS)
     */
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
            WHERE musicas.ativa = 1
            ORDER BY reproducoes DESC,
                     titulo ASC
            LIMIT 10
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Busca por termo (apenas ATIVAS)
     */
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
            WHERE musicas.ativa = 1
              AND (
                musicas.titulo LIKE :termo
                OR artistas.nome LIKE :termo
                OR albuns.titulo LIKE :termo
            )
            ORDER BY artistas.nome, albuns.titulo, musicas.numero_faixa
            LIMIT 10
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':termo' => '%' . $termo . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Recomendações por artistas (apenas ATIVAS)
     */
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
              AND musicas.ativa = 1
            ORDER BY RAND()
            LIMIT ?
        ";

        $stmt = $this->pdo->prepare($sql);

        foreach ($artistasIds as $index => $id) {
            $stmt->bindValue($index + 1, $id, PDO::PARAM_INT);
        }
        $stmt->bindValue(count($artistasIds) + 1, $limite, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contar(): int
    {
        $sql = "SELECT COUNT(*) as total FROM musicas WHERE ativa = 1";
        $stmt = $this->pdo->query($sql);
        return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    /**
     * Últimas músicas (apenas ATIVAS)
     */
    public function ultimas(int $limite = 5): array
    {
        $sql = "
            SELECT
                musicas.*,
                albuns.titulo AS album,
                artistas.nome AS artista
            FROM musicas
            INNER JOIN albuns ON albuns.id = musicas.album_id
            INNER JOIN artistas ON artistas.id = albuns.artista_id
            WHERE musicas.ativa = 1
            ORDER BY musicas.id DESC
            LIMIT :limite
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Top músicas limitado (apenas ATIVAS)
     */
    public function topMusicasLimitado(int $limite = 5): array
    {
        $sql = "
            SELECT
                musicas.titulo,
                artistas.nome AS artista,
                musicas.reproducoes
            FROM musicas
            INNER JOIN albuns ON albuns.id = musicas.album_id
            INNER JOIN artistas ON artistas.id = albuns.artista_id
            WHERE musicas.ativa = 1
            ORDER BY musicas.reproducoes DESC
            LIMIT :limite
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Lista músicas por gênero (apenas ATIVAS)
     */
    public function listarPorGenero(string $genero): array
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
            WHERE musicas.genero = :genero
              AND musicas.ativa = 1
            ORDER BY artistas.nome ASC,
                     albuns.titulo ASC,
                     musicas.numero_faixa ASC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':genero' => $genero]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarGeneros(): array
    {
        $sql = "
            SELECT DISTINCT genero
            FROM musicas
            WHERE genero IS NOT NULL AND genero != '' AND ativa = 1
            ORDER BY genero ASC
        ";

        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Lista músicas de um artista específico (TODAS, inclusive inativas - para o artista)
     */
    public function listarPorArtista(int $artistaId): array
    {
        $sql = "
            SELECT
                musicas.*,
                albuns.titulo AS album,
                albuns.capa,
                albuns.id AS album_id,
                artistas.nome AS artista,
                artistas.id AS artista_id
            FROM musicas
            INNER JOIN albuns ON albuns.id = musicas.album_id
            INNER JOIN artistas ON artistas.id = albuns.artista_id
            WHERE artistas.id = :artista_id
            ORDER BY albuns.titulo ASC, musicas.numero_faixa ASC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':artista_id' => $artistaId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Conta quantas músicas um artista tem (TODAS)
     */
    public function contarPorArtista(int $artistaId): int
    {
        $sql = "
            SELECT COUNT(*) as total
            FROM musicas
            INNER JOIN albuns ON albuns.id = musicas.album_id
            WHERE albuns.artista_id = :artista_id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':artista_id' => $artistaId]);
        return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    /**
     * Total de reproduções de um artista (TODAS)
     */
    public function totalReproducoesPorArtista(int $artistaId): int
    {
        $sql = "
            SELECT SUM(musicas.reproducoes) as total
            FROM musicas
            INNER JOIN albuns ON albuns.id = musicas.album_id
            WHERE albuns.artista_id = :artista_id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':artista_id' => $artistaId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) ($result['total'] ?? 0);
    }

    /**
     * Atualiza o arquivo de uma música
     */
    public function atualizarArquivo(int $id, string $arquivo): bool
    {
        $sql = "UPDATE musicas SET arquivo = :arquivo WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':arquivo' => $arquivo
        ]);
    }

    /**
     * Atualiza a capa de uma música
     */
    public function atualizarCapa(int $id, string $capa): bool
    {
        $sql = "UPDATE musicas SET capa = :capa WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':capa' => $capa
        ]);
    }

    /**
     * Toggle ativa/desativa música
     */
    public function toggleAtiva(int $id): bool
    {
        $sql = "UPDATE musicas SET ativa = NOT ativa WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    /**
     * Extrai a duração de um arquivo de áudio (em segundos)
     */
    public function getDuracao(string $caminhoArquivo): int
    {
        if (!file_exists($caminhoArquivo)) {
            return 0;
        }

        if (function_exists('exec')) {
            $cmd = "ffmpeg -i " . escapeshellarg($caminhoArquivo) . " 2>&1 | grep -oP 'Duration: \K\d{2}:\d{2}:\d{2}'";
            $output = shell_exec($cmd);
            if ($output) {
                $parts = explode(':', trim($output));
                if (count($parts) === 3) {
                    return (int) $parts[0] * 3600 + (int) $parts[1] * 60 + (int) $parts[2];
                }
            }
        }

        if (class_exists('getID3')) {
            $getID3 = new \getID3();
            $fileInfo = $getID3->analyze($caminhoArquivo);
            if (isset($fileInfo['playtime_seconds'])) {
                return (int) $fileInfo['playtime_seconds'];
            }
        }

        if (function_exists('getid3')) {
            $info = getid3($caminhoArquivo);
            if (isset($info['playtime_seconds'])) {
                return (int) $info['playtime_seconds'];
            }
        }

        return 0;
    }
    /**
 * Lista TODAS as músicas (para admin)
 */
public function listarTodas(): array
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
}