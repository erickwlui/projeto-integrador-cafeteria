<?php


// Usuário precisa estar logado
if (!isset($_SESSION['cliente_id'])) {
    header("Location: index.php?controller=loja&action=login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Cafeteria Gourmet Digital</title>
    <link rel="stylesheet" href="assets/css/style.css?v=<?= time() ?>">
</head>

<body>

<?php include __DIR__ . '/cabecalho_loja.php'; ?>

<main class="container">

    <section class="topo-sessao">
        <div>
            <h2>Checkout</h2>
            <p>Confirme as informações antes de finalizar seu pedido.</p>
        </div>

        <a href="index.php?controller=loja&action=carrinho" class="botao">
            &larr; Voltar ao carrinho
        </a>
    </section>

    <!-- Dados do cliente -->
    <div class="quadro">
        <h3>Dados do Cliente</h3>

        <p><strong>Nome:</strong> <?= htmlspecialchars($cliente['nome']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($cliente['email']) ?></p>
        <p><strong>Endereço:</strong> <?= htmlspecialchars($cliente['endereco']) ?></p>
    </div>

    <br>

    <!-- Resumo do pedido -->
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

    <!-- Botão de finalizar -->
    <form action="index.php?controller=loja&action=finalizarPedido" method="post">
        <button class="botao primario" type="submit">Finalizar Pedido</button>
    </form>

</main>

</body>
</html>
