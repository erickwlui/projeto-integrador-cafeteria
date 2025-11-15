<?php

require_once __DIR__ . '/../models/Produto.php';
require_once __DIR__ . '/../models/Cliente.php';
require_once __DIR__ . '/../models/Pedido.php';
require_once __DIR__ . '/../models/ItemPedido.php';

class LojaController
{
    private Produto $produtoModel;
    private Cliente $clienteModel;
    private Pedido $pedidoModel;
    private ItemPedido $itemPedidoModel;

    public function __construct(PDO $pdo)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->produtoModel = new Produto($pdo);
        $this->clienteModel = new Cliente($pdo);
        $this->pedidoModel = new Pedido($pdo);
        $this->itemPedidoModel = new ItemPedido($pdo);

        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }
    }

    private function requireLogin(): void
    {
        if (!isset($_SESSION['cliente_id'])) {
            header("Location: index.php?controller=loja&action=login");
            exit;
        }
    }

    // -------------------------------------------------------------------------
    // LOJA
    // -------------------------------------------------------------------------

    public function index()
    {
        $produtos = $this->produtoModel->getAll();
        include __DIR__ . '/../views/loja/produtos.php';
    }

    // LOGIN
    public function login()
    {
        include __DIR__ . '/../views/loja/login.php';
    }

    public function fazerLogin()
    {
        $email = trim($_POST['email'] ?? '');
        $senha = trim($_POST['senha'] ?? '');

        $cliente = $this->clienteModel->login($email, $senha);

        if ($cliente) {
            $_SESSION['cliente_id'] = $cliente['id'];
            $_SESSION['cliente_nome'] = $cliente['nome'];

            header("Location: index.php?controller=loja");
            exit;
        }

        $erro = "Credenciais inválidas.";
        include __DIR__ . '/../views/loja/login.php';
    }

    public function logout()
    {
        unset($_SESSION['cliente_id'], $_SESSION['cliente_nome']);
        header("Location: index.php?controller=loja");
        exit;
    }

    // REGISTRO
    public function registrar()
    {
        include __DIR__ . '/../views/loja/registrar.php';
    }

    public function salvarRegistro()
    {
        $dados = [
            'nome' => trim($_POST['nome'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'senha' => trim($_POST['senha'] ?? ''),
            'endereco' => trim($_POST['endereco'] ?? '')
        ];

        if (in_array('', $dados)) {
            $erro = "Preencha todos os campos.";
            include __DIR__ . '/../views/loja/registrar.php';
            exit;
        }

        $this->clienteModel->create($dados);

        header("Location: index.php?controller=loja&action=login");
        exit;
    }

    // -------------------------------------------------------------------------
    // CARRINHO
    // -------------------------------------------------------------------------

    public function adicionarCarrinho()
    {
        $this->requireLogin();

        $id = (int) ($_GET['id'] ?? 0);
        if ($id > 0) {
            $_SESSION['carrinho'][$id] = ($_SESSION['carrinho'][$id] ?? 0) + 1;
        }

        header("Location: index.php?controller=loja&action=carrinho");
        exit;
    }

    public function carrinho()
    {
        $this->requireLogin();
        $produtos = $this->produtoModel->getAll();

        include __DIR__ . '/../views/loja/carrinho.php';
    }

    public function mais()
    {
        $this->requireLogin();

        $id = (int) ($_GET['id'] ?? 0);
        if ($id > 0 && isset($_SESSION['carrinho'][$id])) {
            $_SESSION['carrinho'][$id]++;
        }

        header("Location: index.php?controller=loja&action=carrinho");
        exit;
    }

    public function menos()
    {
        $this->requireLogin();

        $id = (int) ($_GET['id'] ?? 0);
        if ($id > 0 && isset($_SESSION['carrinho'][$id])) {
            $_SESSION['carrinho'][$id]--;

            if ($_SESSION['carrinho'][$id] <= 0) {
                unset($_SESSION['carrinho'][$id]);
            }
        }

        header("Location: index.php?controller=loja&action=carrinho");
        exit;
    }

    public function remover()
    {
        $this->requireLogin();

        $id = (int) ($_GET['id'] ?? 0);
        if ($id > 0) {
            unset($_SESSION['carrinho'][$id]);
        }

        header("Location: index.php?controller=loja&action=carrinho");
        exit;
    }

    // -------------------------------------------------------------------------
    // CHECKOUT
    // -------------------------------------------------------------------------

    public function checkout()
    {
        $this->requireLogin();

        $cliente = $this->clienteModel->find($_SESSION['cliente_id']);
        $produtos = $this->produtoModel->getAll();

        include __DIR__ . '/../views/loja/checkout.php';
    }

    // -------------------------------------------------------------------------
    // FINALIZANDO PEDIDO
    // -------------------------------------------------------------------------

    public function finalizarPedido()
    {
        $this->requireLogin();

        if (empty($_SESSION['carrinho'])) {
            echo "Carrinho vazio.";
            exit;
        }

        $clienteId = $_SESSION['cliente_id'];
        $produtos = $this->produtoModel->getAll();

        $total = 0;
        foreach ($_SESSION['carrinho'] as $idProduto => $qtd) {
            foreach ($produtos as $p) {
                if ($p['id'] == $idProduto) {
                    $total += $p['preco'] * $qtd;
                }
            }
        }

        // Criar pedido
        $pedidoId = $this->pedidoModel->create($clienteId, $total);

        // Criar itens
        foreach ($_SESSION['carrinho'] as $idProduto => $qtd) {
            foreach ($produtos as $p) {
                if ($p['id'] == $idProduto) {
                    $subtotal = $p['preco'] * $qtd;
                    $this->itemPedidoModel->create($pedidoId, $idProduto, $qtd, $subtotal);
                }
            }
        }

        // Esvaziar carrinho
        $_SESSION['carrinho'] = [];

        // Redireciona para a página de sucesso
        header("Location: index.php?controller=loja&action=sucesso&id=" . $pedidoId);
        exit;
    }

    public function sucesso()
    {
        include __DIR__ . '/../views/loja/sucesso.php';
    }

    // -------------------------------------------------------------------------
    // MEUS PEDIDOS
    // -------------------------------------------------------------------------

    public function meusPedidos()
    {
        $this->requireLogin();

        $clienteId = $_SESSION['cliente_id'];
        $pedidos = $this->pedidoModel->getByCliente($clienteId);

        include __DIR__ . '/../views/loja/meus_pedidos.php';
    }

    // -------------------------------------------------------------------------
    // DETALHES DO PEDIDO
    // -------------------------------------------------------------------------

    public function detalhesPedido()
    {
        $this->requireLogin();

        $id = (int) ($_GET['id'] ?? 0);
        if ($id <= 0) {
            echo "Pedido inválido.";
            exit;
        }

        $pedido = $this->pedidoModel->find($id);

        // Permitir somente pedidos do cliente logado
        if ($pedido['id_cliente'] != $_SESSION['cliente_id']) {
            echo "Acesso negado.";
            exit;
        }

        $itens = $this->itemPedidoModel->getByPedido($id);

        include __DIR__ . '/../views/loja/detalhes_pedido.php';
    }
}