<?php

class Pedido
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // LOJA — Criar pedido
    public function create(int $clienteId, float $total): int
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO pedido (id_cliente, total, status, data_pedido)
             VALUES (:id_cliente, :total, 'aguardando pagamento', NOW())"
        );

        $stmt->execute([
            'id_cliente' => $clienteId,
            'total'      => $total
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    // LOJA — Buscar pedidos do cliente
    public function getByCliente(int $clienteId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM pedido 
             WHERE id_cliente = :id 
             ORDER BY data_pedido DESC"
        );

        $stmt->execute(['id' => $clienteId]);
        return $stmt->fetchAll();
    }

    // ADMIN — Listar pedidos + nome do cliente
    public function getAllWithClientes(): array
    {
        $sql = "SELECT p.*, c.nome AS cliente_nome
                FROM pedido p
                INNER JOIN cliente c ON c.id = p.id_cliente
                ORDER BY p.data_pedido DESC";

        return $this->pdo->query($sql)->fetchAll();
    }

    // ADMIN — Buscar um pedido com cliente
    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT p.*, c.nome AS cliente_nome
             FROM pedido p
             INNER JOIN cliente c ON c.id = p.id_cliente
             WHERE p.id = :id"
        );

        $stmt->execute(['id' => $id]);
        $pedido = $stmt->fetch();

        return $pedido ?: null;
    }
}