<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">

<h2>Novo Produto</h2>

<form method="post" action="index.php?controller=produtos&action=salvar">

    <label>Nome</label>
    <input type="text" name="nome" required>

    <label>Descrição</label>
    <textarea name="descricao" rows="4" required></textarea>

    <label>Preço</label>
    <input type="number" name="preco" step="0.01" required>

    <label>Estoque</label>
    <input type="number" name="estoque" required>

    <button class="btn">Salvar</button>

</form>

</div>
