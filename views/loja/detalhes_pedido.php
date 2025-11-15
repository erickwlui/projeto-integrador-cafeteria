<?php
/** @var array $pedido */
/** @var array $itens */


if (!isset($_SESSION['cliente_id'])) {
    header("Location: index.php?controller=loja&action=login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pedido #<?= (int)$pedido['id']; ?> - Cafeteria Gourmet Digital</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<?php include 'cabecalho_loja.php'; ?>

<main>

    <section class="topo-sessao">
        <div>
            <h2>Pedido #<?= (int)$pedido['id']; ?></h2>
            <p>Status:
                <strong><?= htmlspecialchars(ucfirst($pedido['status'])); ?></strong>
            </p>
        </div>

        <a href="index.php?controller=loja&action=meusPedidos" class="botao">
            &larr; Voltar
        </a>
    </section>


    <div class="quadro">

        <h3>Itens do Pedido</h3>

        <table>
            <thead>
            <tr>
                <th>Produto</th>
                <th>Qtd.</th>
                <th>Subtotal</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($itens as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['produto_nome']); ?></td>
                    <td><?= (int)$item['quantidade']; ?></td>
                    <td>
                        R$ <?= number_format($item['subtotal'], 2, ',', '.'); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>

            <tfoot>
            <tr>
                <th colspan="2">Total</th>
                <th>
                    R$ <?= number_format($pedido['total'], 2, ',', '.'); ?>
                </th>
            </tr>
            </tfoot>
        </table>

    </div>

</main>

</body>
</html>
