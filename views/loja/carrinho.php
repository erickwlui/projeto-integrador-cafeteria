<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Carrinho - Cafeteria Gourmet Digital</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>

<body>
<header>
    <h1>Cafeteria Gourmet Digital</h1>
    <nav>
        <a href="index.php?controller=loja">Loja</a>
        <a href="index.php?controller=loja&action=carrinho" class="ativo">Carrinho</a>
        <a href="index.php?controller=loja&action=meusPedidos">Meus pedidos</a>
    </nav>
</header>

<main>
    <section class="topo-sessao">
        <div>
            <h2>Seu Carrinho</h2>
            <p>Revise os itens antes de finalizar o pedido.</p>
        </div>
        <a class="botao" href="index.php?controller=loja">&larr; Continuar comprando</a>
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
                        <a class="botao pequeno" href="index.php?controller=loja&action=menos&id=<?= $p['id']; ?>">-</a>
                        <?= $qtd ?>
                        <a class="botao pequeno" href="index.php?controller=loja&action=mais&id=<?= $p['id']; ?>">+</a>
                    </td>

                    <td>
                        R$ <?= number_format($subtotal, 2, ',', '.'); ?>
                    </td>

                    <td>
                        <a class="botao pequeno perigo"
                           href="index.php?controller=loja&action=remover&id=<?= $p['id']; ?>">
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

            <h3>Total: R$ <?= number_format($total, 2, ',', '.'); ?></h3>

            <a class="botao primario" href="index.php?controller=loja&action=checkout">
                Finalizar pedido
            </a>
        <?php endif; ?>
    </div>
</main>

</body>
</html>