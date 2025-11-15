<?php include __DIR__ . '/../loja/cabecalho_loja.php'; ?>

<main class="container">

    <section class="topo-sessao">
        <h2>Pagamento Confirmado! 🎉</h2>
        <p>Obrigado por sua compra.</p>
    </section>

    <div class="quadro" style="text-align:center;">

        <h3>Pedido pago com sucesso!</h3>

        <a href="index.php?controller=loja&action=meusPedidos" class="botao primario" style="margin-top:1rem;">
            Ver meus pedidos
        </a>

        <br><br>

        <a href="index.php?controller=loja" class="botao">
            Voltar para a loja
        </a>

    </div>

</main>
