<?php
/** @var array $clientes */
/** @var string $mensagem */
/** @var string $tipoMensagem */
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Clientes - Cafeteria Gourmet Digital</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header>
    <h1 class="brand-title">Cafeteria Gourmet Digital</h1>
    <nav>
        <a href="index.php">Início</a>
        <a href="index.php?controller=cliente&action=listar" class="ativo">Clientes</a>
        <a href="index.php?controller=produto&action=listar">Produtos</a>
        <a href="index.php?controller=pedido&action=listar">Pedidos</a>
    </nav>
</header>
<main>
    <section class="topo-sessao">
        <div>
            <h2>Clientes</h2>
            <p>Gerencie o cadastro de clientes da cafeteria.</p>
        </div>
        <a class="botao primario" href="index.php?controller=cliente&action=cadastrar">+ Novo Cliente</a>
    </section>

    <?php if (!empty($mensagem)): ?>
        <p class="alerta <?= $tipoMensagem === 'erro' ? 'alerta-erro' : 'alerta-sucesso'; ?>"><?= htmlspecialchars($mensagem); ?></p>
    <?php endif; ?>

    <div class="quadro">
        <?php if (count($clientes) === 0): ?>
            <p>Nenhum cliente cadastrado.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Endereço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= htmlspecialchars($cliente['nome']); ?></td>
                            <td><?= htmlspecialchars($cliente['email']); ?></td>
                            <td><?= htmlspecialchars($cliente['endereco']); ?></td>
                            <td class="acoes">
                                <a class="botao pequeno" href="index.php?controller=cliente&action=editar&id=<?= $cliente['id']; ?>">Editar</a>
                                <a class="botao pequeno perigo" href="index.php?controller=cliente&action=excluir&id=<?= $cliente['id']; ?>" onclick="return confirm('Deseja realmente excluir este cliente?');">Excluir</a>
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
