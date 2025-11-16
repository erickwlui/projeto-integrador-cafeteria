<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cafeteria Gourmet Digital</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header>
    <h1>Cafeteria Gourmet Digital</h1>
    <nav>
        <a href="index.php" class="ativo">Visão geral</a>
        <a href="index.php?controller=loja">Experiência do cliente</a>
        <a href="admin/index.php">Painel administrativo</a>
    </nav>
</header>
<main>
    <section class="hero">
        <h2>Bem-vindo à Cafeteria Digital</h2>
        <p>Central único para acompanhar a operação completa: vitrine para clientes, carrinho & pedidos e painel interno para gestão.</p>
        <div class="cta">
            <a class="botao primario" href="index.php?controller=loja">Entrar na experiência do cliente</a>
            <a class="botao secundario" href="admin/index.php">Acessar painel administrativo</a>
        </div>
    </section>

    <section class="hub-grid">
        <article class="hub-card">
            <span class="tag">Operação interna</span>
            <h3>Gestão da Cafeteria</h3>
            <p>Cadastre clientes, mantenha o catálogo de produtos, acompanhe pedidos e monitore pagamentos.</p>
            <div class="acoes">
                <a class="botao primario" href="index.php?controller=cliente&action=listar">Clientes</a>
                <a class="botao" href="index.php?controller=produto&action=listar">Produtos</a>
                <a class="link-inline" href="admin/index.php?controller=pedidos&action=listar">Pedidos no admin →</a>
            </div>
        </article>

        <article class="hub-card">
            <span class="tag">Experiência do cliente</span>
            <h3>Loja & Pagamentos</h3>
            <p>Simule a jornada do consumidor da vitrine ao checkout PIX, acompanhe carrinho e histórico de compras.</p>
            <div class="acoes">
                <a class="botao primario" href="index.php?controller=loja">Abrir loja</a>
                <a class="botao secundario" href="index.php?controller=loja&action=carrinho">Ver carrinho</a>
                <a class="link-inline" href="index.php?controller=loja&action=meusPedidos">Pedidos do cliente →</a>
            </div>
        </article>
    </section>
</main>
</body>
</html>