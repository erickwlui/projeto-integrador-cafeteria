<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Cafeteria Gourmet Digital</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>

<header>
    <h1>Cafeteria Gourmet Digital</h1>
    <nav>
        <a href="index.php?controller=loja">Loja</a>

        <?php if (isset($_SESSION['cliente_id'])): ?>
            <a href="index.php?controller=loja&action=carrinho">Carrinho</a>
            <a href="index.php?controller=loja&action=logout">Sair (<?= htmlspecialchars($_SESSION['cliente_nome']) ?>)</a>
        <?php else: ?>
            <a href="index.php?controller=loja&action=login">Login</a>
        <?php endif; ?>
    </nav>
</header>

<main>
    <section class="topo-sessao">
        <div>
            <h2>Checkout</h2>
            <p>Confirme as informações antes de finalizar o pedido.</p>
        </div>
    </section>

    <div class="quadro">
        <h3>Dados do Cliente</h3>
        <p><strong>Nome:</strong> <?= htmlspecialchars($cliente['nome']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($cliente['email']) ?></p>
        <p><strong>Endereço:</strong> <?= htmlspecialchars($cliente['endereco']) ?></p>
    </div>

    <br>

    <div class="quadro">
        <h3>Resumo do Pedido</h3>

        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Qtd.</th>
                    <th>Subtotal</th>
                </tr>
            </thead>

            <tbody>
            <?php
            $total = 0;
            foreach ($_SESSION['carrinho'] as $id => $qtd):
                foreach ($produtos as $p):
                    if ($p['id'] == $id):
                        $subtotal = $p['preco'] * $qtd;
                        $total += $subtotal;
            ?>
                <tr>
                    <td><?= htmlspecialchars($p['nome']) ?></td>
                    <td><?= $qtd ?></td>
                    <td>R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
                </tr>
            <?php
                    endif;
                endforeach;
            endforeach;
            ?>
            </tbody>

            <tfoot>
                <tr>
                    <th colspan="2">Total</th>
                    <th>R$ <?= number_format($total, 2, ',', '.') ?></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <br>

    <form action="index.php?controller=loja&action=finalizarPedido" method="post">
        <button class="botao primario" type="submit">Finalizar Pedido</button>
    </form>

</main>

</body>
</html>