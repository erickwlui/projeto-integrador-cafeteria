 <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Detecta ação atual
$acaoAtual = $_GET['action'] ?? 'index';
?>

<header class="header-loja">
    <div class="container-loja">
        <h1 class="logo-loja">Cafeteria Gourmet Digital</h1>

        <nav class="menu-loja">
            <a href="index.php?controller=loja"
               class="<?= $acaoAtual === 'index' ? 'ativo' : '' ?>">
                Loja
            </a>

            <a href="index.php?controller=loja&action=carrinho"
               class="<?= $acaoAtual === 'carrinho' ? 'ativo' : '' ?>">
                Carrinho
            </a>

            <a href="index.php?controller=loja&action=meusPedidos"
               class="<?= $acaoAtual === 'meusPedidos' ? 'ativo' : '' ?>">
                Meus pedidos
            </a>

            <?php if (isset($_SESSION['cliente_nome'])): ?>
                <a href="index.php?controller=loja&action=logout" class="logout-btn">
                    Sair (<?= htmlspecialchars($_SESSION['cliente_nome']); ?>)
                </a>
            <?php else: ?>
                <a href="index.php?controller=loja&action=login">
                    Entrar
                </a>
            <?php endif; ?>
        </nav>
    </div>
</header>
