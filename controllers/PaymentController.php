<?php

require_once __DIR__ . '/../models/Pedido.php';

class PaymentController
{
    private Pedido $pedidoModel;

    public function __construct(PDO $pdo)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->pedidoModel = new Pedido($pdo);
    }

    // EXIBE O QR CODE FAKE
    public function pix()
    {
        $pedidoId = (int)($_GET['id'] ?? 0);
        if ($pedidoId <= 0) {
            echo "Pedido inválido.";
            exit;
        }

        $pedido = $this->pedidoModel->find($pedidoId);

        include __DIR__ . '/../views/pagamentos/pix.php';
    }

    // CONFIRMA O PAGAMENTO (FAKE)
    public function confirmar()
    {
        $pedidoId = (int)($_POST['pedido_id'] ?? 0);

        if ($pedidoId <= 0) {
            echo "Pedido inválido.";
            exit;
        }

        // Atualiza status para "pago"
        $this->pedidoModel->updateStatus($pedidoId, "pago");

        header("Location: index.php?controller=payment&action=sucesso&id=" . $pedidoId);
        exit;
    }

    public function sucesso()
    {
        include __DIR__ . '/../views/pagamento/sucesso.php';
    }
}
