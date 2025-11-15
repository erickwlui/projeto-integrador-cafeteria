<?php

if (!isset($_SESSION['cliente_id'])) {
    header("Location: index.php?controller=loja&action=login");
    exit;
}

$pedidoId = $_GET['id'] ?? null;

if (!$pedidoId) {
    header("Location: index.php?controller=loja");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pedido #<?= htmlspecialchars($pedidoId); ?> - Sucesso</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<?php include 'cabecalho_loja.php'; ?>

<main>

    <section class="topo-sessao">
        <div>
            <h2>Pedido realizado com sucesso! 🎉</h2>
            <p>Obrigado por comprar na nossa Cafeteria Gourmet Digital.</p>
        </div>
    </section>

    <div class="quadro" style="text-align:center;">

        <h3>Seu pedido foi registrado!</h3>

        <p>Número do pedido:</p>

        <strong style="font-size:1.6rem; display:block; margin-bottom: 1rem;">
            #<?= htmlspecialchars($pedidoId); ?>
        </strong>

        <p>Agora você pode acompanhar o status em:</p>

        <a href="index.php?controller=loja&action=meusPedidos" class="botao primario" style="margin-top:1rem;">
            Ver meus pedidos
        </a>

        <br><br>

        <a href="index.php?controller=loja" class="botao">
            Voltar para a Loja
        </a>

    </div>

</main>

</body>
</html>
