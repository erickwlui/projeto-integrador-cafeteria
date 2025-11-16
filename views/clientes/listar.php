<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">

<h2>Clientes</h2>

<a class="btn" href="index.php?controller=clientes&action=cadastrar">+ Novo Cliente</a>
<br><br>

<?php if (!empty($_GET['mensagem'])): ?>
    <p class="<?= ($_GET['tipo'] ?? 'sucesso') === 'erro' ? 'erro' : 'alert-sucesso'; ?>">
        <?= htmlspecialchars($_GET['mensagem']); ?>
    </p>
<?php endif; ?>

<table>
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Endereço</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($clientes as $c): ?>
        <tr>
            <td><?= $c['nome'] ?></td>
            <td><?= $c['email'] ?></td>
            <td><?= $c['endereco'] ?></td>

            <td>
                <a class="btn" href="index.php?controller=clientes&action=editar&id=<?= $c['id'] ?>">Editar</a>
                <a class="btn btn-danger"
                   href="index.php?controller=clientes&action=excluir&id=<?= $c['id'] ?>"
                   onclick="return confirm('Excluir cliente?');">
                    Excluir
                </a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

</div>