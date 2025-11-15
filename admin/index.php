<?php
require_once __DIR__ . '/../config/conexao.php';

$controller = $_GET['controller'] ?? 'admin';
$action     = $_GET['action'] ?? 'index';

switch ($controller) {

    case 'auth':
        require_once __DIR__ . '/controllers/AuthController.php';
        $ctrl = new AuthController($pdo);
        break;

    case 'clientes':
        require_once __DIR__ . '/controllers/AdminClienteController.php';
        $ctrl = new AdminClienteController($pdo);
        break;

    case 'produtos':
        require_once __DIR__ . '/controllers/AdminProdutoController.php';
        $ctrl = new AdminProdutoController($pdo);
        break;

    case 'pedidos':
        require_once __DIR__ . '/controllers/AdminPedidoController.php';
        $ctrl = new AdminPedidoController($pdo);
        break;

    default:
        require_once __DIR__ . '/controllers/AdminController.php';
        $ctrl = new AdminController($pdo);
        break;
}

if (!method_exists($ctrl, $action)) {
    $action = 'index';
}

$ctrl->{$action}();
