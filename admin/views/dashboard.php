<?php include __DIR__ . '/layout/header.php'; ?>

<div class="container">
    <section class="card">
        <h2>Visão geral</h2>
        <p>Última atualização: <?= date('d/m/Y H:i'); ?></p>
    </section>

    <section class="cards-grid">
        <div class="mini-card">
            <span>Produtos no catálogo</span>
            <strong><?= $totalProdutos ?></strong>
            <a class="link-inline" href="index.php?controller=produtos&action=listar">Gerenciar produtos →</a>
        </div>

        <div class="mini-card">
            <span>Clientes cadastrados</span>
            <strong><?= $totalClientes ?></strong>
            <a class="link-inline" href="index.php?controller=clientes&action=listar">Ver clientes →</a>
        </div>

        <div class="mini-card">
            <span>Pedidos registrados</span>
            <strong><?= $totalPedidos ?></strong>
            <a class="link-inline" href="index.php?controller=pedidos&action=listar">Abrir pedidos →</a>
        </div>
    </section>
</div>