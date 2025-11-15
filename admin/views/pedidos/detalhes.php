<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">

    <h2>Pedido #<?= $pedido['id'] ?></h2>

    <div class="quadro" style="margin-bottom: 25px;">

        <p><strong>Cliente:</strong> <?= htmlspecialchars($pedido['cliente_nome']) ?></p>
        <p><strong>Total:</strong> R$ <?= number_format($pedido['total'], 2, ',', '.') ?></p>
        <p><strong>Data:</strong> <?= htmlspecialchars($pedido['data_pedido']) ?></p>
    </div>

    <h3>Status do Pedido</h3>

    <div class="quadro" style="margin-bottom: 30px;">

        <form action="index.php?controller=pedidos&action=atualizarStatus" method="post">

            <input type="hidden" name="id" value="<?= $pedido['id'] ?>">

            <label style="font-weight:600; margin-bottom: 8px; display:block;">
                Alterar status:
            </label>

            <select name="status" required 
                    style="padding:10px; width: 260px; border-radius:6px; border:1px solid #ccc;">

                <?php
                $statusList = [
                    'aguardando pagamento',
                    'pago',
                    'em preparo',
                    'pronto para retirada',
                    'enviado',
                    'cancelado'
                ];

                foreach ($statusList as $s):
                ?>
                    <option value="<?= $s ?>"
                        <?= $pedido['status'] === $s ? 'selected' : '' ?>>
                        <?= ucfirst($s) ?>
                    </option>

                <?php endforeach; ?>

            </select>

            <br><br>

            <button class="btn">Salvar Status</button>
        </form>

    </div>


    <h3>Itens do Pedido</h3>

    <div class="quadro">

        <table>
            <tr>
                <th>Produto</th>
                <th>Qtd</th>
                <th>Subtotal</th>
            </tr>

            <?php foreach ($itens as $i): ?>
                <tr>
                    <td><?= htmlspecialchars($i['produto_nome']) ?></td>
                    <td><?= $i['quantidade'] ?></td>
                    <td>R$ <?= number_format($i['subtotal'], 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>

        </table>

    </div>

</div>
