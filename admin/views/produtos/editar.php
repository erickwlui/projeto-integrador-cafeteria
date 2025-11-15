<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">

<h2>Editar Produto</h2>

<form method="post" action="index.php?controller=produtos&action=atualizar">

    <input type="hidden" name="id" value="<?= $produto['id'] ?>">

    <label>Nome</label>
    <input type="text" name="nome" value="<?= $produto['nome'] ?>" required>

    <label>Descrição</label>
    <textarea name="descricao" rows="4" required><?= $produto['descricao'] ?></textarea>

    <label>Preço</label>
    <input type="number" name="preco" step="0.01" value="<?= $produto['preco'] ?>" required>

    <label>Estoque</label>
    <input type="number" name="estoque" value="<?= $produto['estoque'] ?>" required>

    <button class="btn">Salvar alterações</button>

</form>

</div>
