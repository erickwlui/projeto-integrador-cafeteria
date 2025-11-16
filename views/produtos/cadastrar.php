<?php
/** @var array|null $produtoEdit */
/** @var string $erro */
$estaEditando = !empty($produtoEdit);
$acaoFormulario = $estaEditando
    ? 'index.php?controller=produto&action=editar&id=' . $produtoEdit['id']
    : 'index.php?controller=produto&action=cadastrar';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= $estaEditando ? 'Editar' : 'Cadastrar'; ?> Produto - Cafeteria Gourmet Digital</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header>
    <h1 class="brand-title">Cafeteria Gourmet Digital</h1>
    <nav>
        <a href="index.php">Início</a>
        <a href="index.php?controller=cliente&action=listar">Clientes</a>
        <a href="index.php?controller=produto&action=listar" class="ativo">Produtos</a>
        <a href="index.php?controller=pedido&action=listar">Pedidos</a>
    </nav>
</header>
<main>
    <section class="topo-sessao">
        <div>
            <h2><?= $estaEditando ? 'Editar Produto' : 'Cadastrar Produto'; ?></h2>
            <p>Descreva o produto que deseja disponibilizar.</p>
        </div>
        <a class="botao" href="index.php?controller=produto&action=listar">&larr; Voltar</a>
    </section>

    <?php if (!empty($erro)): ?>
        <p class="alerta alerta-erro"><?= htmlspecialchars($erro); ?></p>
    <?php endif; ?>

    <div class="quadro">
        <form method="post" action="<?= $acaoFormulario; ?>" class="formulario">
            <label>
                Nome
                <input type="text" name="nome" value="<?= htmlspecialchars($produtoEdit['nome'] ?? ''); ?>" required>
            </label>
            <label>
                Descrição
                <textarea name="descricao" rows="4" required><?= htmlspecialchars($produtoEdit['descricao'] ?? ''); ?></textarea>
            </label>
            <label>
                Preço (R$)
                <input type="number" step="0.01" name="preco" value="<?= htmlspecialchars($produtoEdit['preco'] ?? ''); ?>" required>
            </label>
            <label>
                Estoque
                <input type="number" min="0" name="estoque" value="<?= htmlspecialchars($produtoEdit['estoque'] ?? ''); ?>" required>
            </label>

            <button class="botao primario" type="submit">
                <?= $estaEditando ? 'Salvar Alterações' : 'Cadastrar'; ?>
            </button>
        </form>
    </div>
</main>
</body>
</html>