<?php include __DIR__ . '/../loja/cabecalho_loja.php'; ?>

<main class="container">

    <section class="topo-sessao">
        <h2>Pagar com PIX</h2>
        <p>Escaneie o QR Code abaixo para simular o pagamento.</p>
    </section>

    <div class="quadro" style="text-align:center;">

        <h3>Total a pagar:</h3>
        <strong style="font-size:1.7rem;">R$ <?= number_format($pedido['total'], 2, ',', '.') ?></strong>

        <br><br>

        <img src="/assets/imagens/qrcode_fake.png" style="width:250px;">

        <p style="margin-top:1rem; font-style:italic;">
            (QR Code ilustrativo – pagamento simulado)
        </p>

        <form action="index.php?controller=payment&action=confirmar" method="post">
            <input type="hidden" name="pedido_id" value="<?= $pedido['id'] ?>">
            <button class="botao primario" style="margin-top:20px;">Já paguei</button>
        </form>

    </div>

</main>
