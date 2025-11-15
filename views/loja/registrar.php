<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Conta - Cafeteria Gourmet Digital</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>

<header>
    <h1>Cafeteria Gourmet Digital</h1>
    <nav>
        <a href="index.php?controller=loja">Loja</a>
        <a href="index.php?controller=loja&action=login">Login</a>
        <a href="index.php?controller=loja&action=registrar" class="ativo">Criar Conta</a>
    </nav>
</header>

<main>
    <section class="topo-sessao">
        <div>
            <h2>Criar Conta</h2>
            <p>Cadastre-se para comprar na loja.</p>
        </div>
    </section>

    <?php if (!empty($erro)): ?>
        <p class="alerta alerta-erro"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <div class="quadro">
        <form method="post" action="index.php?controller=loja&action=salvarRegistro" class="formulario">

            <label>
                Nome
                <input type="text" name="nome" required>
            </label>

            <label>
                Email
                <input type="email" name="email" required>
            </label>

            <label>
                Senha
                <input type="password" name="senha" required>
            </label>

            <label>
                Endereço
                <input type="text" name="endereco" required>
            </label>

            <button class="botao primario" type="submit">Criar Conta</button>

            <p style="margin-top:1rem;">
                Já tem conta?
                <a href="index.php?controller=loja&action=login">Faça login</a>
            </p>
        </form>
    </div>
</main>

</body>
</html>