<?php
class ItemPedido
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getByPedido(int $pedidoId): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT ip.*, pr.nome AS produto_nome FROM item_pedido ip INNER JOIN produto pr ON pr.id = ip.id_produto WHERE ip.id_pedido = :id_pedido'
        );
        $stmt->execute(['id_pedido' => $pedidoId]);
        return $stmt->fetchAll();
    }
}
