<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cafeteria Gourmet Digital</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>
<header>
    <h1>Cafeteria Gourmet Digital</h1>
    <nav>
        <a href="index.php" class="ativo">Início</a>
        <a href="index.php?controller=cliente&action=listar">Clientes</a>
        <a href="index.php?controller=produto&action=listar">Produtos</a>
        <a href="index.php?controller=pedido&action=listar">Pedidos</a>
    </nav>
</header>
<main>
    <section class="hero">
        <h2>Bem-vindo ao painel administrativo</h2>
        <p>Gerencie clientes, produtos e acompanhe os pedidos do projeto Cafeteria Gourmet Digital.</p>
        <div class="cta">
            <a class="botao primario" href="index.php?controller=cliente&action=listar">Começar pelos clientes</a>
            <a class="botao" href="index.php?controller=produto&action=listar">Ver produtos</a>
        </div>
    </section>
</main>
</body>
</html>
