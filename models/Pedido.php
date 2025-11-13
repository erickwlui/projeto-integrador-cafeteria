<?php
class Pedido
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllWithClientes(): array
    {
        $sql = 'SELECT p.*, c.nome AS cliente_nome FROM pedido p INNER JOIN cliente c ON c.id = p.id_cliente ORDER BY p.data_pedido DESC';
        return $this->pdo->query($sql)->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT p.*, c.nome AS cliente_nome FROM pedido p INNER JOIN cliente c ON c.id = p.id_cliente WHERE p.id = :id'
        );
        $stmt->execute(['id' => $id]);
        $pedido = $stmt->fetch();
        return $pedido ?: null;
    }
}
