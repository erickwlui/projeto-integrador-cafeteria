<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Loja - Cafeteria Gourmet Digital</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>

<body>
<header>
    <h1>Cafeteria Gourmet Digital</h1>
    <nav>
        <a href="index.php?controller=loja" class="ativo">Loja</a>
        <a href="index.php?controller=loja&action=carrinho">Carrinho</a>
        <a href="index.php?controller=loja&action=meusPedidos">Meus pedidos</a>
    </nav>
</header>

<main>
    <section class="topo-sessao">
        <div>
            <h2>Loja</h2>
            <p>Escolha seus cafés e produtos gourmet.</p>
        </div>
    </section>

    <div class="quadro">
        <?php foreach ($produtos as $p): ?>
            <div style="margin-bottom: 1.3rem; border-bottom: 1px solid #eee; padding-bottom: 1rem;">
                <h3><?= htmlspecialchars($p['nome']); ?></h3>
                <p><?= htmlspecialchars($p['descricao']); ?></p>
                <strong>R$ <?= number_format($p['preco'], 2, ',', '.'); ?></strong>

                <p>
                    <a
                        class="botao primario"
                        href="index.php?controller=loja&action=adicionarCarrinho&id=<?= $p['id']; ?>"
                    >
                        Adicionar ao carrinho
                    </a>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</main>
</body>
</html>