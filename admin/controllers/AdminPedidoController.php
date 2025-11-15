<?php

require_once __DIR__ . '/AdminController.php';
require_once __DIR__ . '/../../models/Pedido.php';
require_once __DIR__ . '/../../models/ItemPedido.php';

class AdminPedidoController extends AdminController
{
    private Pedido $pedidoModel;
    private ItemPedido $itemModel;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
        $this->pedidoModel = new Pedido($pdo);
        $this->itemModel = new ItemPedido($pdo);
    }

    public function listar()
    {
        $pedidos = $this->pedidoModel->getAllWithClientes();
        include __DIR__ . '/../views/pedidos/listar.php';
    }

    public function detalhes()
    {
        $id = (int)$_GET['id'];
        $pedido = $this->pedidoModel->find($id);
        $itens = $this->itemModel->getByPedido($id);

        include __DIR__ . '/../views/pedidos/detalhes.php';
    }

    // NOVO: Atualizar status do pedido
    public function atualizarStatus()
    {
        $id = (int) $_POST['id'];
        $status = $_POST['status'] ?? '';

        if ($id <= 0 || empty($status)) {
            echo "Dados inválidos.";
            exit;
        }

        $this->pedidoModel->updateStatus($id, $status);

        header("Location: index.php?controller=pedidos&action=detalhes&id=" . $id);
        exit;
    }
}
