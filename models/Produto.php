<?php
class Produto
{
    private PDO $pdo;

    private static bool $schemaVerificado = false;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->garantirColunaImagem();
    }

    private function garantirColunaImagem(): void
    {
        if (self::$schemaVerificado) {
            return;
        }

        try {
            $stmt = $this->pdo->query("SHOW COLUMNS FROM produto LIKE 'imagem'");
            if ($stmt->rowCount() === 0) {
                $this->pdo->exec("ALTER TABLE produto ADD COLUMN imagem VARCHAR(255) NULL");
            }
        } catch (PDOException $e) {
            // tabela pode não existir ainda durante instalação; ignora e segue
        } finally {
            self::$schemaVerificado = true;
        }
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
            'INSERT INTO produto (nome, descricao, preco, estoque, imagem) VALUES (:nome, :descricao, :preco, :estoque, :imagem)'
        );

        return $stmt->execute([
            'nome' => $dados['nome'],
            'descricao' => $dados['descricao'],
            'preco' => $dados['preco'],
            'estoque' => $dados['estoque'],
            'imagem' => $dados['imagem'] ?? null,
        ]);
    }

    public function update(int $id, array $dados): bool
    {
        $stmt = $this->pdo->prepare(
            'UPDATE produto 
             SET nome = :nome, descricao = :descricao, preco = :preco, estoque = :estoque, imagem = :imagem 
             WHERE id = :id'
        );

        return $stmt->execute([
            'id' => $id,
            'nome' => $dados['nome'],
            'descricao' => $dados['descricao'],
            'preco' => $dados['preco'],
            'estoque' => $dados['estoque'],
            'imagem' => $dados['imagem'] ?? null,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM produto WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}