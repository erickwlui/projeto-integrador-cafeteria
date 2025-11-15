<?php
if (!isset($_SESSION['admin_id'])) {
    header("Location: /admin/login.php");
    exit;
}
?>
<header>
    <h2>Painel Administrativo</h2>

    <nav>
        <a href="index.php">Dashboard</a>
        <a href="index.php?controller=produtos&action=listar">Produtos</a>
        <a href="index.php?controller=pedidos&action=listar">Pedidos</a>
        <a href="index.php?controller=clientes&action=listar">Clientes</a>
        <a href="logout.php" style="color:yellow;">Sair</a>
    </nav>
</header>
