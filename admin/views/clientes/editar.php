<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">

<h2>Editar Cliente</h2>

<form method="post" action="index.php?controller=clientes&action=atualizar">

    <input type="hidden" name="id" value="<?= $cliente['id'] ?>">

    <label>Nome</label>
    <input type="text" name="nome" value="<?= $cliente['nome'] ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= $cliente['email'] ?>" required>

    <label>Senha</label>
    <input type="text" name="senha" value="<?= $cliente['senha'] ?>" required>

    <label>Endereço</label>
    <input type="text" name="endereco" value="<?= $cliente['endereco'] ?>" required>

    <button class="btn">Salvar alterações</button>

</form>

</div>
