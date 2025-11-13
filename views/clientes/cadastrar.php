<?php
/** @var array|null $clienteEdit */
/** @var string $erro */
$estaEditando = !empty($clienteEdit);
$acaoFormulario = $estaEditando
    ? 'index.php?controller=cliente&action=editar&id=' . $clienteEdit['id']
    : 'index.php?controller=cliente&action=cadastrar';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= $estaEditando ? 'Editar' : 'Cadastrar'; ?> Cliente - Cafeteria Gourmet Digital</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>
<header>
    <h1>Cafeteria Gourmet Digital</h1>
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
            <h2><?= $estaEditando ? 'Editar Cliente' : 'Cadastrar Cliente'; ?></h2>
            <p>Informe os dados do cliente abaixo.</p>
        </div>
        <a class="botao" href="index.php?controller=cliente&action=listar">&larr; Voltar</a>
    </section>

    <?php if (!empty($erro)): ?>
        <p class="alerta alerta-erro"><?= htmlspecialchars($erro); ?></p>
    <?php endif; ?>

    <div class="quadro">
        <form method="post" action="<?= $acaoFormulario; ?>" class="formulario">
            <label>
                Nome
                <input type="text" name="nome" value="<?= htmlspecialchars($clienteEdit['nome'] ?? ''); ?>" required>
            </label>
            <label>
                Email
                <input type="email" name="email" value="<?= htmlspecialchars($clienteEdit['email'] ?? ''); ?>" required>
            </label>
            <label>
                Senha
                <input type="text" name="senha" value="<?= htmlspecialchars($clienteEdit['senha'] ?? ''); ?>" required>
            </label>
            <label>
                Endereço
                <input type="text" name="endereco" value="<?= htmlspecialchars($clienteEdit['endereco'] ?? ''); ?>" required>
            </label>

            <button class="botao primario" type="submit">
                <?= $estaEditando ? 'Salvar Alterações' : 'Cadastrar'; ?>
            </button>
        </form>
    </div>
</main>
</body>
</html>
