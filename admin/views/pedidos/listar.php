<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">

<h2>Pedidos</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Total</th>
        <th>Status</th>
        <th>Data</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($pedidos as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= $p['cliente_nome'] ?></td>
            <td>R$ <?= number_format($p['total'], 2, ',', '.') ?></td>
            <td><?= ucfirst($p['status']) ?></td>
            <td><?= $p['data_pedido'] ?></td>

            <td>
                <a class="btn"
                   href="index.php?controller=pedidos&action=detalhes&id=<?= $p['id'] ?>">
                    Ver
                </a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

</div>
