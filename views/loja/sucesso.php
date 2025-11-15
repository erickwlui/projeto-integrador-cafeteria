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
    <title>Pedido Realizado - Cafeteria Gourmet Digital</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>

<body>

<header>
    <h1>Cafeteria Gourmet Digital</h1>
    <nav>
        <a href="index.php?controller=loja">Loja</a>
        <a href="index.php?controller=loja&action=meusPedidos">Meus pedidos</a>
        <a href="index.php?controller=loja&action=logout">
            Sair (<?= htmlspecialchars($_SESSION['cliente_nome']); ?>)
        </a>
    </nav>
</header>

<main>

    <section class="topo-sessao">
        <div>
            <h2>Pedido realizado com sucesso! 🎉</h2>
            <p>Obrigado por comprar na nossa cafeteria digital.</p>
        </div>
    </section>

    <div class="quadro" style="text-align:center;">

        <h3>Seu pedido foi registrado!</h3>

        <p>
            Número do pedido:<br>
            <strong style="font-size:1.4rem;">
                #<?= htmlspecialchars($pedidoId); ?>
            </strong>
        </p>

        <p style="margin-top: 1rem;">
            Você pode acompanhar o status em:
        </p>

        <a href="index.php?controller=loja&action=meusPedidos" class="botao primario">
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