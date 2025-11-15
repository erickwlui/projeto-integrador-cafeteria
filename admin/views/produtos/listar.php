<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">

<h2>Produtos</h2>
<a class="btn" href="index.php?controller=produtos&action=cadastrar">+ Novo Produto</a>

<br><br>

<table>
    <tr>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Preço</th>
        <th>Estoque</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($produtos as $p): ?>
        <tr>
            <td><?= $p['nome'] ?></td>
            <td><?= $p['descricao'] ?></td>
            <td>R$ <?= number_format($p['preco'],2,',','.') ?></td>
            <td><?= $p['estoque'] ?></td>
            <td>
                <a class="btn" href="index.php?controller=produtos&action=editar&id=<?= $p['id'] ?>">Editar</a>
                <a class="btn btn-danger" href="index.php?controller=produtos&action=excluir&id=<?= $p['id'] ?>">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

</div>
