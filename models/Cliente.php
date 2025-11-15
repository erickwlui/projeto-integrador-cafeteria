<?php
class Cliente
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll(): array
    {
        $sql = 'SELECT * FROM cliente ORDER BY nome';
        return $this->pdo->query($sql)->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM cliente WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $cliente = $stmt->fetch();
        return $cliente ?: null;
    }

    public function login(string $email, string $senha): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM cliente WHERE email = :email AND senha = :senha'
        );

        $stmt->execute([
            'email' => $email,
            'senha' => $senha
        ]);

        $cliente = $stmt->fetch();
        return $cliente ?: null;
    }

    public function create(array $dados): bool
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO cliente (nome, email, senha, endereco) VALUES (:nome, :email, :senha, :endereco)'
        );

        return $stmt->execute([
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'senha' => $dados['senha'],
            'endereco' => $dados['endereco'],
        ]);
    }

    public function update(int $id, array $dados): bool
    {
        $stmt = $this->pdo->prepare(
            'UPDATE cliente SET nome = :nome, email = :email, senha = :senha, endereco = :endereco WHERE id = :id'
        );

        return $stmt->execute([
            'id' => $id,
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'senha' => $dados['senha'],
            'endereco' => $dados['endereco'],
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM cliente WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}