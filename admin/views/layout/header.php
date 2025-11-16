<?php
if (!isset($_SESSION['admin_id'])) {
    $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    header("Location: {$basePath}/login.php");
    exit;
}
$controllerAtual = $_GET['controller'] ?? 'admin';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Cafeteria</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
<header>
    <h2>Painel Administrativo</h2>

    <nav>
        <a href="index.php" class="<?= $controllerAtual === 'admin' ? 'ativo' : '' ?>">Dashboard</a>
        <a href="index.php?controller=produtos&action=listar" class="<?= $controllerAtual === 'produtos' ? 'ativo' : '' ?>">Produtos</a>
        <a href="index.php?controller=pedidos&action=listar" class="<?= $controllerAtual === 'pedidos' ? 'ativo' : '' ?>">Pedidos</a>
        <a href="index.php?controller=clientes&action=listar" class="<?= $controllerAtual === 'clientes' ? 'ativo' : '' ?>">Clientes</a>
        <a href="logout.php" class="logout">Sair</a>
    </nav>
</header>