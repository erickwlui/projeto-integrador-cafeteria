<?php
/** @var array $pedidos */
/** @var array $itensPorPedido */
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pedidos - Cafeteria Gourmet Digital</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>
<header>
    <h1>Cafeteria Gourmet Digital</h1>
    <nav>
        <a href="index.php">Início</a>
        <a href="index.php?controller=cliente&action=listar">Clientes</a>
        <a href="index.php?controller=produto&action=listar">Produtos</a>
        <a href="index.php?controller=pedido&action=listar" class="ativo">Pedidos</a>
    </nav>
</header>
<main>
    <section class="topo-sessao">
        <div>
            <h2>Pedidos</h2>
            <p>Visualize os pedidos realizados e os itens de cada um.</p>
        </div>
    </section>

    <div class="quadro">
        <?php if (count($pedidos) === 0): ?>
            <p>Nenhum pedido registrado.</p>
        <?php else: ?>
            <table>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Itens</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Data</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td><?= (int) $pedido['id']; ?></td>
                        <td><?= htmlspecialchars($pedido['cliente_nome']); ?></td>
                        <td>
                            <ul class="lista-itens">
                                <?php foreach ($itensPorPedido[$pedido['id']] ?? [] as $item): ?>
                                    <li>
                                        <strong><?= htmlspecialchars($item['produto_nome']); ?></strong>
                                        &times; <?= (int) $item['quantidade']; ?>
                                        — Subtotal: R$ <?= number_format($item['subtotal'], 2, ',', '.'); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </td>
                        <td><strong>R$ <?= number_format($pedido['total'], 2, ',', '.'); ?></strong></td>
                        <td><span class="status"><?= htmlspecialchars(ucfirst($pedido['status'])); ?></span></td>
                        <td><?= date('d/m/Y H:i', strtotime($pedido['data_pedido'])); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</main>
</body>
</html>
