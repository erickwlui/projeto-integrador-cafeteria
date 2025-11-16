<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>

<body>

<div class="login-box">
    <h2>Painel Administrativo</h2>

    <?php if (!empty($erro)): ?>
        <p class="erro"><?= $erro ?></p>
    <?php endif; ?>

    <form action="index.php?controller=auth&action=fazerLogin" method="post">
        <label>Usuário</label>
        <input type="text" name="usuario" required>

        <label>Senha</label>
        <input type="password" name="senha" required>

        <button type="submit">Entrar</button>
    </form>
</div>

</body>
</html>
