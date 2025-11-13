<?php
class Produto
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll(): array
    {
        $sql = 'SELECT * FROM produto ORDER BY nome';
        return $this->pdo->query($sql)->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM produto WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $produto = $stmt->fetch();
        return $produto ?: null;
    }

    public function create(array $dados): bool
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO produto (nome, descricao, preco, estoque) VALUES (:nome, :descricao, :preco, :estoque)'
        );

        return $stmt->execute([
            'nome' => $dados['nome'],
            'descricao' => $dados['descricao'],
            'preco' => $dados['preco'],
            'estoque' => $dados['estoque'],
        ]);
    }

    public function update(int $id, array $dados): bool
    {
        $stmt = $this->pdo->prepare(
            'UPDATE produto SET nome = :nome, descricao = :descricao, preco = :preco, estoque = :estoque WHERE id = :id'
        );

        return $stmt->execute([
            'id' => $id,
            'nome' => $dados['nome'],
            'descricao' => $dados['descricao'],
            'preco' => $dados['preco'],
            'estoque' => $dados['estoque'],
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM produto WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
