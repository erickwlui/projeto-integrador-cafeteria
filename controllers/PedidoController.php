<?php
require_once __DIR__ . '/../models/Pedido.php';
require_once __DIR__ . '/../models/ItemPedido.php';

class PedidoController
{
    private Pedido $pedidoModel;
    private ItemPedido $itemPedidoModel;

    public function __construct(PDO $pdo)
    {
        $this->pedidoModel = new Pedido($pdo);
        $this->itemPedidoModel = new ItemPedido($pdo);
    }

    public function listar(): void
    {
        $pedidos = $this->pedidoModel->getAllWithClientes();
        $itensPorPedido = [];
        foreach ($pedidos as $pedido) {
            $itensPorPedido[$pedido['id']] = $this->itemPedidoModel->getByPedido((int) $pedido['id']);
        }

        include __DIR__ . '/../views/pedidos/listar.php';
    }
}
