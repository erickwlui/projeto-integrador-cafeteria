<?php
if (!isset($_SESSION['cliente_id'])) {
    header("Location: index.php?controller=loja&action=login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Carrinho - Cafeteria Gourmet Digital</title>
    <link rel="stylesheet" href="assets/css/style.css?v=<?= time() ?>">
</head>

<body>

<?php include __DIR__ . '/cabecalho_loja.php'; ?>

<main class="container">

    <section class="topo-sessao">
        <div>
            <h2>Seu Carrinho</h2>
            <p>Revise os itens antes de finalizar o pedido.</p>
        </div>

        <a class="botao" href="index.php?controller=loja">
            &larr; Continuar comprando
        </a>
    </section>

    <div class="quadro">

        <?php if (empty($_SESSION['carrinho'])): ?>

            <p>Seu carrinho está vazio.</p>

        <?php else: ?>

            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Qtd</th>
                        <th>Subtotal</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                $total = 0;

                foreach ($_SESSION['carrinho'] as $idProd => $qtd):
                    foreach ($produtos as $p):
                        if ($p['id'] == $idProd):

                            $subtotal = $p['preco'] * $qtd;
                            $total += $subtotal;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($p['nome']); ?></td>

                        <td>R$ <?= number_format($p['preco'], 2, ',', '.'); ?></td>

                        <td>
                            <div style="display:flex; align-items:center; gap:8px;">
                                <a class="botao pequeno" 
                                   href="index.php?controller=loja&action=menos&id=<?= $p['id'] ?>">-</a>

                                <strong><?= $qtd ?></strong>

                                <a class="botao pequeno" 
                                   href="index.php?controller=loja&action=mais&id=<?= $p['id'] ?>">+</a>
                            </div>
                        </td>

                        <td>R$ <?= number_format($subtotal, 2, ',', '.'); ?></td>

                        <td>
                            <a class="botao pequeno perigo"
                               href="index.php?controller=loja&action=remover&id=<?= $p['id'] ?>">
                                Remover
                            </a>
                        </td>
                    </tr>
                <?php
                        endif;
                    endforeach;
                endforeach;
                ?>

                </tbody>
            </table>

            <h3 style="text-align:right; margin-top:1.5rem;">
                Total: <strong>R$ <?= number_format($total, 2, ',', '.'); ?></strong>
            </h3>

            <div style="text-align:right; margin-top:1rem;">
                <a class="botao primario" href="index.php?controller=loja&action=checkout">
                    Finalizar pedido
                </a>
            </div>

        <?php endif; ?>

    </div>

</main>

</body>
</html>
