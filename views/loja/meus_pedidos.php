<?php
/** @var array $pedidos */

if (!isset($_SESSION['cliente_id'])) {
    header("Location: index.php?controller=loja&action=login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Meus Pedidos - Cafeteria Gourmet Digital</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>

<body>

<header>
    <h1>Cafeteria Gourmet Digital</h1>
    <nav>
        <a href="index.php?controller=loja">Loja</a>
        <a href="index.php?controller=loja&action=carrinho">Carrinho</a>
        <a href="index.php?controller=loja&action=meusPedidos" class="ativo">Meus pedidos</a>
        <a href="index.php?controller=loja&action=logout">
            Sair (<?= htmlspecialchars($_SESSION['cliente_nome']); ?>)
        </a>
    </nav>
</header>

<main>

    <section class="topo-sessao">
        <div>
            <h2>Meus Pedidos</h2>
            <p>Acompanhe o status de cada pedido realizado.</p>
        </div>
    </section>

    <div class="quadro">

        <?php if (count($pedidos) === 0): ?>
            <p>Você ainda não fez nenhum pedido.</p>
        <?php else: ?>

            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Data</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($pedidos as $pedido): ?>
                    <tr>

                        <td>
                            <a href="index.php?controller=loja&action=detalhesPedido&id=<?= $pedido['id'] ?>">
                                #<?= (int)$pedido['id']; ?>
                            </a>
                        </td>

                        <td>
                            R$ <?= number_format($pedido['total'], 2, ',', '.'); ?>
                        </td>

                        <td>
                            <span class="status"><?= htmlspecialchars(ucfirst($pedido['status'])); ?></span>
                        </td>

                        <td>
                            <?= date('d/m/Y H:i', strtotime($pedido['data_pedido'])); ?>
                        </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>

        <?php endif; ?>

    </div>

</main>

</body>
</html>