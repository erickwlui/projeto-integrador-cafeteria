<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pagamento PIX - Cafeteria</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .pix-wrapper {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            text-align: center;
        }

        .pix-total {
            font-size: 1.8rem;
            margin-top: .5rem;
        }

        .pix-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .pix-card img {
            width: 260px;
            max-width: 100%;
            border-radius: 12px;
            border: 1px solid var(--cinza);
            padding: 1rem;
            background: #fff;
        }

        .pix-hint {
            font-style: italic;
            color: var(--cinza-escuro);
        }
    </style>
</head>
<body>
<?php include __DIR__ . '/../loja/cabecalho_loja.php'; ?>

<main>
    <section class="topo-sessao">
        <div>
            <h2>Pagar com PIX</h2>
            <p>Escaneie o QR Code abaixo para concluir seu pedido.</p>
        </div>
    </section>

    <div class="quadro pix-wrapper">
        <div>
            <span>Total a pagar:</span>
            <div class="pix-total">
                R$ <?= number_format($pedido['total'], 2, ',', '.') ?>
            </div>
        </div>

        <div class="pix-card">
            <img src="assets/imagens/qrcode_fake.png" alt="QR Code PIX">
            <p class="pix-hint">(QR Code ilustrativo – pagamento simulado)</p>
        </div>

        <form action="index.php?controller=payment&action=confirmar" method="post">
            <input type="hidden" name="pedido_id" value="<?= $pedido['id'] ?>">
            <button class="botao primario" type="submit">Já paguei</button>
        </form>
    </div>
</main>
</body>
</html>