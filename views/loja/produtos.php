<?php?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Loja - Cafeteria Gourmet Digital</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .produtos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 1.5rem;
        }

        .produto-card {
            background: #fff;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .produto-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }

        .produto-card h3 {
            margin-top: 0;
            margin-bottom: .5rem;
            color: var(--cor-primaria);
        }

        .produto-card p {
            margin: 0 0 .8rem;
        }

        .produto-preco {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--cor-primaria);
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>

<?php include 'cabecalho_loja.php'; ?>

<main>

    <section class="topo-sessao">
        <div>
            <h2>Loja</h2>
            <p>Escolha seus cafés e produtos gourmet.</p>
        </div>
    </section>

    <div class="quadro produtos-grid">

        <?php foreach ($produtos as $p): ?>
            <div class="produto-card">

                <div>
                    <h3><?= htmlspecialchars($p['nome']); ?></h3>

                    <p><?= htmlspecialchars($p['descricao']); ?></p>

                    <div class="produto-preco">
                        R$ <?= number_format($p['preco'], 2, ',', '.'); ?>
                    </div>
                </div>

                <p>
                    <a class="botao primario"
                       href="index.php?controller=loja&action=adicionarCarrinho&id=<?= $p['id']; ?>">
                        Adicionar ao Carrinho
                    </a>
                </p>

            </div>
        <?php endforeach; ?>

    </div>

</main>

</body>
</html>
