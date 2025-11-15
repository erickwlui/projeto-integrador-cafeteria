<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - Cafeteria Gourmet Digital</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>

<header>
    <h1>Cafeteria Gourmet Digital</h1>
    <nav>
        <a href="index.php?controller=loja">Loja</a>
        <a href="index.php?controller=loja&action=login" class="ativo">Login</a>
        <a href="index.php?controller=loja&action=registrar">Criar Conta</a>
    </nav>
</header>

<main>
    <section class="topo-sessao">
        <div>
            <h2>Entrar</h2>
            <p>Acesse sua conta para continuar.</p>
        </div>
    </section>

    <?php if (!empty($erro)): ?>
        <p class="alerta alerta-erro"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <div class="quadro">
        <form method="post" action="index.php?controller=loja&action=fazerLogin" class="formulario">
            <label>
                Email
                <input type="email" name="email" required>
            </label>

            <label>
                Senha
                <input type="password" name="senha" required>
            </label>

            <button class="botao primario" type="submit">Entrar</button>

            <p style="margin-top:1rem;">
                Não tem conta?
                <a href="index.php?controller=loja&action=registrar">Clique aqui</a>
            </p>
        </form>
    </div>
</main>

</body>
</html>