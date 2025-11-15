<?php

class ItemPedido
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(int $pedidoId, int $produtoId, int $quantidade, float $subtotal): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO item_pedido (id_pedido, id_produto, quantidade, subtotal)
             VALUES (:id_pedido, :id_produto, :quantidade, :subtotal)"
        );

        return $stmt->execute([
            'id_pedido'  => $pedidoId,
            'id_produto' => $produtoId,
            'quantidade' => $quantidade,
            'subtotal'   => $subtotal
        ]);
    }

    public function getByPedido(int $pedidoId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT 
                ip.*, 
                p.nome AS produto_nome,
                p.preco AS produto_preco
             FROM item_pedido ip
             INNER JOIN produto p ON p.id = ip.id_produto
             WHERE ip.id_pedido = :id"
        );

        $stmt->execute(['id' => $pedidoId]);
        return $stmt->fetchAll();
    }
}