<?php

class AdminController
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $this->pdo = $pdo;
        $this->requireAdmin();
    }

    protected function requireAdmin()
    {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: /admin/login.php");
            exit;
        }
    }

    public function index()
    {
        $totalProdutos = $this->pdo->query("SELECT COUNT(*) FROM produto")->fetchColumn();
        $totalClientes = $this->pdo->query("SELECT COUNT(*) FROM cliente")->fetchColumn();
        $totalPedidos  = $this->pdo->query("SELECT COUNT(*) FROM pedido")->fetchColumn();

        include __DIR__ . '/../views/dashboard.php';
    }
}
