<?php
/** @var array $produtos */
/** @var string $mensagem */
/** @var string $tipoMensagem */
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Produtos - Cafeteria Gourmet Digital</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>
<header>
    <h1>Cafeteria Gourmet Digital</h1>
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
            <h2>Produtos</h2>
            <p>Controle o catálogo de bebidas e sobremesas.</p>
        </div>
        <a class="botao primario" href="index.php?controller=produto&action=cadastrar">+ Novo Produto</a>
    </section>

    <?php if (!empty($mensagem)): ?>
        <p class="alerta <?= $tipoMensagem === 'erro' ? 'alerta-erro' : 'alerta-sucesso'; ?>"><?= htmlspecialchars($mensagem); ?></p>
    <?php endif; ?>

    <div class="quadro">
        <?php if (count($produtos) === 0): ?>
            <p>Nenhum produto cadastrado.</p>
        <?php else: ?>
            <table>
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?= htmlspecialchars($produto['nome']); ?></td>
                        <td><?= htmlspecialchars($produto['descricao']); ?></td>
                        <td>R$ <?= number_format($produto['preco'], 2, ',', '.'); ?></td>
                        <td><?= (int) $produto['estoque']; ?></td>
                        <td class="acoes">
                            <a class="botao pequeno" href="index.php?controller=produto&action=editar&id=<?= $produto['id']; ?>">Editar</a>
                            <a class="botao pequeno perigo" href="index.php?controller=produto&action=excluir&id=<?= $produto['id']; ?>" onclick="return confirm('Deseja realmente excluir este produto?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</main>
</body>
</html>
