<?php

class Usuario
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function cadastrar(string $nome, string $email, string $senha): int|false
{
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    
    $sql = "
        INSERT INTO usuarios (nome, email, senha)
        VALUES (:nome, :email, :senha)
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':senha' => $senhaHash
    ]);

    return $this->pdo->lastInsertId();
}
    public function buscarPorEmail(string $email): bool
{
    $sql = "SELECT id FROM usuarios WHERE email = :email LIMIT 1";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        ':email' => $email
    ]);

    return $stmt->fetch() !== false;
}
public function buscarPorEmailLogin(string $email)
{
    $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        ':email' => $email
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
public function contar(): int
{
    $sql = "SELECT COUNT(*) as total FROM usuarios";
    $stmt = $this->pdo->query($sql);
    return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

public function ultimos(int $limite = 5): array
{
    $sql = "
        SELECT id, nome, email, data_cadastro AS created_at
        FROM usuarios
        ORDER BY data_cadastro DESC
        LIMIT :limite
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function atualizarAvatar(int $usuarioId, ?string $avatar): bool
{
    $sql = "
        UPDATE usuarios
        SET avatar = :avatar
        WHERE id = :id
    ";

    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        ':id' => $usuarioId,
        ':avatar' => $avatar
    ]);
}

public function buscarPorId(int $id): array|false
{
    $sql = "
        SELECT id, nome, email, avatar, senha, data_cadastro
        FROM usuarios
        WHERE id = :id
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function atualizarNome(int $usuarioId, string $nome): bool
{
    $sql = "UPDATE usuarios SET nome = :nome WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        ':id' => $usuarioId,
        ':nome' => $nome
    ]);
}

public function atualizarSenha(int $usuarioId, string $senha): bool
{
    $sql = "UPDATE usuarios SET senha = :senha WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        ':id' => $usuarioId,
        ':senha' => $senha
    ]);
}

public function isAdmin(int $usuarioId): bool
{
    $sql = "SELECT role FROM usuarios WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':id' => $usuarioId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return ($result['role'] ?? 'user') === 'admin';
}

public function definirComoAdmin(int $usuarioId): bool
{
    $sql = "UPDATE usuarios SET role = 'admin' WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([':id' => $usuarioId]);
}

public function listarTodos(): array
{
    $sql = "
        SELECT id, nome, email, role, data_cadastro
        FROM usuarios
        ORDER BY data_cadastro DESC
    ";
    $stmt = $this->pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function removerAdmin(int $usuarioId): bool
{
    $sql = "UPDATE usuarios SET role = 'user' WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([':id' => $usuarioId]);
}

public function excluir(int $usuarioId): bool
{
    $sql = "DELETE FROM usuarios WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([':id' => $usuarioId]);
}
}