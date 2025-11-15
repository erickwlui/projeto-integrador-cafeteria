<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">

<h2>Novo Cliente</h2>

<form method="post" action="index.php?controller=clientes&action=salvar">

    <label>Nome</label>
    <input type="text" name="nome" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Senha</label>
    <input type="text" name="senha" required>

    <label>Endereço</label>
    <input type="text" name="endereco" required>

    <button class="btn">Salvar</button>

</form>

</div>
